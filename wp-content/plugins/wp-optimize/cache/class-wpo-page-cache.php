<?php
/**
 * Page caching functionality
 *
 * Acknowledgement: The page cache functionality was loosely based on the simple cache plugin - https://github.com/tlovett1/simple-cache
 */

if (!defined('ABSPATH')) die('No direct access allowed');

/**
 * Base cache directory, everything else goes under here
 */
if (!defined('WPO_CACHE_DIR')) define('WPO_CACHE_DIR', untrailingslashit(WP_CONTENT_DIR).'/wpo-cache');

/**
 * Extensions directory.
 */
if (!defined('WPO_CACHE_EXT_DIR')) define('WPO_CACHE_EXT_DIR', dirname(__FILE__).'/extensions');

/**
 * Directory that stores config and related files
 */
if (!defined('WPO_CACHE_CONFIG_DIR')) define('WPO_CACHE_CONFIG_DIR', WPO_CACHE_DIR.'/config');

/**
 * Directory that stores the cache, including gzipped files and mobile specifc cache
 */
if (!defined('WPO_CACHE_FILES_DIR')) define('WPO_CACHE_FILES_DIR', untrailingslashit(WP_CONTENT_DIR).'/cache/wpo-cache');

if (!class_exists('WPO_Cache_Config')) require_once(dirname(__FILE__) . '/class-wpo-cache-config.php');
if (!class_exists('WPO_Cache_Rules')) require_once(dirname(__FILE__) . '/class-wpo-cache-rules.php');

if (!class_exists('WP_Optimize_Detect_Cache_Plugins')) require_once(dirname(__FILE__) . '/class-wpo-detect-cache-plugins.php');

if (!class_exists('WP_Optimize_Page_Cache_Preloader')) require_once(dirname(__FILE__) . '/class-wpo-cache-preloader.php');
if (!class_exists('WPO_Cache_Config')) require_once(dirname(__FILE__) . '/class-wpo-cache-config.php');
if (!class_exists('WPO_Cache_Rules')) require_once(dirname(__FILE__) . '/class-wpo-cache-rules.php');

if (!class_exists('Updraft_Abstract_Logger')) require_once(WPO_PLUGIN_MAIN_PATH.'/includes/class-updraft-abstract-logger.php');
if (!class_exists('Updraft_PHP_Logger')) require_once(WPO_PLUGIN_MAIN_PATH.'/includes/class-updraft-php-logger.php');

require_once dirname(__FILE__) . '/file-based-page-cache-functions.php';

if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
	require_once dirname(__FILE__) . '/php-5.3-functions.php';
}

wpo_cache_load_extensions();

if (!class_exists('WPO_Page_Cache')) :

class WPO_Page_Cache {

	/**
	 * Cache config object
	 *
	 * @var mixed
	 */
	public $config;

	/**
	 * Logger for this class
	 *
	 * @var mixed
	 */
	public $logger;

	/**
	 * Instance of this class
	 *
	 * @var mixed
	 */
	public static $instance;

	/**
	 * Store last advanced cache file writing status
	 * If true then last writing finished with error
	 *
	 * @var bool
	 */
	public $advanced_cache_file_writing_error;

	/**
	 * Last advanced cache file content
	 *
	 * @var string
	 */
	public $advanced_cache_file_content;

	/**
	 * Store the latest advanced-cache.php version required
	 *
	 * @var string
	 */
	private $_minimum_advanced_cache_file_version = '3.0.17';

	/**
	 * Set everything up here
	 */
	public function __construct() {
		$this->config = WPO_Cache_Config::instance();
		$this->rules  = WPO_Cache_Rules::instance();
		$this->logger = new Updraft_PHP_Logger();

		add_action('activate_plugin', array($this, 'activate_deactivate_plugin'));
		add_action('deactivate_plugin', array($this, 'activate_deactivate_plugin'));

		/**
		 * Regenerate config file on cache flush.
		 */
		add_action('wpo_cache_flush', array($this, 'update_cache_config'));
		add_action('wpo_cache_flush', array($this, 'delete_cache_size_information'));

		// Add purge cache link to admin bar.
		add_action('admin_bar_menu', array($this, 'wpo_admin_bar_purge_cache'), 100);

		// Handle single page purge.
		add_action('wp_loaded', array($this, 'handle_purge_single_page_cache'));

		add_action('admin_init', array($this, 'admin_init'));
	}

