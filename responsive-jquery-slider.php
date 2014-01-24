<?php
/*
Plugin Name: Responsive jQuery Slider
Version: 1.0.1
Description: Responsive jQuery Slider - jQuery Cycle 2 with Animate.css with some really cool animations.
Author: CHR Designer
Author URI: http://www.chrdesigner.com
Plugin URI: http://wordpress.org/plugins/responsive-jquery-slider/
License: A slug describing license associated with the plugin (usually GPL2)
Text Domain: responsive-jquery-slider
Domain Path: /languages/
*/

load_plugin_textdomain( 'responsive-jquery-slider', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );

require_once('custom-post-responsive-jquery-slider.php');

function chr_script_rjs() {
	wp_enqueue_script(array('jquery'));
    wp_register_script('jquery-cycle2', plugins_url('/script/jquery.cycle2.js' , __FILE__ ), array('jquery'));
    wp_enqueue_script('jquery-cycle2');
    wp_register_style( 'style-animate', plugins_url('/style/animate-min.css' , __FILE__ ) );
	wp_enqueue_style( 'style-animate' );
    wp_register_style( 'font-awesome', plugins_url('/style/font-awesome.min.css' , __FILE__ ) );
	wp_enqueue_style( 'font-awesome' );
	wp_register_style( 'default-styles', plugins_url('/style/min-styles.css' , __FILE__ ) );
	wp_enqueue_style( 'default-styles' );
}
add_action( 'wp_enqueue_scripts', 'chr_script_rjs' );

function custom_responsive_slider_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'slider_image' => __('Slider Image', 'responsive-jquery-slider'),
        'title' => __('Title', 'responsive-jquery-slider'),
        'date' => __('Date', 'responsive-jquery-slider')
     );
    return $columns;
}
add_filter('manage_responsive-slider_posts_columns' , 'custom_responsive_slider_columns');

function custom_responsive_slider_columns_data( $column, $post_id ) {
    switch ( $column ) {
    case 'slider_image':
    	$image_id =  get_post_meta( $post_id, '_image_id', true );
    	$image_src = wp_get_attachment_url( $image_id );
        echo '<a href="'. get_edit_post_link($post_id) .'" title="'. get_the_title() .'"><img id="book_image" src="'. $image_src .'" style="max-width:50%;" /></a>';
        break;
    }
}
add_action( 'manage_responsive-slider_posts_custom_column' , 'custom_responsive_slider_columns_data', 10, 2 ); 

