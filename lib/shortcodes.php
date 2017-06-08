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

	$atts = shortcode_atts(
		array(
			'list_id'     => null,
			'goal'        => null,
			'title'       => 'Our Progress',
			'signer_text' => 'Signers',
			'goal_text'   => 'Goal'
		),
		$atts,
		'mc-progress-bar'
	);

	// list_id and goal numbers are required
	if (!isset($atts['list_id']) || !isset($atts['goal'])){
		return false;
	}

	$list_count = mc_pb_get_list_member_count($atts['list_id']);

	// Exit if we can't fetch a list count
	if (!$list_count){ return false; }

	$percentage = ( intval($list_count) / intval($atts['goal']) ) * 100;

	?>
		<div class="mc-progress">
			<h3 class="mc-progress__title"><?php echo $atts['title']; ?></h3>
			<div class="mc-progress-bar">
				<div class="mc-progress-bar__inner" role="progressbar" aria-valuenow="<?php echo number_format($percentage, 2); ?>" aria-valuemax="100" style="width: <?php echo number_format($percentage, 2) . '%'; ?>">
					<?php echo number_format($percentage) . '%'; ?>
				</div>
			</div>
			<div class="mc-progress__current">
				<span class="mc-progress__number"><?php echo number_format($list_count); ?></span>
				<?php echo $atts['signer_text']; ?>
			</div>
			<div class="mc-progress__goal">
				<span class="mc-progress__number"><?php echo number_format($atts['goal']); ?></span>
				<?php echo $atts['goal_text']; ?>
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


