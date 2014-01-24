<?php

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