	/**
	 * Do required actions on activate/deactivate any plugin.
	 */
	public function activate_deactivate_plugin() {

		$this->update_cache_config();

		/**
		 * Filters whether activating / deactivating a plugin will purge the cache.
		 */
		if (apply_filters('wpo_purge_page_cache_on_activate_deactivate_plugin', true)) {
			$this->purge();
		}
	}

	/**
	 * Check if current user can purge cache.
	 *
	 * @return bool
	 */
	public function can_purge_cache() {
		if (is_multisite()) return $this->is_enabled() && current_user_can('manage_network_options');
		return $this->is_enabled() && current_user_can('manage_options');
	}

	/**
	 * Add Purge from cache in admin bar.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar
	 */
	public function wpo_admin_bar_purge_cache($wp_admin_bar) {
		global $pagenow;

		if (!$this->can_purge_cache()) return;

		$act_url = remove_query_arg(array('wpo_single_page_cache_purged', 'wpo_all_pages_cache_purged'));

		if (!is_admin() || 'post.php' == $pagenow) {
			$wp_admin_bar->add_menu(array(
				'id'    => 'wpo_purge_cache',
				'title' => __('Purge cache', 'wp-optimize'),
				'href'  => '#',
				'meta'  => array(
					'title' => __('Purge cache', 'wp-optimize'),
				),
				'parent' => false,
			));

			$wp_admin_bar->add_node(array(
				'id'    => 'wpo_purge_this_page_cache',
				'title' => __('Purge this page', 'wp-optimize'),
				'href'  => add_query_arg('_wpo_purge', wp_create_nonce('wpo_purge_single_page_cache'), $act_url),
				'meta'  => array(
					'title' => __('Purge this page', 'wp-optimize'),
				),
				'parent' => 'wpo_purge_cache',
			));

			$wp_admin_bar->add_node(array(
				'id'    => 'wpo_purge_all_pages_cache',
				'title' => __('Purge all pages', 'wp-optimize'),
				'href'  => add_query_arg('_wpo_purge', wp_create_nonce('wpo_purge_all_pages_cache'), $act_url),
				'meta'  => array(
					'title' => __('Purge all pages', 'wp-optimize'),
				),
				'parent' => 'wpo_purge_cache',
			));
		} else {
			$wp_admin_bar->add_menu(array(
				'id'    => 'wpo_purge_cache',
				'title' => __('Purge all pages', 'wp-optimize'),
				'href'  => add_query_arg('_wpo_purge', wp_create_nonce('wpo_purge_all_pages_cache'), $act_url),
				'meta'  => array(
					'title' => __('Purge all pages', 'wp-optimize'),
				),
				'parent' => false,
			));
		}
	}

	/**
	 * Check if purge single page action sent and purge cache.
	 */
	public function handle_purge_single_page_cache() {

		if (!$this->can_purge_cache()) return;

		if (isset($_GET['wpo_single_page_cache_purged']) || isset($_GET['wpo_all_pages_cache_purged'])) {
			if (isset($_GET['wpo_single_page_cache_purged'])) {
				$notice_function = $_GET['wpo_single_page_cache_purged'] ? 'notice_purge_single_page_cache_success' : 'notice_purge_single_page_cache_error';
			} else {
				$notice_function = $_GET['wpo_all_pages_cache_purged'] ? 'notice_purge_all_pages_cache_success' : 'notice_purge_all_pages_cache_error';
			}

			add_action('admin_notices', array($this, $notice_function));

			return;
		}

		if (!isset($_GET['_wpo_purge'])) return;

		if (wp_verify_nonce($_GET['_wpo_purge'], 'wpo_purge_single_page_cache')) {
			$success = false;

			if (is_admin()) {
				$post = isset($_GET['post']) ? (int) $_GET['post'] : 0;
				if ($post > 0) {
					$success = self::delete_single_post_cache($post);
				}
			} else {
				$success = self::delete_cache_by_url(wpo_current_url());
			}

			// remove nonce from url and reload page.
			wp_redirect(add_query_arg('wpo_single_page_cache_purged', $success, remove_query_arg('_wpo_purge')));
			exit;

		} elseif (wp_verify_nonce($_GET['_wpo_purge'], 'wpo_purge_all_pages_cache')) {
			$success = self::purge();

			// remove nonce from url and reload page.
			wp_redirect(add_query_arg('wpo_all_pages_cache_purged', $success, remove_query_arg('_wpo_purge')));
			exit;
		}
	}

