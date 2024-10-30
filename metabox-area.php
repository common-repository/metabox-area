<?php

/**
 * Plugin Name: Metabox Area
 * Description: Adds a third column and two columns after content editor to the page/post edit screen. You can add metaboxes to these containers.
 * Author: Kama
 * Author URI: http://wp-kama.ru
 * Plugin URI: 
 * Version: 1.3
 */


if( ! is_admin() ) return;



add_action('dbx_post_advanced', 'mxa_edit_form_init');
function mxa_edit_form_init() {
	$cs = get_current_screen();
	if( $cs->base !== 'post' ) return;
	
	// not show if post type is not public
	$pt = get_post_type_object($cs->post_type);
	if( ! $pt->public ) return;
	
	// hook to disable the plugin
	if( apply_filters('mxa_disable', false ) )  return;
	
	add_action('admin_enqueue_scripts', 'mxa_enqueue_scripts');

	// the actual sidebar writers
	add_action('edit_form_after_editor', 'mxa_edit_form_after_editor');
	add_action('dbx_post_sidebar', 'mxa_dbx_post_sidebar');
}

function mxa_enqueue_scripts () {
	//  add the screen options
	add_screen_option('layout_columns', array('max' => 3, 'default' => 3) );
	//add_screen_option('mini_columns', array('max' => 3, 'default' => 3, 'label' => 'Mini columns') );

	// add scripts and styles
	wp_enqueue_style('mxa-css', plugins_url('admin.css', __FILE__) );
	add_action('admin_print_footer_scripts', 'mxa_js', 99);
}


function mxa_js(){
	?>
	<script>
	jQuery(function ($) {
		// bump set
		$('#postbox-leftright, #postbox-bot-leftright, #postbox-container-3').find('.ui-sortable')
			.on('sortactivate', function (event, ui) {
				if( ! $(this).html().match(/</) ) $(this).addClass('bump');
			})
			.on('sortdeactivate', function (event, ui) {
				$(this).removeClass('bump');
			});
		
		// 
		var $pbody     = $('#post-body'),
			$rightcol  = $('#postbox-container-1'),
			$col3      = $('#postbox-container-3'),
			$col3input = $('#adv-settings .columns-prefs-3 input'),
			foo
		
		$rightcol.after( $col3 );
		
		if( $col3input.is(':checked') )
			$pbody.removeClass('columns-2').addClass('columns-3');

		// resize event
		$( window ).on('resize.col3', function() {
			if( ! $col3input.is(':checked') ) return;
			
			var wwidth    = $(window).width()
			
			// set columns-2
			if( wwidth < 1300 && $pbody.hasClass('columns-3') ){
				$pbody.addClass('columns-2').removeClass('columns-3');
			}
			
			// set columns-3
			if( wwidth >= 1300 && $pbody.hasClass('columns-2') ){
				$pbody.removeClass('columns-2').addClass('columns-3');
			}
		});
		
		// first init
		$( window ).trigger('resize.col3');
	});
	</script>
	<?php
}

function mxa_edit_form_after_editor($post) {
	?>
	<div id="postbox-leftright">
		<div id="postbox-container-left" class="postbox-container">
			<?php do_meta_boxes(null, 'left', $post); ?>
		</div>

		<div id="postbox-container-right" class="postbox-container">
			<?php do_meta_boxes(null, 'right', $post); ?>
		</div>
	</div>
	<?php
	//remove_action( current_action(), __FUNCTION__ ); // once
}

function mxa_dbx_post_sidebar($post) {	
	$post_type = $post->post_type;
	?>
	<div id="postbox-container-3" class="postbox-container">
		<?php do_meta_boxes( $post_type, 'column3', $post ); ?>
	</div>
	
	<div id="postbox-bot-leftright">
		<div id="postbox-container-botleft" class="postbox-container">
			<?php do_meta_boxes(null, 'botleft', $post); ?>
		</div>

		<div id="postbox-container-botright" class="postbox-container">
			<?php do_meta_boxes(null, 'botright', $post); ?>
		</div>
	</div>
	<?php
	//remove_action( current_action(), __FUNCTION__ ); // once
}
