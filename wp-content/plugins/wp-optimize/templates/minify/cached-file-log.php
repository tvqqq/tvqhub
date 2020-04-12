<?php if (!defined('WPO_VERSION')) die('No direct access allowed'); ?>
<h5><?php echo esc_html($log->header); ?></h5>
<ul><?php
foreach ((array) $log->files as $handle => $file) {
	echo '<li'.($file->success ? '' : ' class="failed"').'><span class="wpo_min_file_url">'.htmlspecialchars($file->url).'</span>';
	if (property_exists($file, 'debug')) echo '<span class="wpo_min_file_debug">'.htmlspecialchars($file->debug).'</span>';
	echo '</li>';
}
?>
</ul>