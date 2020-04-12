<?php if (!defined('WPO_VERSION'))  die('No direct access allowed'); ?>
<div class="wpo_section wpo_group<?php echo (!$wpo_minify_options['html_minification']) ? ' wpo-feature-is-disabled' : ''; ?>">
	<div id="wpo_settings_warnings"></div>
		
	<div class="wpo-fieldgroup wpo-show">
		<div class="wpo-fieldgroup__subgroup wpo_min_enable_minify">
			<div class="switch-container">
				<label class="switch">
					<input
						name="html_minification"
						id="wpo_min_enable_minify_html"
						class="wpo-save-setting"
						type="checkbox"
						value="true"
						<?php checked($wpo_minify_options['html_minification']);?>
					>
					<span class="slider round"></span>
				</label>
				<label for="wpo_min_enable_minify_html">
					<?php _e('Enable Minify for HTML', 'wp-optimize'); ?>
				</label>
			</div>
			<?php // Note: the comment added by WPO regarding cacheing will not be removed (it's added later in the process) ?>
			<p><?php _e('All HTML will be minified (removal of extra blank space), and all HTML comments will be removed.'); ?></p>
		</div>
	</div>
</div>