/*/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Start - Settings Page - Responsive jQuery Slider//////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

$rjs_options = array(
	'rjs_auto_height'      => 'no',
	'rjs_size_height'      => '400',
	'rjs_show_slider' 	   => '3',
	'rjs_pause_on_hover'   => 'true',
	'rjs_arrow'  		   => 'true',
	'rjs_timeout' 		   => '8000',
	'rjs_speed' 		   => '800',
	'rjs_effects_js' 	   => 'fadeout',
	'rjs_effects_style_c1' => 'fadeInLeft',
	'rjs_effects_style_c2' => 'fadeInLeft',
	'rjs_effects_style_c3' => 'fadeInUp',
	'rjs_effects_style_c4' => 'fadeInLeft',
	'rjs_pagination'	   => 'false',
	'rjs_shadow'	       => 'true',
	'rjs_twitter' 		   => '',
	'rjs_facebook' 		   => '',
	'rjs_linkedin' 		   => '',
	'rjs_plus' 			   => ''
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function rjs_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'rjs_theme_options', 'rjs_options', 'rjs_validate_options' );
}

add_action( 'admin_init', 'rjs_register_settings' );

$rjs_auto_height = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __('Yes', 'responsive-jquery-slider')
	),
	'no' => array(
		'value' => 'no',
		'label' => __('No', 'responsive-jquery-slider')
	),
);

$rjs_slider_per_page = array(
	'-1' => array(
		'value' => '-1',
		'label' => __('All', 'responsive-jquery-slider')
	),
	'1' => array(
		'value' => '1',
		'label' => '1'
	),
	'2' => array(
		'value' => '2',
		'label' => '2'
	),
	'3' => array(
		'value' => '3',
		'label' => '3'
	),
	'4' => array(
		'value' => '4',
		'label' => '4'
	),
	'5' => array(
		'value' => '5',
		'label' => '5'
	),
	'6' => array(
		'value' => '6',
		'label' => '6'
	),
	'7' => array(
		'value' => '7',
		'label' => '7'
	),
	'8' => array(
		'value' => '8',
		'label' => '8'
	),
	'9' => array(
		'value' => '9',
		'label' => '9'
	),
	'10' => array(
		'value' => '10',
		'label' => '10'
	),
);

$rjs_pause_on_hover = array(
	'true' => array(
		'value' => 'true',
		'label' => __('True', 'responsive-jquery-slider')
	),
	'false' => array(
		'value' => 'false',
		'label' => __('False', 'responsive-jquery-slider')
	),
);

$rjs_arrow = array(
	'true' => array(
		'value' => 'true',
		'label' => __('True', 'responsive-jquery-slider')
	),
	'false' => array(
		'value' => 'false',
		'label' => __('False', 'responsive-jquery-slider')
	),
);

$rjs_select_effects_js = array(
	'fadeout' => array(
		'value' => 'fadeout',
		'label' => 'fadeout'
	),
	'scrollHorz' => array(
		'value' => 'scrollHorz',
		'label' => 'scrollHorz'
	),
	'tileSlide' => array(
		'value' => 'tileSlide',
		'label' => 'tileSlide'
	),
	'tileBlind' => array(
		'value' => 'tileBlind',
		'label' => 'tileBlind'
	),
	'flipHorz' => array(
		'value' => 'flipHorz',
		'label' => 'flipHorz'
	),
	'flipVert' => array(
		'value' => 'flipVert',
		'label' => 'flipVert'
	),
	'shuffle' => array(
		'value' => 'shuffle',
		'label' => 'shuffle'
	),
);

$rjs_select_effects_style_c1 = array( 'bounceIn' => array('value' => 'bounceIn', 'label' => 'bounceIn'), 'bounceInUp' => array('value' => 'bounceInUp', 'label' => 'bounceInUp'), 'bounceInRight' => array('value' => 'bounceInRight', 'label' => 'bounceInRight'), 'bounceInDown' => array('value' => 'bounceInDown', 'label' => 'bounceInDown'), 'fadeIn' => array('value' => 'fadeIn', 'label' => 'fadeIn'), 'fadeInUp' => array('value' => 'fadeInUp', 'label' => 'fadeInUp'), 'fadeInRight' => array('value' => 'fadeInRight', 'label' => 'fadeInRight'), 'fadeInDown' => array('value' => 'fadeInDown', 'label' => 'fadeInDown'), 'fadeInLeft' => array('value' => 'fadeInLeft', 'label' => 'fadeInLeft'), 'flipInX' => array('value' => 'flipInX', 'label' => 'flipInX'), 'flipInY' => array('value' => 'flipInY', 'label' => 'flipInY'), 'rollIn' => array('value' => 'rollIn', 'label' => 'rollIn'), 'rotateIn' => array('value' => 'rotateIn', 'label' => 'rotateIn'), 'rotateInUpRight' => array('value' => 'rotateInUpRight', 'label' => 'rotateInUpRight'), 'rotateInUpLeft' => array('value' => 'rotateInUpLeft', 'label' => 'rotateInUpLeft'), 'rotateInDownRight' => array('value' => 'rotateInDownRight', 'label' => 'rotateInDownRight'), 'rotateInDownLeft' => array('value' => 'rotateInDownLeft', 'label' => 'rotateInDownLeft'), 'lightSpeedIn' => array('value' => 'lightSpeedIn', 'label' => 'lightSpeedIn'), );
$rjs_select_effects_style_c2 = array( 'bounceIn' => array('value' => 'bounceIn', 'label' => 'bounceIn'), 'bounceInUp' => array('value' => 'bounceInUp', 'label' => 'bounceInUp'), 'bounceInRight' => array('value' => 'bounceInRight', 'label' => 'bounceInRight'), 'bounceInDown' => array('value' => 'bounceInDown', 'label' => 'bounceInDown'), 'fadeIn' => array('value' => 'fadeIn', 'label' => 'fadeIn'), 'fadeInUp' => array('value' => 'fadeInUp', 'label' => 'fadeInUp'), 'fadeInRight' => array('value' => 'fadeInRight', 'label' => 'fadeInRight'), 'fadeInDown' => array('value' => 'fadeInDown', 'label' => 'fadeInDown'), 'fadeInLeft' => array('value' => 'fadeInLeft', 'label' => 'fadeInLeft'), 'flipInX' => array('value' => 'flipInX', 'label' => 'flipInX'), 'flipInY' => array('value' => 'flipInY', 'label' => 'flipInY'), 'rollIn' => array('value' => 'rollIn', 'label' => 'rollIn'), 'rotateIn' => array('value' => 'rotateIn', 'label' => 'rotateIn'), 'rotateInUpRight' => array('value' => 'rotateInUpRight', 'label' => 'rotateInUpRight'), 'rotateInUpLeft' => array('value' => 'rotateInUpLeft', 'label' => 'rotateInUpLeft'), 'rotateInDownRight' => array('value' => 'rotateInDownRight', 'label' => 'rotateInDownRight'), 'rotateInDownLeft' => array('value' => 'rotateInDownLeft', 'label' => 'rotateInDownLeft'), 'lightSpeedIn' => array('value' => 'lightSpeedIn', 'label' => 'lightSpeedIn'), );
$rjs_select_effects_style_c3 = array( 'bounceIn' => array('value' => 'bounceIn', 'label' => 'bounceIn'), 'bounceInUp' => array('value' => 'bounceInUp', 'label' => 'bounceInUp'), 'bounceInRight' => array('value' => 'bounceInRight', 'label' => 'bounceInRight'), 'bounceInDown' => array('value' => 'bounceInDown', 'label' => 'bounceInDown'), 'fadeIn' => array('value' => 'fadeIn', 'label' => 'fadeIn'), 'fadeInUp' => array('value' => 'fadeInUp', 'label' => 'fadeInUp'), 'fadeInRight' => array('value' => 'fadeInRight', 'label' => 'fadeInRight'), 'fadeInDown' => array('value' => 'fadeInDown', 'label' => 'fadeInDown'), 'fadeInLeft' => array('value' => 'fadeInLeft', 'label' => 'fadeInLeft'), 'flipInX' => array('value' => 'flipInX', 'label' => 'flipInX'), 'flipInY' => array('value' => 'flipInY', 'label' => 'flipInY'), 'rollIn' => array('value' => 'rollIn', 'label' => 'rollIn'), 'rotateIn' => array('value' => 'rotateIn', 'label' => 'rotateIn'), 'rotateInUpRight' => array('value' => 'rotateInUpRight', 'label' => 'rotateInUpRight'), 'rotateInUpLeft' => array('value' => 'rotateInUpLeft', 'label' => 'rotateInUpLeft'), 'rotateInDownRight' => array('value' => 'rotateInDownRight', 'label' => 'rotateInDownRight'), 'rotateInDownLeft' => array('value' => 'rotateInDownLeft', 'label' => 'rotateInDownLeft'), 'lightSpeedIn' => array('value' => 'lightSpeedIn', 'label' => 'lightSpeedIn'), );
$rjs_select_effects_style_c4 = array( 'bounceIn' => array('value' => 'bounceIn', 'label' => 'bounceIn'), 'bounceInUp' => array('value' => 'bounceInUp', 'label' => 'bounceInUp'), 'bounceInRight' => array('value' => 'bounceInRight', 'label' => 'bounceInRight'), 'bounceInDown' => array('value' => 'bounceInDown', 'label' => 'bounceInDown'), 'fadeIn' => array('value' => 'fadeIn', 'label' => 'fadeIn'), 'fadeInUp' => array('value' => 'fadeInUp', 'label' => 'fadeInUp'), 'fadeInRight' => array('value' => 'fadeInRight', 'label' => 'fadeInRight'), 'fadeInDown' => array('value' => 'fadeInDown', 'label' => 'fadeInDown'), 'fadeInLeft' => array('value' => 'fadeInLeft', 'label' => 'fadeInLeft'), 'flipInX' => array('value' => 'flipInX', 'label' => 'flipInX'), 'flipInY' => array('value' => 'flipInY', 'label' => 'flipInY'), 'rollIn' => array('value' => 'rollIn', 'label' => 'rollIn'), 'rotateIn' => array('value' => 'rotateIn', 'label' => 'rotateIn'), 'rotateInUpRight' => array('value' => 'rotateInUpRight', 'label' => 'rotateInUpRight'), 'rotateInUpLeft' => array('value' => 'rotateInUpLeft', 'label' => 'rotateInUpLeft'), 'rotateInDownRight' => array('value' => 'rotateInDownRight', 'label' => 'rotateInDownRight'), 'rotateInDownLeft' => array('value' => 'rotateInDownLeft', 'label' => 'rotateInDownLeft'), 'lightSpeedIn' => array('value' => 'lightSpeedIn', 'label' => 'lightSpeedIn'), );

$rjs_pagination = array(
	'false' => array(
		'value' => 'false',
		'label' => __('Dotted', 'responsive-jquery-slider')
	),
	'true' => array(
		'value' => 'true',
		'label' => __('Number', 'responsive-jquery-slider')
	),
);

$rjs_shadow = array(
	'true' => array(
		'value' => 'true',
		'label' => __('Yes', 'responsive-jquery-slider')
	),
	'false' => array(
		'value' => 'false',
		'label' => __('No', 'responsive-jquery-slider')
	),
);

function rjs_plugin_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Responsive jQuery Slider', 'RJS Settings', 'edit_theme_options', 'rjs_settings', 'rjs_plugin_options_page' );
}

add_action( 'admin_menu', 'rjs_plugin_options' );

// Function to generate options page
function rjs_plugin_options_page() {
	global $rjs_options, $rjs_auto_height, $rjs_slider_per_page, $rjs_pause_on_hover, $rjs_arrow, $rjs_select_effects_js, $rjs_select_effects_style_c1, $rjs_select_effects_style_c2, $rjs_select_effects_style_c3, $rjs_select_effects_style_c4, $rjs_pagination, $rjs_shadow;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted.
	?>

	<div class="wrap">
		
		<?php screen_icon(); echo "<h2>" . __( 'Responsive jQuery Slider - Settings','responsive-jquery-slider' ) . "</h2>"; ?>
	

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'rjs_options', $rjs_options ); ?>
	
	<?php settings_fields( 'rjs_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>
	
	<h3><?php echo __('Default Settings Responsive jQuery Slider','responsive-jquery-slider' );?></h3>
	
	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
		
		<tr valign="top">
			<th scope="row"><label for="rjs_size_wight"><?php echo __('Auto Height*','responsive-jquery-slider' );?></label></th>
			<td class="show-and-hide-content">
				<script type="text/javascript">
					jQuery( document ).ready(function() {
						jQuery("div#ifYes").hide();
						jQuery('.show-and-hide-content').click(function () {    
						    if (jQuery('input.autosize-no:checked').prop('checked')) {
						        jQuery(this).find('div#ifYes').show('slideToggle');
						    }
						    else{
						        jQuery(this).find('div#ifYes').hide('slideToggle');
						    }
						}); 
						if (jQuery('input.autosize-no:checked').prop('checked')) {
							jQuery(this).find('div#ifYes').css("display", "block");
						}
					});
				</script>
				<?php foreach( $rjs_auto_height as $auto_height ) : ?>
				<input type="radio" class="autosize-<?php echo $auto_height['value']; ?>" id="<?php echo $auto_height['value'].'Check'; ?>" onclick="javascript:yesnoCheck();" name="rjs_options[rjs_auto_height]" value="<?php esc_attr_e( $auto_height['value'] ); ?>" <?php checked( $settings['rjs_auto_height'], $auto_height['value'] ); ?> />
				<label for="<?php echo $auto_height['value'].'Check'; ?>"><?php echo $auto_height['label']; ?></label><br />
				<?php endforeach; ?>
				
			    <div id="ifYes">
			        <input id="rjs_size_height" name="rjs_options[rjs_size_height]" type="text" value="<?php  esc_attr_e($settings['rjs_size_height']); ?>" style="width: 60px;" /> px
			    </div>
				<em style="font-size: 11px;"><?php echo __('*With you select the option Yes, the slider will be Full Screen','responsive-jquery-slider' );?></em>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="show_slider"><?php echo __('Display Sliders','responsive-jquery-slider' );?></label></th>
			<td>
				<select id="show_slider" name="rjs_options[rjs_show_slider]">
				<?php
			    foreach( $rjs_slider_per_page as $slider_per_page ) :
			    	$selected = ''; if ( $slider_per_page['value'] == $settings['rjs_show_slider'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $slider_per_page['value'] . '" ' . $selected . '>' . $slider_per_page['label'] . '</option>';
			    endforeach;
			    ?>
				</select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="pause_on_hover"><?php echo __('Pause on hover','responsive-jquery-slider' );?></label></th>
			<td>
				<select id="pause_on_hover" name="rjs_options[rjs_pause_on_hover]">
				<?php
			    foreach( $rjs_pause_on_hover as $pause_on_hover ) :
			    	$selected = ''; if ( $pause_on_hover['value'] == $settings['rjs_pause_on_hover'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $pause_on_hover['value'] . '" ' . $selected . '>' . $pause_on_hover['label'] . '</option>';
			    endforeach;
			    ?>
				</select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="arrow"><?php echo __('Show Arrows','responsive-jquery-slider' );?></label></th>
			<td>
				<select id="arrow" name="rjs_options[rjs_arrow]">
				<?php
			    foreach( $rjs_arrow as $arrow ) :
			    	$selected = ''; if ( $arrow['value'] == $settings['rjs_arrow'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $arrow['value'] . '" ' . $selected . '>' . $arrow['label'] . '</option>';
			    endforeach;
			    ?>
				</select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="timeout"><?php echo __('Timeout','responsive-jquery-slider' );?></label></th>
			<td>
				<input id="timeout" name="rjs_options[rjs_timeout]" type="text" value="<?php esc_attr_e($settings['rjs_timeout']); ?>" style="width: 60px;" />
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><label for="speed"><?php echo __('Speed','responsive-jquery-slider' );?></label></th>
			<td>
				<input id="speed" name="rjs_options[rjs_speed]" type="text" value="<?php esc_attr_e($settings['rjs_speed']); ?>" style="width: 60px;" />
			</td>
		</tr>
	
	</table>
	
	<h3><?php echo __('Effects Transition for Image/Text/Button','responsive-jquery-slider' );?></h3>
	
	<table class="form-table">
		
		<tr valign="top">
			<th scope="row"><?php echo __('Image','responsive-jquery-slider' );?></th>
			<td>
				<select id="effects_js" name="rjs_options[rjs_effects_js]">
			    <?php
			    foreach( $rjs_select_effects_js as $effects_js ) :
			    	$selected = ''; if ( $effects_js['value'] == $settings['rjs_effects_js'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $effects_js['value'] . '" ' . $selected . '>' . $effects_js['label'] . '</option>';
			    endforeach;
			    ?>
			    </select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php echo __('Caption 1','responsive-jquery-slider' );?></th>
			<td>
				<select id="effects_style" name="rjs_options[rjs_effects_style_c1]">
			    <?php
			    foreach( $rjs_select_effects_style_c1 as $effects_style_c1 ) :
			    	$selected = ''; if ( $effects_style_c1['value'] == $settings['rjs_effects_style_c1'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $effects_style_c1['value'] . '" ' . $selected . '>' . $effects_style_c1['label'] . '</option>';
			    endforeach;
			    ?>
			    </select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php echo __('Caption 2','responsive-jquery-slider' );?></th>
			<td>
				<select id="effects_style" name="rjs_options[rjs_effects_style_c2]">
			    <?php
			    foreach( $rjs_select_effects_style_c2 as $effects_style_c2 ) :
			    	$selected = ''; if ( $effects_style_c2['value'] == $settings['rjs_effects_style_c2'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $effects_style_c2['value'] . '" ' . $selected . '>' . $effects_style_c2['label'] . '</option>';
			    endforeach;
			    ?>
			    </select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php echo __('Caption 3','responsive-jquery-slider' );?></th>
			<td>
				<select id="effects_style" name="rjs_options[rjs_effects_style_c3]">
			    <?php
			    foreach( $rjs_select_effects_style_c3 as $effects_style_c3 ) :
			    	$selected = ''; if ( $effects_style_c3['value'] == $settings['rjs_effects_style_c3'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $effects_style_c3['value'] . '" ' . $selected . '>' . $effects_style_c3['label'] . '</option>';
			    endforeach;
			    ?>
			    </select>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php echo __('Button','responsive-jquery-slider' );?></th>
			<td>
				<select id="effects_style" name="rjs_options[rjs_effects_style_c4]">
			    <?php
			    foreach( $rjs_select_effects_style_c4 as $effects_style_c4 ) :
			    	$selected = ''; if ( $effects_style_c4['value'] == $settings['rjs_effects_style_c4'] ) $selected = 'selected="selected"';
			        echo '<option style="padding-right: 10px;" value="' . $effects_style_c4['value'] . '" ' . $selected . '>' . $effects_style_c4['label'] . '</option>';
			    endforeach;
			    ?>
			    </select>
			</td>
		</tr>
		
	</table>
	
	<h3><?php echo __('Style for Pagination and Shadow','responsive-jquery-slider' );?></h3>
	
	<table class="form-table">
		<tr valign="top"><th scope="row"><?php echo __('Pagination per','responsive-jquery-slider' );?></th>
			<td>
			<?php foreach( $rjs_pagination as $pagination ) : ?>
				<input type="radio" id="<?php echo 'pagination-' . $pagination['value']; ?>" name="rjs_options[rjs_pagination]" value="<?php esc_attr_e( $pagination['value'] ); ?>" <?php checked( $settings['rjs_pagination'], $pagination['value'] ); ?> />
				<label for="<?php echo 'pagination-' . $pagination['value']; ?>"><?php echo $pagination['label']; ?></label><br />
			<?php endforeach; ?>
			</td>
		</tr>
		
		<tr valign="top"><th scope="row"><?php echo __('Display Shadow','responsive-jquery-slider' );?></th>
			<td>
			<?php foreach( $rjs_shadow as $shadow ) : ?>
				<input type="radio" id="<?php echo 'shadow-' . $shadow['value']; ?>" name="rjs_options[rjs_shadow]" value="<?php esc_attr_e( $shadow['value'] ); ?>" <?php checked( $settings['rjs_shadow'], $shadow['value'] ); ?> />
				<label for="<?php echo 'shadow-' . $shadow['value']; ?>"><?php echo $shadow['label']; ?></label><br />
			<?php endforeach; ?>
			</td>
		</tr>
		
	</table>
	
	<h3><?php echo __('Social Media','responsive-jquery-slider' );?></h3>
	
	<table class="form-table">
		<tr>
			<th scope="row"><label for="twitter"><?php echo __('Twitter','responsive-jquery-slider' );?></label></th>
			<td>
				<input id="twitter" name="rjs_options[rjs_twitter]" type="text" value="<?php esc_attr_e($settings['rjs_twitter']); ?>" style="width: 60%;" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="facebook"><?php echo __('Facebook','responsive-jquery-slider' );?></label></th>
			<td>
				<input id="facebook" name="rjs_options[rjs_facebook]" type="text" value="<?php esc_attr_e($settings['rjs_facebook']); ?>" style="width: 60%;" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="linkedin"><?php echo __('LinkedIn','responsive-jquery-slider' );?></label></th>
			<td>
				<input id="linkedin" name="rjs_options[rjs_linkedin]" type="text" value="<?php esc_attr_e($settings['rjs_linkedin']); ?>" style="width: 60%;" />
			</td>
		</tr>
		<tr>
			<th scope="row"><label for="plus"><?php echo __('Google Plus','responsive-jquery-slider' );?></label></th>
			<td>
				<input id="plus" name="rjs_options[rjs_plus]" type="text" value="<?php esc_attr_e($settings['rjs_plus']); ?>" style="width: 60%;" />
			</td>
		</tr>
	</table>
	
	<p class="submit"><input type="submit" class="button-primary" value="<?php echo __('Save Options','responsive-jquery-slider' );?>" /></p>
	<p class="alignright"><?php echo __('Created by','responsive-jquery-slider' );?> <a href="http://www.chrdesigner.com" style="text-decoration: none;" target="_blank">CHR Designer</a></p>
	
	</form>

	</div>

	<?php
}

function rjs_validate_options( $input ) {
	global $rjs_options, $rjs_auto_height, $rjs_slider_per_page, $rjs_pause_on_hover, $rjs_arrow, $rjs_select_effects_js, $rjs_select_effects_style_c1, $rjs_select_effects_style_c2, $rjs_select_effects_style_c3, $rjs_select_effects_style_c4, $rjs_pagination, $rjs_shadow;

	$settings = get_option( 'rjs_options', $rjs_options );
	
	$prev = $settings['rjs_auto_height'];
	if ( !array_key_exists( $input['rjs_auto_height'], $rjs_auto_height ) )
		$input['rjs_auto_height'] = $prev;
	
	$input['rjs_size_height'] = wp_filter_nohtml_kses( $input['rjs_size_height'] );
	
	$prev = $settings['rjs_show_slider'];
	if ( !array_key_exists( $input['rjs_show_slider'], $rjs_slider_per_page ) )
		$input['rjs_show_slider'] = $prev;
	
	$prev = $settings['rjs_pause_on_hover'];
	if ( !array_key_exists( $input['rjs_pause_on_hover'], $rjs_pause_on_hover ) )
		$input['rjs_pause_on_hover'] = $prev;
	
	$prev = $settings['rjs_arrow'];
	if ( !array_key_exists( $input['rjs_arrow'], $rjs_arrow ) )
		$input['rjs_arrow'] = $prev;
	
	$input['rjs_timeout'] = wp_filter_nohtml_kses( $input['rjs_timeout'] );
	
	$input['rjs_speed'] = wp_filter_nohtml_kses( $input['rjs_speed'] );
	
	$prev = $settings['rjs_effects_js'];
	if ( !array_key_exists( $input['rjs_effects_js'], $rjs_select_effects_js ) )
		$input['rjs_effects_js'] = $prev;
	
	$prev = $settings['rjs_effects_style_c1'];
	if ( !array_key_exists( $input['rjs_effects_style_c1'], $rjs_select_effects_style_c1 ) )
		$input['rjs_effects_style_c1'] = $prev;
	
	$prev = $settings['rjs_effects_style_c2'];
	if ( !array_key_exists( $input['rjs_effects_style_c2'], $rjs_select_effects_style_c2 ) )
		$input['rjs_effects_style_c2'] = $prev;
	
	$prev = $settings['rjs_effects_style_c3'];
	if ( !array_key_exists( $input['rjs_effects_style_c3'], $rjs_select_effects_style_c3 ) )
		$input['rjs_effects_style_c3'] = $prev;
		
	$prev = $settings['rjs_effects_style_c4'];
	if ( !array_key_exists( $input['rjs_effects_style_c4'], $rjs_select_effects_style_c4 ) )
		$input['rjs_effects_style_c4'] = $prev;
	
	$prev = $settings['rjs_effects_style_c4'];
	if ( !array_key_exists( $input['rjs_effects_style_c4'], $rjs_select_effects_style_c4 ) )
		$input['rjs_effects_style_c4'] = $prev;
	
	$prev = $settings['rjs_pagination'];
	if ( !array_key_exists( $input['rjs_pagination'], $rjs_pagination ) )
		$input['rjs_pagination'] = $prev;
	
	$prev = $settings['rjs_shadow'];
	if ( !array_key_exists( $input['rjs_shadow'], $rjs_shadow ) )
		$input['rjs_shadow'] = $prev;
		
	$input['rjs_twitter'] = wp_filter_nohtml_kses( $input['rjs_twitter'] );
	
	$input['rjs_facebook'] = wp_filter_nohtml_kses( $input['rjs_facebook'] );
	
	$input['rjs_linkedin'] = wp_filter_nohtml_kses( $input['rjs_linkedin'] );
	
	$input['rjs_plus'] = wp_filter_nohtml_kses( $input['rjs_plus'] );
	
	return $input;
}

endif;  // EndIf is_admin()
/*/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// End | Settings Page - Responsive jQuery Slider////////////////////////////////////////////////////////////////////////////////////
/// Start | Custom Loop - Responsive jQuery Slider///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
function chr_responsive_jquery_slider() {
	
	global $rjs_options;
	$rjs_settings = get_option( 'rjs_options', $rjs_options );
	
	$display_slider = $rjs_settings['rjs_show_slider'];
	
	$loop_responsive_jquery_slider = new WP_Query(
		array(
			'post_type' => 'responsive-slider',
			'posts_per_page' => $display_slider,
			'nopaging' => false
		)
	);    

    if($loop_responsive_jquery_slider->have_posts()) { echo ""; } ?>
    
    <?php if( $rjs_settings['rjs_effects_js'] == 'tileSlide' ||  $rjs_settings['rjs_effects_js'] == 'tileBlind' ) { ?>
    <script src="<?php echo plugins_url( 'responsive-jquery-slider/script/jquery.cycle2.tile.min.js' , dirname(__FILE__) );?>" ></script>
	<?php }elseif( $rjs_settings['rjs_effects_js'] == 'flipHorz' || $rjs_settings['rjs_effects_js'] == 'flipVert' ) { ?>
	<script src="<?php echo plugins_url( 'responsive-jquery-slider/script/jquery.cycle2.flip.min.js' , dirname(__FILE__) );?>" ></script>
	<?php }elseif( $rjs_settings['rjs_effects_js'] == 'shuffle' ){  ?>
	<script src="<?php echo plugins_url( 'responsive-jquery-slider/script/jquery.cycle2.shuffle.min.js' , dirname(__FILE__) );?>" ></script>
	<script src="<?php echo plugins_url( 'responsive-jquery-slider/script/jquery.easing.1.3.js' , dirname(__FILE__) );?>" ></script>
	<?php };?>
    
    <style>
		.cycle-slideshow {<?php if( $rjs_settings['rjs_auto_height'] == 'yes' ) { ?>min-height: 400px;<?php }else{ ?>max-height: <?php echo $rjs_settings['rjs_size_height']; ?>px;<?php };?>}
		.chr-caption1 {-moz-animation: <?php echo $rjs_settings['rjs_effects_style_c1']; ?> 0.8s ease-in 1.3s backwards; -webkit-animation: <?php echo $rjs_settings['rjs_effects_style_c1']; ?> 0.8s ease-in 1.3s backwards; animation: <?php echo $rjs_settings['rjs_effects_style_c1']; ?> 0.8s ease-in 1.3s backwards;}
		.chr-caption2 {-moz-animation: <?php echo $rjs_settings['rjs_effects_style_c2']; ?> 0.8s ease-in 1.8s backwards; -webkit-animation: <?php echo $rjs_settings['rjs_effects_style_c2']; ?> 0.8s ease-in 1.8s backwards; animation: <?php echo $rjs_settings['rjs_effects_style_c2']; ?> 0.8s ease-in 1.8s backwards;}
		.chr-caption3 {-moz-animation: <?php echo $rjs_settings['rjs_effects_style_c3']; ?> 0.8s ease-in 2.1s backwards; -webkit-animation: <?php echo $rjs_settings['rjs_effects_style_c3']; ?> 0.8s ease-in 2.1s backwards; animation: <?php echo $rjs_settings['rjs_effects_style_c3']; ?> 0.8s ease-in 2.1s backwards;}
		.chr-caption4 {-moz-animation: <?php echo $rjs_settings['rjs_effects_style_c4']; ?> 1s ease-in 2.4s backwards; -webkit-animation: <?php echo $rjs_settings['rjs_effects_style_c4']; ?> 1s ease-in 2.4s backwards; animation: <?php echo $rjs_settings['rjs_effects_style_c4']; ?> 1 s ease-in 2.4s backwards;}
	</style>
	
	<div id="chr-slider-box" data-cycle-fx="<?php echo $rjs_settings['rjs_effects_js']; ?>" data-cycle-caption-plugin = "caption2" <?php if( $rjs_settings['rjs_pagination'] == 'true' ) { echo 'data-cycle-pager="#custom-pager" data-cycle-pager-template= "<a href=#> {{slideNum}} </a>"';?><?php };?> data-cycle-loader="true" <?php if( $rjs_settings['rjs_arrow'] == 'true' ) { echo 'data-cycle-next=".next" data-cycle-prev=".prev"';?><?php };?> data-cycle-speed = "<?php echo $rjs_settings['rjs_speed']; ?>" data-cycle-timeout="<?php echo $rjs_settings['rjs_timeout']; ?>" data-cycle-pause-on-hover = "<?php echo $rjs_settings['rjs_pause_on_hover']; ?>" data-cycle-slides="&gt; figure" class="cycle-slideshow" data-cycle-caption-template = '<span class="chr-caption1" id="color1-{{colortitle1}}">{{caption1}}</span><span class="chr-caption2" id="color2-{{colortitle2}}">{{caption2}}</span><span class="chr-caption3" id="color3-{{colortitle3}}">{{caption3}}</span><a href="{{linkbutton}}"  id="rjs-button-{{colortitle1}}" class="chr-caption4" target="_{{target}}">{{caption4}}</a><div id="global-social-media"><?php $twitter = $rjs_settings['rjs_twitter']; if (!empty($twitter)) { echo ' {{twitter}} '; } ?><?php $facebook = $rjs_settings['rjs_facebook']; if (!empty($facebook)) { echo ' {{facebook}} '; } ?><?php $linkedin = $rjs_settings['rjs_linkedin']; if (!empty($linkedin)) { echo ' {{linkedin}} '; } ?><?php $plus = $rjs_settings['rjs_plus']; if (!empty($plus)) { echo ' {{plus}} '; } ?></div>'>
		<?php while ( $loop_responsive_jquery_slider->have_posts() ) : $loop_responsive_jquery_slider->the_post(); $linkbutton = get_post_meta( get_the_ID(), 'link_per', true ); $selectlinkbutton = get_post_meta(get_the_ID(), 'custom_parent_loop', true); $occultC1 = get_post_meta(get_the_ID(), 'valor_c1', true); $occultC2 = get_post_meta(get_the_ID(), 'valor_c2', true); $occultC3 = get_post_meta(get_the_ID(), 'valor_c3', true); $occultButton = get_post_meta(get_the_ID(), 'link_name', true); global $post; $slug = get_post( $post )->post_name; ?>
		<figure class="cycle-slide" data-cycle-caption1="<?php echo get_post_meta(get_the_ID(), 'valor_c1', true); ?>" data-cycle-colortitle1="<?php echo $slug;?>" data-cycle-caption2="<?php echo get_post_meta(get_the_ID(), 'valor_c2', true); ?>" data-cycle-colortitle2="<?php echo $slug;?>" data-cycle-caption3="<?php echo get_post_meta(get_the_ID(), 'valor_c3', true); ?>" data-cycle-colortitle3="<?php echo $slug;?>" data-cycle-caption4="<?php echo get_post_meta(get_the_ID(), 'link_name', true); ?>" data-cycle-linkbutton="<?php if( ! empty( $linkbutton ) ) { echo $linkbutton; } else{ echo $selectlinkbutton; } ?>" data-cycle-target="<?php echo get_post_meta(get_the_ID(), 'custom_element_grid_target_meta_box', true); ?>" data-cycle-twitter='<a href="<?php echo $rjs_settings['rjs_twitter']; ?>" class="chr-twitter" target="_blank"></a>' data-cycle-facebook='<a href="<?php echo $rjs_settings['rjs_facebook']; ?>" class="chr-facebook" target="_blank"></a>' data-cycle-linkedin='<a href="<?php echo $rjs_settings['rjs_linkedin']; ?>" class="chr-linkedin" target="_blank"></a>' data-cycle-plus='<a href="<?php echo $rjs_settings['rjs_plus']; ?>" class="chr-plus" target="_blank"></a>'>
			<?php $image_id =  get_post_meta( get_the_ID(), '_image_id', true ); $image_src = wp_get_attachment_url( $image_id ); echo '<img src="'. $image_src .'"  /></a>'; ?>
		    <style>
			    #color1-<?php echo $slug;?> {font-size: <?php echo get_post_meta(get_the_ID(), 'size_c1', true); ?>; <?php echo get_post_meta(get_the_ID(), 'custom_element_grid_align_meta_box_c1', true); ?>:20px; color:<?php echo get_post_meta(get_the_ID(), 'color_font_c1', true); ?>; <?php if( empty( $occultC1 ) ) { echo 'display: none;'; }?>}
			    #color1-<?php echo $slug;?>:before{z-index:-1; position:absolute; background: <?php echo get_post_meta(get_the_ID(), 'color_back_c1', true); ?>; left:0; top:0; padding: 5px; color: <?php echo get_post_meta(get_the_ID(), 'color_back_c1', true); ?>; content: "<?php echo get_post_meta(get_the_ID(), 'valor_c1', true); ?>"; opacity:0.3}
			    #color2-<?php echo $slug;?> {font-size: <?php echo get_post_meta(get_the_ID(), 'size_c2', true); ?>; <?php echo get_post_meta(get_the_ID(), 'custom_element_grid_align_meta_box_c2', true); ?>:20px;  color:<?php echo get_post_meta(get_the_ID(), 'color_font_c2', true); ?>; <?php if( empty( $occultC2 ) ) { echo 'display: none;'; }?>}
			    #color2-<?php echo $slug;?>:before{z-index:-1; position:absolute; background: <?php echo get_post_meta(get_the_ID(), 'color_back_c2', true); ?>; left:0; top:0; padding: 5px; color: <?php echo get_post_meta(get_the_ID(), 'color_back_c2', true); ?>; content: "<?php echo get_post_meta(get_the_ID(), 'valor_c2', true); ?>"; opacity:0.3}
			    #color3-<?php echo $slug;?> {font-size: <?php echo get_post_meta(get_the_ID(), 'size_c3', true); ?>; <?php echo get_post_meta(get_the_ID(), 'custom_element_grid_align_meta_box_c3', true); ?>:20px; color:<?php echo get_post_meta(get_the_ID(), 'color_font_c3', true); ?>; <?php if( empty( $occultC3 ) ) { echo 'display: none;'; }?>}
			    #color3-<?php echo $slug;?>:before{z-index:-1; position:absolute; background: <?php echo get_post_meta(get_the_ID(), 'color_back_c3', true); ?>; left:0; top:0; padding: 5px; color: <?php echo get_post_meta(get_the_ID(), 'color_back_c3', true); ?>; content: "<?php echo get_post_meta(get_the_ID(), 'valor_c3', true); ?>"; opacity:0.3}
			    #rjs-button-<?php echo $slug;?>{color:<?php echo get_post_meta(get_the_ID(), 'color_font_button', true); ?>; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, <?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?>), color-stop(1, <?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?>) ); background:-moz-linear-gradient( center top, <?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?> 5%, <?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?> 100% ); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?>', endColorstr='<?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?>'); background-color:<?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?>; <?php if( empty( $occultButton ) ) { echo 'display: none;'; }?>}
			    #rjs-button-<?php echo $slug;?>:hover {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, <?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?>), color-stop(1, <?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?>) ); background:-moz-linear-gradient( center top, <?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?> 5%, <?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?> 100% ); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?>', endColorstr='<?php echo get_post_meta(get_the_ID(), 'color_top_button', true); ?>'); background-color:<?php echo get_post_meta(get_the_ID(), 'color_bottom_button', true); ?>;}
		    </style>
	    </figure>
		<?php endwhile; wp_reset_query();?>
		
		<?php if( $rjs_settings['rjs_arrow'] == 'true' ) { echo '<div class="prev"></div><div class="next"></div>';?><?php };?>
        
	    <div class="cycle-caption"></div>
	    <div class="cycle-pager"></div>
	    
	    <?php if( $rjs_settings['rjs_pagination'] == 'true' ) { echo '<div id="custom-pager"></div>';?><?php };?>
	    
	    <div id="progress"></div>
	    
	    <div class="matrix"></div>
	    
	</div>
	
	<?php if( $rjs_settings['rjs_shadow'] == 'true' ) { echo '<div class="shadow"></div>';?><?php };?>
	
	<script>
	jQuery(function($){
		var progress = $('#progress'), slideshow = $( '.cycle-slideshow' );
		
		slideshow.on( 'cycle-initialized cycle-before', function( e, opts ) {
		    progress.stop(true).css( 'width', 0 );
		});
		
		slideshow.on( 'cycle-initialized cycle-after', function( e, opts ) {
		    if ( ! slideshow.is('.cycle-paused') )
		        progress.animate({ width: '100%' }, opts.timeout, 'linear' );
		});
		
		slideshow.on( 'cycle-paused', function( e, opts ) {
		   progress.stop(); 
		});
		
		slideshow.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
		    progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
		});
	});
	</script>
	
	<?php if($loop_responsive_jquery_slider->have_posts()) { echo "";}
}
/// End | Custom Loop - Responsive jQuery Slider////////////////////////////////////////////////////////////////////////////////////