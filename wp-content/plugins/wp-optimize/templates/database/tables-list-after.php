<?php
if (!defined('WPO_VERSION')) die('No direct access allowed');

if ($load_data) {
	$optimizer = WP_Optimize()->get_optimizer();
	list ($db_size, $total_gain) = $optimizer->get_current_db_size();
}

?>
<h3><?php _e('Total size of database:', 'wp-optimize'); ?> <span id="optimize_current_db_size"><?php
	if ($load_data) {
		echo $db_size;
	} else {
		echo '...';
	}
?></span></h3>

<?php
if ($optimize_db) {
	?>

	<h3><?php _e('Optimization results:', 'wp-optimize'); ?></h3>
	<p style="color: #0000ff;" id="optimization_table_total_gain">
	<?php
	if ($total_gain > 0) {
		echo __('Total space saved:', 'wp-optimize').' <span>'.$wp_optimize->format_size($total_gain).'</span> ';
		$optimizer->update_total_cleaned(strval($total_gain));
	}
	?>
	</p>
	<?php
}


