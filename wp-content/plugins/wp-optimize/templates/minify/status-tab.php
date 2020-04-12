<?php if (!defined('WPO_VERSION')) die('No direct access allowed'); ?>
<div id="wp-optimize-minify-status" class="wpo_section wpo_group<?php echo (!$wpo_minify_options['enabled']) ? ' wpo-feature-is-disabled' : ''; ?>">
	<div id="wpo_settings_warnings"></div>
	<?php if ($show_information_notice) : ?>
		<div class="notice notice-warning wpo-warning is-dismissible below-h2 wp-optimize-minify-status-information-notice wpo-show">
			<p>
				<span class="dashicons dashicons-shield"></span>
				<strong><?php _e('CSS, JavaScript and HTML minification is an advanced feature.', 'wp-optimize'); ?></strong><br>
				<?php _ex('While enabling it will work just fine for most sites, it might need specific configuration to work properly on your website.', '"it" refers to the Minify feature.', 'wp-optimize'); ?><br>
				<?php _ex('If you encounter an issue and are not sure what to do, disable the feature and ask for help on the support forum.', '"it" refers to the Minify feature.', 'wp-optimize'); ?>
				<?php _ex('We will do our best to help you configure it.', '"it" refers to the Minify feature.', 'wp-optimize'); ?>
			</p>
		</div>
	<?php endif; ?>
	<div class="wpo-fieldgroup wpo-show">
		<div class="switch-container">
			<label class="switch">
				<input
					name="enabled"
					id="wpo_min_enable_minify"
					class="wpo-save-setting"
					type="checkbox"
					value="true"
					<?php echo WPO_MINIFY_PHP_VERSION_MET ? '' : 'disabled'; ?>
					<?php checked($wpo_minify_options['enabled']); ?>
				>
				<span class="slider round"></span>
			</label>
			<label for="wpo_min_enable_minify">
				<?php if (WPO_MINIFY_PHP_VERSION_MET) {
					_e('Enable Minify', 'wp-optimize');
				} else {
					echo __('The PHP version on your server is too old.', 'wp-optimize').' '.__('Update PHP to enable minification of JS, CSS and HTML on this website', 'wp-optimize');
					?>
					<span tabindex="0" data-tooltip="<?php esc_attr_e('PHP version requirement (5.4 minimum) not met', 'wp-optimize');?>"><span class="dashicons dashicons-editor-help"></span></span>
					<?php
				}
				?>
			</label>
		</div>
		<p><?php _e('By default, JavaScript and CSS on this website will be concatenated and minified and HTML will be minified.', 'wp-optimize'); ?> <?php _e('You can edit the settings in the tabs above to meet your requirements.', 'wp-optimize'); ?></p>
	</div>

	<div class="wpo-fieldgroup">
		<p class="actions">
			<input
				class="button button-primary purge_minify_cache"
				type="submit"
				value="<?php esc_attr_e('Regenerate minified files', 'wp-optimize'); ?>"
				<?php echo WPO_MINIFY_PHP_VERSION_MET ? '' : 'disabled'; ?>
			 />
			<span> (<?php _e('This will also purge the page cache', 'wp-optimize'); ?>)</span>
			<img class="wpo_spinner" src="<?php echo esc_attr(admin_url('images/spinner-2x.gif')); ?>" alt="...">
			<span class="save-done dashicons dashicons-yes display-none"></span>
		</p>
		<p>
			<?php _e('Minify cache size:', 'wp-optimize'); ?>
			<strong id="wpo_min_cache_size">
				<?php echo WPO_MINIFY_PHP_VERSION_MET ? WP_Optimize_Minify_Cache_Functions::get_cachestats() : 0; ?>
			</strong>
		</p>
		<p>
			<?php _e('Last Minify cache update:', 'wp-optimize'); ?>
			<strong id="wpo_min_cache_time">
				<?php
				if (empty($wpo_minify_options['last-cache-update'])) {
					_e('Never.', 'wp-optimize');
				} else {
					echo WP_Optimize_Minify_Cache_Functions::format_date_time($wpo_minify_options['last-cache-update']);
				}
				?>
			</strong>
		</p>
		<?php if ($wpo_minify_options['debug']) : ?>
		<p class="actions">
			<input
				class="button minify_increment_cache"
				type="submit"
				value="<?php esc_attr_e('Increment cache', 'wp-optimize'); ?>"
				<?php echo WPO_MINIFY_PHP_VERSION_MET ? '' : 'disabled'; ?>
			 />
			<img class="wpo_spinner" src="<?php echo esc_attr(admin_url('images/spinner-2x.gif')); ?>" alt="...">
			<span class="save-done dashicons dashicons-yes display-none"></span>
		</p>
		<p class="actions">
			<input
				class="button purge_all_minify_cache"
				type="submit"
				value="<?php esc_attr_e('Delete everything', 'wp-optimize'); ?>"
				<?php echo WPO_MINIFY_PHP_VERSION_MET ? '' : 'disabled'; ?>
			/>
			<img class="wpo_spinner" src="<?php echo esc_attr(admin_url('images/spinner-2x.gif')); ?>" alt="...">
			<span class="save-done dashicons dashicons-yes display-none"></span>
			<strong tabindex="0" data-tooltip="<?php _e('If you are using an unsupported cache plugin, then you will also need to purge your page cache when doing this.', 'wp-optimize');?>"><span class="dashicons dashicons-editor-help"></span></strong>
		</p>
		<?php endif; ?>
	</div>
</div><!-- end #wp-optimize-minify-status -->
