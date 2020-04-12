<?php
if (!defined('ABSPATH')) die('No direct access allowed');

class WP_Optimize_Minify_Admin {

	private $wp_version_required = '4.5';

	/**
	 * Initialize, add actions and filters
	 *
	 * @return void
	 */
	public function __construct() {
		if (WPO_MINIFY_PHP_VERSION_MET) {
			// exclude processing for editors and administrators (fix editors)
			add_action('wp_optimize_admin_page_wpo_minify_status', array($this, 'check_permissions_admin_notices'));
		}

		add_action('wp_optimize_admin_page_wpo_minify_status', array($this, 'admin_notices_activation_errors'));
		// run admin things
		add_action('admin_init', array($this, 'admin_init'));
		add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));

		// This function runs when WordPress updates or installs/remove something. Forces new cache
		add_action('upgrader_process_complete', array('WP_Optimize_Minify_Cache_Functions', 'cache_increment'));
		add_action('after_switch_theme', array('WP_Optimize_Minify_Cache_Functions', 'cache_increment'));

		add_action('wp_optimize_register_admin_content', array($this, 'register_content'));
	}

	/**
	 * Register the content
	 *
	 * @return void
	 */
	public function register_content() {
		add_action('wp_optimize_admin_page_wpo_minify_status', array($this, 'output_status'), 20);
		add_action('wp_optimize_admin_page_wpo_minify_settings', array($this, 'output_settings'), 20);
		add_action('wp_optimize_admin_page_wpo_minify_advanced', array($this, 'output_advanced'), 20);
		add_action('wp_optimize_admin_page_wpo_minify_font', array($this, 'output_font_settings'), 20);
		add_action('wp_optimize_admin_page_wpo_minify_css', array($this, 'output_css_settings'), 20);
		add_action('wp_optimize_admin_page_wpo_minify_js', array($this, 'output_js_settings'), 20);
		add_action('wp_optimize_admin_page_wpo_minify_html', array($this, 'output_html_settings'), 20);
	}

	/**
	 * Load scripts for controlling the admin pages
	 *
	 * @param string $hook
	 * @return void
	 */
	public function admin_enqueue_scripts($hook) {
		$enqueue_version = (defined('WP_DEBUG') && WP_DEBUG) ? WPO_VERSION.'.'.time() : WPO_VERSION;
		$min_or_not = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
		$min_or_not_internal = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '-'. str_replace('.', '-', WPO_VERSION). '.min';
		
		wp_enqueue_script(
			'wp-optimize-minify-admin-purge',
			WPO_PLUGIN_URL.'js/minify-admin-purge' . $min_or_not_internal . '.js',
			array('jquery', 'wp-optimize-send-command'),
			$enqueue_version
		);
		wp_localize_script('wp-optimize-minify-admin-purge', 'wp_optimize_ajax_nonce', wp_create_nonce('wp-optimize-ajax-nonce'));

		if (preg_match('/wp\-optimize/i', $hook)) {
			wp_enqueue_script('wp-optimize-min-js', WPO_PLUGIN_URL.'js/minify' . $min_or_not_internal . '.js', array('jquery', 'wp-optimize-admin-js'), $enqueue_version);
		}
	}

	/**
	 * Admin init
	 *
	 * @return void
	 */
	public function admin_init() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		if ($wpo_minify_options['enabled'] && current_user_can('manage_options')) {
			add_action('admin_bar_menu', array($this, 'admin_bar_menu'), 100);
		}
	}

	/**
	 * Admin toolbar processing
	 *
	 * @return void
	 */
	public function admin_bar_menu() {
		global $wp_admin_bar;
		$wp_admin_bar->add_node(
			array(
				'parent' => 'wp-optimize-node',
				'id' => 'purge_minify_cache',
				'title' => __('Purge minify cache', 'wp-optimize'),
				'href' => "#",
				'meta' => array(
					'class' => 'separator',
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'id' => 'wpo-separator-minify',
				'parent' => 'wp-optimize-node',
				'meta' => array(
					'class' => 'separator',
				),
			)
		);
	}

	/**
	 * Conditionally runs upon the WP action admin_notices to display errors
	 *
	 * @return void
	 */
	public function admin_notices_activation_errors() {
		global $wp_version;
		include ABSPATH . WPINC . '/version.php';
		$errors = array();
		
		if (!WPO_MINIFY_PHP_VERSION_MET) {
			$errors[] = sprintf(__('WP-Optimize Minify requires PHP 5.4 or higher. You’re using version %s.', 'wp-optimize'), PHP_VERSION);
		}

		if (!extension_loaded('mbstring')) {
			$errors[] = __('WP-Optimize Minify requires the PHP mbstring module to be installed on the server; please ask your web hosting company for advice on how to enable it on your server.', 'wp-optimize');
		}
		
		if (version_compare($wp_version, $this->wp_version_required, '<')) {
			$errors[] = sprintf(__('WP-Optimize Minify requires WordPress version %s or higher. You’re using version %s.', 'wp-optimize'), $this->wp_version_required, $wp_version);
		}

		foreach ($errors as $error) {
			?>
			<div class="notice notice-error wpo-warning">
				<p><?php echo $error; ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Display an admin notice if the user has inadequate filesystem permissions
	 *
	 * @return void
	 */
	public function check_permissions_admin_notices() {
		// get cache path
		$cache_path = WP_Optimize_Minify_Cache_Functions::cache_path();
		$cache_dir = $cache_path['cachedir'];
		if (is_dir($cache_dir) && !is_writable($cache_dir)) {
			$chmod = substr(sprintf('%o', fileperms($cache_dir)), -4);
			?>
			<div class="notice notice-error wpo-warning">
				<p>
					<?php printf(__('WP-Optimize Minify needs write permissions on the folder %s.', 'wp-optimize'), "<strong>".htmlspecialchars($cache_dir)."</strpmg>"); ?>
				</p>
			</div>
			<div class="notice notice-error wpo-warning">
				<p>
					<?php printf(__('The current permissions for WP-Optimize Minify are chmod %s.', 'wp-optimize'), "<strong>$chmod</strong>"); ?>
				</p>
			</div>
			<div class="notice notice-error wpo-warning">
				<p>
					<?php
						printf(__('If you need something more than %s for it to work, then your server is probably misconfigured.', 'wp-optimize'), '<strong>775</strong>');
						echo " ";
						_e('Please contact your hosting provider.', 'wp-optimize');
					?>
				</p>
			</div>
			<?php
		}
	}

	/**
	 * Minify - Outputs the status tab
	 *
	 * @return void
	 */
	public function output_status() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		WP_Optimize()->include_template(
			'minify/status-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options,
				'show_information_notice' => !get_user_meta(get_current_user_id(), 'wpo-hide-minify-information-notice', true)
			)
		);
	}

	/**
	 * Minify - Outputs the font settings tab
	 *
	 * @return void
	 */
	public function output_font_settings() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		WP_Optimize()->include_template(
			'minify/font-settings-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options
			)
		);
	}

	/**
	 * Minify - Outputs the CSS settings tab
	 *
	 * @return void
	 */
	public function output_css_settings() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		WP_Optimize()->include_template(
			'minify/css-settings-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options
			)
		);
	}

	/**
	 * Minify - Outputs the JS settings tab
	 *
	 * @return void
	 */
	public function output_js_settings() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		WP_Optimize()->include_template(
			'minify/js-settings-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options
			)
		);
	}

	/**
	 * Minify - Outputs the HTML settings tab
	 *
	 * @return void
	 */
	public function output_html_settings() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		WP_Optimize()->include_template(
			'minify/html-settings-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options
			)
		);
	}

	/**
	 * Minify - Outputs the settings tab
	 *
	 * @return void
	 */
	public function output_settings() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		WP_Optimize()->include_template(
			'minify/settings-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options
			)
		);
	}

	/**
	 * Minify - Outputs the advanced tab
	 *
	 * @return void
	 */
	public function output_advanced() {
		$wpo_minify_options = wp_optimize_minify_config()->get();
		$files = false;
		if (apply_filters('wpo_minify_status_show_files_on_load', true) && WPO_MINIFY_PHP_VERSION_MET) {
			$files = WP_Optimize_Minify_Cache_Functions::get_cached_files();
		}

		WP_Optimize()->include_template(
			'minify/advanced-tab.php',
			false,
			array(
				'wpo_minify_options' => $wpo_minify_options,
				'files' => $files
			)
		);
	}
}
