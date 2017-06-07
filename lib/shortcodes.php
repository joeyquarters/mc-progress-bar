<?php
/**
 * Define the shortcodes used by the plugin
 *
 * @package         Mc_Progress_Bar
 * @since           0.1.0
 */

// ================================
// Create the complete progress bar
// ================================

/**
 * Handle the 'mc-progress-bar' shortcode
 * Outputs markup for a progress bar, requires
 * a list ID and a goal number
 */
add_shortcode( 'mc-progress-bar', 'mc_pb_render_mc_progress_bar' );
function mc_pb_render_mc_progress_bar($atts){

	if (!isset($atts['list_id']) || !isset($atts['goal'])){
		return false;
	}

	$list_count = mc_pb_get_list_member_count($atts['list_id']);

	if ($list_count){
		return mc_pb_create_progress_bar($list_count, $atts['goal']);
	}

}

/**
 * Create the actual progress bar markup
 */
function mc_pb_create_progress_bar($current_count, $goal_count){

	if (!$current_count || !$goal_count){
		return false;
	}

	$percentage = ($current_count / $goal_count) * 100;

	?>
		<div class="mc-progress">
			<div class="mc-progress-bar">
				<div class="mc-progress-bar__inner" role="progressbar" aria-valuenow="<?php echo number_format($percentage, 2); ?>" aria-valuemax="100" style="width: <?php echo number_format($percentage, 2) . '%'; ?>">
					<?php echo number_format($percentage, 2) . '%'; ?>
				</div>
			</div>
			<div class="mc-progress__current">
				<?php echo $current_count; ?>
				<span class="mc-progress__small">Signers</span>
			</div>
			<div class="mc-progress__goal">
				<?php echo $goal_count; ?>
				<span class="mc-progress__small">Goal</span>
			</div>
		</div>
	<?php
}

// ================================
// Output just the member count
//=================================

/**
 * Handle the 'mc-pb-count' shortcode
 * Useful for developers, in case you just want to grab the
 * list count and show it.
 */
add_shortcode( 'mc-pb-count', 'mc_pb_render_count_shortcode' );
function mc_pb_render_count_shortcode($atts){

	if (!isset($atts['list_id'])){
		return false;
	}

	$list_count = mc_pb_get_list_member_count($atts['list_id']);

	if ($list_count){
		return $list_count;
	}

}


