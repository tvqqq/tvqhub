<?php
if (!defined('ABSPATH')) die('No direct access allowed');

if (!class_exists('WP_Optimize_Minify_Config')) require_once(dirname(__FILE__) . '/class-wp-optimize-minify-config.php');

/**
 * All cache commands that are intended to be available for calling from any sort of control interface (e.g. wp-admin, UpdraftCentral) go in here. All public methods should either return the data to be returned, or a WP_Error with associated error code, message and error data.
 */
class WP_Optimize_Minify_Commands {

	/**
	 * List all cache files
	 *
	 * @param array $data - The $_POST data
	 * @return array
	 */
	public function get_minify_cached_files($data = array()) {
		if (!WPO_MINIFY_PHP_VERSION_MET) return array('error' => __('WP-Optimize Minify requires a higher PHP version', 'wp-optimize'));
		$stamp = isset($data['stamp']) ? $data['stamp'] : 0;
		$files = WP_Optimize_Minify_Cache_Functions::get_cached_files($stamp, false);
		$files['js'] = array_map(array('WP_Optimize_Minify_Cache_Functions', 'format_file_logs'), $files['js']);
		$files['css'] = array_map(array('WP_Optimize_Minify_Cache_Functions', 'format_file_logs'), $files['css']);
		return $files;
	}

	/**
	 * Removes the entire cache dir.
	 * Use with caution, as cached html may still reference those files.
	 *
	 * @return array
	 */
	public function purge_all_minify_cache() {
		if (!WPO_MINIFY_PHP_VERSION_MET) return array('error' => __('WP-Optimize Minify requires a higher PHP version', 'wp-optimize'));
		WP_Optimize_Minify_Cache_Functions::purge();
		$others = WP_Optimize_Minify_Cache_Functions::purge_others();
		$message = array(
			__('The minification cache was deleted.', 'wp-optimize'),
			strip_tags($others, '<strong>'),
		);
		$message = array_filter($message);
		return array(
			'success' => true,
			'message' => implode("\n", $message)
		);
	}

	/**
	 * Forces a new Cache to be built
	 *
	 * @return array
	 */
	public function minify_increment_cache() {
		if (!WPO_MINIFY_PHP_VERSION_MET) return array('error' => __('WP-Optimize Minify requires a higher PHP version', 'wp-optimize'));
		WP_Optimize_Minify_Cache_Functions::cache_increment();
		return array(
			'success' => true
		);
	}

	/**
	 * Purge the cache
	 *
	 * @return array
	 */
	public function purge_minify_cache() {
		if (!WPO_MINIFY_PHP_VERSION_MET) return array('error' => __('WP-Optimize Minify requires a higher PHP version', 'wp-optimize'));
		// deletes temp files and old caches incase CRON isn't working
		WP_Optimize_Minify_Cache_Functions::cache_increment();
		$state = WP_Optimize_Minify_Cache_Functions::purge_temp_files();
		$old = WP_Optimize_Minify_Cache_Functions::purge_old();
		$others = WP_Optimize_Minify_Cache_Functions::purge_others();

		$notice = array(
			__('All caches from WP-Optimize Minify have been purged.', 'wp-optimize'),
			strip_tags($others, '<strong>'),
		);
		$notice = array_filter($notice);
		$notice = json_encode($notice); // encode

		return array(
			'result' => 'caches cleared',
			'others' => $others,
			'state' => $state,
			'message' => $notice,
			'old' => $old
		);
	}

	/**
	 * Save options to the config
	 *
	 * @param array $data
	 * @return array
	 */
	public function save_minify_settings($data) {

		$new_data = array();
		foreach ($data as $key => $value) {
			if ('true' === $value) {
				$new_data[$key] = true;
			} elseif ('false' === $value) {
				$new_data[$key] = false;
			} else {
				$new_data[$key] = $value;
			}
		}

		if (!class_exists('WP_Optimize_Minify_Config')) return array(
			'success' => false,
			'message' => "WP_Optimize_Minify_Config class doesn't exist",
		);
		$working = wp_optimize_minify_config()->update($new_data);
		if (!$working) {
			return array(
				'success' => false,
				'error' => 'failed to save'
			);
		}
		WP_Optimize_Minify_Cache_Functions::cache_increment();
		WP_Optimize_Minify_Cache_Functions::purge_others();
		return array(
			'success' => true
		);
	}

	/**
	 * Hide the information notice for the current user
	 *
	 * @return array
	 */
	public function hide_minify_notice() {
		return array(
			'success' => update_user_meta(get_current_user_id(), 'wpo-hide-minify-information-notice', true)
		);
	}

	/**
	 * Get the current status
	 *
	 * @return array
	 */
	public function get_status() {
		$config = wp_optimize_minify_config()->get();
		return array(
			'enabled' => $config['enabled'],
			'js' => $config['enable_js'],
			'css' => $config['enable_css'],
			'html' => $config['html_minification'],
			'stats' => $this->get_minify_cached_files()
		);
	}
}