	/**
	 * Show notification when page cache purged successfully.
	 */
	public function notice_purge_single_page_cache_success() {
		$this->show_notice(__('The page cache was successfully purged.', 'wp-optimize'), 'success');
	}

	/**
	 * Show notification when page cache wasn't purged.
	 */
	public function notice_purge_single_page_cache_error() {
		$this->show_notice(__('The page cache was not purged.', 'wp-optimize'), 'error');
	}

	/**
	 * Show notification when all pages cache purged successfully.
	 */
	public function notice_purge_all_pages_cache_success() {
		$this->show_notice(__('The page cache was successfully purged.', 'wp-optimize'), 'success');
	}

	/**
	 * Show notification when all pages cache wasn't purged.
	 */
	public function notice_purge_all_pages_cache_error() {
		$this->show_notice(__('The page cache was not purged.', 'wp-optimize'), 'error');
	}

	/**
	 * Show notification in WordPress admin.
	 *
	 * @param string $message HTML (no further escaping is performed)
	 * @param string $type    error, warning, success, or info
	 */
	public function show_notice($message, $type) {
		?>
		<div class="notice wpo-notice notice-<?php echo $type; ?> is-dismissible">
			<p><?php echo $message; ?></p>
		</div>
		<script>
			window.addEventListener('load', function() {
				(function(wp) {
					wp.data.dispatch('core/notices').createNotice(
						'<?php echo $type; ?>',
						'<?php echo $message; ?>',
						{
							isDismissible: true,
						}
					);
				})(window.wp);
			});
		</script>
		<?php
	}

	/**
	 * Enables page cache
	 *
	 * @param bool $force_enable - Force regenerating everything. E.g. we want to do that when saving the settings
	 *
	 * @return WP_Error|bool - true on success, error otherwise
	 */
	public function enable($force_enable = false) {
		static $already_ran_enable = false;

		if ($already_ran_enable) return $already_ran_enable;

		$folders_created = $this->create_folders();
		if (is_wp_error($folders_created)) {
			$already_ran_enable = $folders_created;
			return $already_ran_enable;
		}

		// if WPO_ADVANCED_CACHE isn't set, or environment doesn't contain the right constant, force regeneration
		if (!defined('WPO_ADVANCED_CACHE') || !defined('WP_CACHE')) {
			$force_enable = true;
		}

		if (!$force_enable) {
			$already_ran_enable = true;
			return true;
		}

		if (!$this->write_advanced_cache() && $this->get_advanced_cache_version() != WPO_VERSION) {
			$message = sprintf("The request to write the file %s failed. ", htmlspecialchars($this->get_advanced_cache_filename()));
			$message .= ' '.__('Your WP install might not have permission to write inside the wp-content folder.', 'wp-optimize');

			if (!defined('WP_CLI') || !WP_CLI) {
				$message .= "\n\n".sprintf(__('1. Please navigate, via FTP, to the folder - %s', 'wp-optimize'), htmlspecialchars(dirname($this->get_advanced_cache_filename())));
				$message .= "\n".__('2. Edit or create a file with the name advanced-cache.php', 'wp-optimize');
				$message .= "\n".__('3. Copy and paste the following lines into the file:', 'wp-optimize');
			}

			$already_ran_enable = new WP_Error("write_advanced_cache", $message);
			return $already_ran_enable;
		}

		if (!$this->write_wp_config(true)) {
			$already_ran_enable = new WP_Error("write_wp_config", "Could not toggle the WP_CACHE constant in wp-config.php. Check your permissions.");
			return $already_ran_enable;
		}

		if (!$this->verify_cache()) {
			$already_ran_enable = new WP_Error("verify_cache", "Could not verify if the cache was enabled. Turn on logging to find the reason.");
			return $already_ran_enable;
		}

		$already_ran_enable = true;

		return true;
	}

	/**
	 * Disables page cache
	 *
	 * @return bool - true on success, false otherwise
	 */
	public function disable() {
		$ret = true;

		$advanced_cache_file = $this->get_advanced_cache_filename();
		
		// We only touch advanched-cache.php and wp-config.php if it appears that we were in control of advanced-cache.php
		if (!file_exists($advanced_cache_file) || false !== strpos(file_get_contents($advanced_cache_file), 'WP-Optimize advanced-cache.php')) {

			// First try to remove (so that it doesn't look to any other plugin like the file is already 'claimed')
			if (file_exists($advanced_cache_file) && (!unlink($advanced_cache_file) && false === file_put_contents($advanced_cache_file, "<?php\n// WP-Optimize: page cache disabled"))) {
				$this->log("The request to the filesystem to remove or empty advanced-cache.php failed");
				$ret = false;
			}

			// N.B. The only use of WP_CACHE in WP core is to include('advanced-cache.php') (and run a function if it's then defined); so, if the decision to leave it enable is, for some unexpected reason, technically incorrect, it still can't cause a problem.
			if (!$this->write_wp_config(false)) {
				$this->log("Could not toggle the WP_CACHE constant in wp-config.php");
				$ret = false;
			}
		}

		// Delete cache to avoid stale cache on next activation
		$this->purge();

		return $ret;
	}


	/**
	 * Purges the cache
	 *
	 * @return bool - true on success, false otherwise
	 */
	public function purge() {

		if (!self::delete(WPO_CACHE_FILES_DIR)) {
			$this->log("The request to the filesystem to delete the cache failed");
			return false;
		}

		/**
		 * Fires after purging the cache
		 */
		do_action('wpo_cache_flush');

		return true;
	}

	/**
	 * Purges the cache
	 *
	 * @return bool - true on success, false otherwise
	 */
	public function clean_up() {

		$this->disable();

		if (!self::delete(WPO_CACHE_DIR, true)) {
			$this->log("The request to the filesystem to clean up the cache failed");
			return false;
		}

		return true;
	}

	/**
	 * Check if cache is enabled and working
	 *
	 * @return bool - true on success, false otherwise
	 */
	public function is_enabled() {

		if (!defined('WP_CACHE') || !WP_CACHE) {
			return false;
		}

		if (!defined('WPO_ADVANCED_CACHE') || !WPO_ADVANCED_CACHE) {
			return false;
		}

		if (!$this->config->get_option('enable_page_caching', false)) {
			return false;
		}

		return true;
	}

	/**
	 * Create the folder structure needed for cache to work
	 *
	 * @return bool - true on success, false otherwise
	 */
	private function create_folders() {

		if (!is_dir(WPO_CACHE_DIR) && !wp_mkdir_p(WPO_CACHE_DIR)) {
			return new WP_Error('create_folders', sprintf(__('The request to the filesystem failed: unable to create directory %s. Please check your file permissions.'), str_ireplace(ABSPATH, '', WPO_CACHE_DIR)));
		}

		if (!is_dir(WPO_CACHE_CONFIG_DIR) && !wp_mkdir_p(WPO_CACHE_CONFIG_DIR)) {
			return new WP_Error('create_folders', sprintf(__('The request to the filesystem failed: unable to create directory %s. Please check your file permissions.'), str_ireplace(ABSPATH, '', WPO_CACHE_CONFIG_DIR)));
		}
		
		if (!is_dir(WPO_CACHE_FILES_DIR)) {
			if (!wp_mkdir_p(WPO_CACHE_FILES_DIR)) {
				return new WP_Error('create_folders', sprintf(__('The request to the filesystem failed: unable to create directory %s. Please check your file permissions.'), str_ireplace(ABSPATH, '', WPO_CACHE_FILES_DIR)));
			} else {
				wpo_disable_cache_directories_viewing();
			}
		}

		return true;
	}

	/**
	 * Get advanced-cache.php file name with full path.
	 *
	 * @return string
	 */
	public function get_advanced_cache_filename() {
		return untrailingslashit(WP_CONTENT_DIR) . '/advanced-cache.php';
	}

	/**
	 * Writes advanced-cache.php
	 *
	 * @return bool
	 */
	private function write_advanced_cache() {

		$url = parse_url(network_site_url());
	
		if (isset($url['port']) && '' != $url['port'] && 80 != $url['port']) {
			$config_file_basename = 'config-'.$url['host'].'-port'.$url['port'].'.php';
		} else {
			$config_file_basename = 'config-'.$url['host'].'.php';
		}

		$cache_file_basename = untrailingslashit(plugin_dir_path(__FILE__));
		$plugin_basename = basename(WPO_PLUGIN_MAIN_PATH);
		$cache_path = '/wpo-cache';
		$cache_files_path = '/cache/wpo-cache';
		$cache_extensions_path = WPO_CACHE_EXT_DIR;
		$wpo_version = WPO_VERSION;

		// CS does not like heredoc
		// phpcs:disable
		$this->advanced_cache_file_content = <<<EOF
<?php

if (!defined('ABSPATH')) die('No direct access allowed');

// WP-Optimize advanced-cache.php (written by version: $wpo_version) (do not change this line, it is used for correctness checks)

if (!defined('WPO_ADVANCED_CACHE')) define('WPO_ADVANCED_CACHE', true);

if (is_admin()) { return; }

\$possible_plugin_locations = array(
	defined('WP_PLUGIN_DIR') ? WP_PLUGIN_DIR.'/$plugin_basename/cache' : false,
	defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR.'/plugins/$plugin_basename/cache' : false,
	dirname(__FILE__).'/plugins/$plugin_basename/cache',
	'$cache_file_basename',
);

\$plugin_location = false;

foreach (\$possible_plugin_locations as \$possible_location) {
	if (false !== \$possible_location && @file_exists(\$possible_location.'/file-based-page-cache.php')) {
		\$plugin_location = \$possible_location;
		break;
	}
}

if (!defined('WPO_CACHE_DIR')) define('WPO_CACHE_DIR', WP_CONTENT_DIR.'$cache_path');
if (!defined('WPO_CACHE_CONFIG_DIR')) define('WPO_CACHE_CONFIG_DIR', WPO_CACHE_DIR.'/config');
if (!defined('WPO_CACHE_FILES_DIR')) define('WPO_CACHE_FILES_DIR', WP_CONTENT_DIR.'$cache_files_path');
if (false !== \$plugin_location) {
	if (!defined('WPO_CACHE_EXT_DIR')) define('WPO_CACHE_EXT_DIR', \$plugin_location.'/extensions');
} else {
	if (!defined('WPO_CACHE_EXT_DIR')) define('WPO_CACHE_EXT_DIR', '$cache_extensions_path');
}

if (!@file_exists(WPO_CACHE_CONFIG_DIR . '/$config_file_basename')) { return; }

\$GLOBALS['wpo_cache_config'] = @json_decode(file_get_contents(WPO_CACHE_CONFIG_DIR . '/$config_file_basename'), true);

if (empty(\$GLOBALS['wpo_cache_config'])) {
	include_once(WPO_CACHE_CONFIG_DIR . '/$config_file_basename');
}

if (empty(\$GLOBALS['wpo_cache_config']) || empty(\$GLOBALS['wpo_cache_config']['enable_page_caching'])) { return; }

if (false !== \$plugin_location) { include_once(\$plugin_location.'/file-based-page-cache.php'); }

EOF;
		// phpcs:enable
		$advanced_cache_filename = $this->get_advanced_cache_filename();

		// check if we can't write the advanced cache file
		// case 1: the directory is read-only and the file doesn't exist
		// case 2: the file is already exists but it's read-only
		if (!is_file($advanced_cache_filename) && !is_writable(dirname($advanced_cache_filename)) || (is_file($advanced_cache_filename) && !is_writable($advanced_cache_filename))) {
			$this->advanced_cache_file_writing_error = true;
			return false;
		}

		if (!file_put_contents($this->get_advanced_cache_filename(), $this->advanced_cache_file_content)) {
			$this->advanced_cache_file_writing_error = true;
			return false;
		}

		$this->advanced_cache_file_writing_error = false;
		return true;
	}

	/**
	 * Update advanced cache version if needed.
	 */
	public function maybe_update_advanced_cache() {

		if (!$this->is_enabled()) return;

		// from 3.0.17 we use more secure way to store cache config files and need update advanced-cache.php
		$advanced_cache_current_version = $this->get_advanced_cache_version();
		if ($advanced_cache_current_version && version_compare($advanced_cache_current_version, $this->_minimum_advanced_cache_file_version, '>=')) return;

		if (!$this->write_advanced_cache()) {
			add_action('admin_notices', array($this, 'notice_advanced_cache_autoupdate_error'));
		} else {
			$this->update_cache_config();
		}
	}

	/**
	 * Show notification when advanced-cache.php could not be updated.
	 */
	public function notice_advanced_cache_autoupdate_error() {
		$this->show_notice(__('The file advanced-cache.php needs to be updated, but the automatic process failed.', 'wp_optimize').
		' <a href="'.admin_url('admin.php?page=wpo_cache').'">'.__('Please try to re-enable WP-Optimize cache manually.', 'wp-optimize').'</a>', 'error');
	}

	/**
	 * Get WPO version number from advanced-cache.php file.
	 *
	 * @return bool|mixed
	 */
	public function get_advanced_cache_version() {
		if (!is_file($this->get_advanced_cache_filename())) return false;

		$version = false;
		$content = file_get_contents($this->get_advanced_cache_filename());

		if (preg_match('/WP\-Optimize advanced\-cache\.php \(written by version\: (.+)\)/Ui', $content, $match)) {
			$version = $match[1];
		}

		return $version;
	}

	/**
	 * Set WP_CACHE on or off in wp-config.php
	 *
	 * @param  boolean $status value of WP_CACHE.
	 * @return boolean true if the value was set, false otherwise
	 */
	private function write_wp_config($status = true) {

		if (defined('WP_CACHE') && WP_CACHE === $status) {
			return true;
		}

		$config_path = $this->_get_wp_config();

		// Couldn't find wp-config.php.
		if (!$config_path) {
			return false;
		}

		$config_file_string = file_get_contents($config_path);

		// Config file is empty. Maybe couldn't read it?
		if (empty($config_file_string)) {
			return false;
		}

		$config_file = preg_split("#(\n|\r\n)#", $config_file_string);
		$line_key    = false;

		foreach ($config_file as $key => $line) {
			if (!preg_match('/^\s*define\(\s*(\'|")([A-Z_]+)(\'|")(.*)/i', $line, $match)) {
				continue;
			}

			if ('WP_CACHE' === $match[2]) {
				$line_key = $key;
			}
		}

		if (false !== $line_key) {
			unset($config_file[$line_key]);
		}


		if ($status) {
			array_shift($config_file);
			array_unshift($config_file, '<?php', "define('WP_CACHE', true); // WP-Optimize Cache");
		}

		foreach ($config_file as $key => $line) {
			if ('' === $line) {
				unset($config_file[$key]);
			}
		}
		if (!file_put_contents($config_path, implode(PHP_EOL, $config_file))) {
			return false;
		}

		return true;
	}

	/**
	 * Verify we can write to the file system
	 *
	 * @return boolean
	 */
	private function verify_cache() {
		if (function_exists('clearstatcache')) {
			clearstatcache();
		}

		// First check wp-config.php.
		if (!$this->_get_wp_config() && !is_writable($this->_get_wp_config())) {
			$this->log("Unable to write to or find wp-config.php; please check file/folder permissions");
			return false;
		}

		$advanced_cache_file = untrailingslashit(WP_CONTENT_DIR).'/advanced-cache.php';
		
		// Now check wp-content. We need to be able to create files of the same user as this file.
		if ((!file_exists($advanced_cache_file) || false === strpos(file_get_contents($advanced_cache_file), 'WP-Optimize advanced-cache.php')) && !is_writable($advanced_cache_file) && !is_writable(untrailingslashit(WP_CONTENT_DIR))) {
			$this->log("Unable to write the file advanced-cache.php inside the wp-content folder; please check file/folder permissions");
			return false;
		}

		// If the cache and config directories exist, make sure they're writeable.
		if (file_exists(WPO_CACHE_DIR)) {
			if (!is_writable(WPO_CACHE_DIR)) {
				$this->log("Unable to write inside the cache folder; please check file/folder permissions");
				return false;
			}
		}

		if (file_exists(WPO_CACHE_FILES_DIR)) {
			if (!is_writable(WPO_CACHE_FILES_DIR)) {
				$this->log("Unable to write inside the cache files folder; please check file/folder permissions");
				return false;
			}
		}

		if (file_exists(WPO_CACHE_CONFIG_DIR)) {
			if (!is_writable(WPO_CACHE_CONFIG_DIR)) {
				$this->log("Unable to write inside the cache configuration folder; please check file/folder permissions");
				return false;
			}
		}

		return true;
	}

	/**
	 * Update cache config. Used to support 3d party plugins.
	 */
	public function update_cache_config() {
		// get current cache settings.
		$current_config = $this->config->get();
		// and call update to change if need cookies and query variable names.
		$this->config->update($current_config, true);
	}

	/**
	 * Delete information about cache size.
	 */
	public function delete_cache_size_information() {
		delete_transient('wpo_get_cache_size');
	}

	/**
	 * Get current cache size.
	 *
	 * @return array
	 */
	public function get_cache_size() {
		$cache_size = get_transient('wpo_get_cache_size');

		if (!empty($cache_size)) return $cache_size;

		$infos = $this->get_dir_infos(WPO_CACHE_FILES_DIR);
		$cache_size = array(
			'size' => $infos['size'],
			'file_count' => $infos['file_count']
		);

		set_transient('wpo_get_cache_size', $cache_size);

		return $cache_size;
	}

	/**
	 * Fetch directory informations.
	 *
	 * @param string $dir
	 * @return array
	 */
	private function get_dir_infos($dir) {
		$dir_size = 0;
		$file_count = 0;

		if (!is_dir($dir)) {
			return array('size' => 0, 'file_count' => 0);
		}

		$files = scandir($dir);

		foreach ($files as $file) {
			if ('.' == $file || '..' == $file) continue;

			$current_file = $dir.'/'.$file;

			if (is_dir($current_file)) {
				$sub_dir_infos = $this->get_dir_infos($current_file);
				$dir_size += $sub_dir_infos['size'];
				$file_count += $sub_dir_infos['file_count'];
			} elseif (is_file($current_file)) {
				$dir_size += filesize($current_file);
				$file_count++;
			}
		}

		return array('size' => $dir_size, 'file_count' => $file_count);
	}

	/**
	 * Returns the path to wp-config
	 *
	 * @return string|boolean wp-config.php path.
	 */
	private function _get_wp_config() {

		$config_path = false;

		foreach (get_included_files() as $filename) {
			if (preg_match('/(\\\\|\/)wp-config\.php$/i', $filename)) {
				$config_path = $filename;
				break;
			}
		}

		// WP-CLI doesn't include wp-config.php that's why we use function from WP-CLI to locate config file.
		if (!$config_path && is_callable('wpo_wp_cli_locate_wp_config')) {
			$config_path = wpo_wp_cli_locate_wp_config();
		}

		return $config_path;
	}

	/**
	 * Util to delete folders and/or files
	 *
	 * @param string $src
	 * @return boolean
	 */
	public static function delete($src) {

		return wpo_delete_files($src);

	}

	/**
	 * Delete cached files for specific url.
	 *
	 * @param string $url
	 * @param bool   $recursive If true child elements will deleted too
	 *
	 * @return bool
	 */
	public static function delete_cache_by_url($url, $recursive = false) {
		if (!defined('WPO_CACHE_FILES_DIR') || '' == $url) return;

		$path = trailingslashit(WPO_CACHE_FILES_DIR) . trailingslashit(wpo_get_url_path($url));

		return wpo_delete_files($path, $recursive);
	}

	/**
	 * Delete cached files for single post.
	 *
	 * @param integer $post_id The post ID
	 *
	 * @return bool
	 */
	public static function delete_single_post_cache($post_id) {
	
		if (!defined('WPO_CACHE_FILES_DIR')) return;
	
		$path = trailingslashit(WPO_CACHE_FILES_DIR) . trailingslashit(wpo_get_url_path(get_permalink($post_id)));

		return wpo_delete_files($path, false);
	}

	/**
	 * Delete cached home page files.
	 */
	public static function delete_homepage_cache() {
	
		if (!defined('WPO_CACHE_FILES_DIR')) return;
	
		$path = trailingslashit(WPO_CACHE_FILES_DIR) . trailingslashit(wpo_get_url_path(get_home_url(get_current_blog_id())));

		wpo_delete_files($path, false);
	}

	/**
	 * Admin actions
	 *
	 * @return void
	 */
	public function admin_init() {
		// Maybe update the advanced cache.
		if ((!defined('DOING_AJAX') || !DOING_AJAX) && current_user_can('update_plugins')) {
			$this->maybe_update_advanced_cache();
		}
	}

	/**
	 * Logs error messages
	 *
	 * @param  string $message
	 * @return null|void
	 */
	public function log($message) {
		if (isset($this->logger)) {
			$this->logger->log('ERROR', $message);
		} else {
			error_log($message);
		}
	}

	/**
	 * Returns an instance of the current class, creates one if it doesn't exist
	 *
	 * @return object
	 */
	public static function instance() {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

endif;
