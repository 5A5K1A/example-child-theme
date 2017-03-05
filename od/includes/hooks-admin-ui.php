<?php

/* Hooks for the admin UI
/* ------------------------------------ */

/* Move Yoast to bottom
/* ------------------------------------ */
add_filter( 'wpseo_metabox_prio', function() {
	return 'low';
});

/* Change the admin footer #sluikreclame
/* ------------------------------------ */
add_filter( 'admin_footer_text', function() {
	echo '<span id="footer-thankyou">This website is developed by <a href="http://www.occhio.nl/" target="_blank">Occhio</a></span>';
});

/* Hide certain admin sections for "simple users"
/* ------------------------------------ */
add_action('wp_dashboard_setup', function() {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); 			// Quick Press widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); 		// Recent Drafts
	remove_meta_box('dashboard_primary', 'dashboard', 'side'); 				// WordPress.com Blog
	remove_meta_box('dashboard_secondary', 'dashboard', 'side'); 			// Other WordPress News
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); 	// Incoming Links
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); 	// Recent Comments
	remove_meta_box('icl_dashboard_widget', 'dashboard', 'normal'); 		// Multi Language Plugin
	remove_meta_box('dashboard_activity', 'dashboard', 'normal'); 			// Activity
	if( current_user_can('editor') ) {
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); 		// Plugins
		// remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); 		// Right Now
		// remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); 		// Gravity Forms
		// remove_action('welcome_panel', 'wp_welcome_panel');
	}
});

/* Add Custom Post Type to WP-ADMIN Right Now Widget
/* ------------------------------------ */
add_action( 'dashboard_glance_items', function() { ?>
	<style>
	#dashboard_right_now a.quote-count:before { content: "\f122"; }
	li.comment-count { display: none; }
	</style>
<?php
	$args = array(
		'public' 	=> true ,
		'_builtin' 	=> false
	);
	$aPostTypes = get_post_types( $args , 'object' , 'and' );

	foreach( $aPostTypes as $oPostType ) {
		$iTotal 		= number_format_i18n( wp_count_posts( $oPostType->name )->publish );
		$sOutput 		= _n( $oPostType->labels->name, $oPostType->labels->name, intval( wp_count_posts( $oPostType->name )->publish ) );
		$sPostTypeName 	= $oPostType->name;

		if( current_user_can( 'edit_posts' ) ) {
			echo '<li class="'.$sPostTypeName.'-count"><a href="edit.php?post_type='.$sPostTypeName.'" class="'.$sPostTypeName.'-count">'.$iTotal.' '.$sOutput.'</a></li>';
		}
	}
});

/* Remove Featured Image Metabox from Quote editing
/* ------------------------------------ */
add_action('do_meta_boxes', function() {
	remove_meta_box('postimagediv','quote','side');
});

/*  Modify TinyMCE
/* ------------------------------------ */
add_filter( 'tiny_mce_before_init', function( $toolbars ) {

	# customize the buttons
	$toolbars['toolbar1'] = 'bold,italic,bullist,numlist,hr,link,unlink';
	$toolbars['toolbar2'] = 'formatselect,pastetext,pasteword,charmap,undo,redo';

	# Keep the "kitchen sink" open:
	$toolbars[ 'wordpress_adv_hidden' ] = FALSE;

	return $toolbars;
});

/**
 * Add another simple toolbar for ACF RTE/ WYSIWYG/ MCEdit too
 * @param array $toolbar
 * @return array $toolbar
 */
add_filter( 'acf/fields/wysiwyg/toolbars', function( $toolbars ) {
	// Add a new simple toolbar called
	$toolbars[SITENAME.' Simpel'] = array();
	$toolbars[SITENAME.' Simpel'][1] = array('bold,italic,bullist,numlist,hr,link,unlink');
	$toolbars[SITENAME.' Simpel'][2] = array('formatselect,pastetext,pasteword,charmap,undo,redo');

	return $toolbars;
});

/*
	Gravity Forms Bootstrap Styles

	Applies bootstrap classes to various common field types.
	* Requires Bootstrap to be in use by the theme.

	Using this function allows use of Gravity Forms default CSS
	* in conjuction with Bootstrap (benefit for fields types such as Address).

	@see  gform_field_content
	* @link http://www.gravityhelp.com/documentation/page/Gform_field_content

	@return string Modified field content
*/
add_filter( 'gform_field_content', function( $content, $field, $value, $lead_id, $form_id ) {

	// Currently only applies to most common field types, but could be expanded.
	if($field["type"] != 'hidden' && $field["type"] != 'list' && $field["type"] != 'multiselect' && $field["type"] != 'checkbox' && $field["type"] != 'fileupload' && $field["type"] != 'date' && $field["type"] != 'html' && $field["type"] != 'address') {
		$content = str_replace('class=\'medium', 'class=\'form-control medium', $content);
	}
	if($field["type"] == 'name' || $field["type"] == 'address') {
		$content = str_replace('<input ', '<input class=\'form-control\' ', $content);
	}
	if($field["type"] == 'textarea') {
		$content = str_replace('class=\'textarea', 'class=\'form-control textarea', $content);
	}
	if($field["type"] == 'checkbox') {
		$content = str_replace('li class=\'', 'li class=\'checkbox ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}
	if($field["type"] == 'radio') {
		$content = str_replace('li class=\'', 'li class=\'radio ', $content);
		$content = str_replace('<input ', '<input style=\'margin-left:1px;\' ', $content);
	}
	if($field["type"] == 'date') {
		$content = str_replace('select', 'select class="form-control" ', $content);
	}
	return $content;
}, 10, 5);

add_filter( 'gform_submit_button', function( $button, $form ) {
	return "<button class='button btn btn-default' id='gform_submit_button_{$form["id"]}'><span>{$form['button']['text']}</span></button>";
}, 10, 2);

/* Add css class to form
/* ------------------------------------ */
add_filter( 'gform_form_tag', function( $form_tag, $form ) {
	$cssClass = 'class="gform_form gform_form_' . $form['fields'][0]['formId'] . '"';
	$form_tag = str_replace('id=', $cssClass . ' id=', $form_tag );
	return $form_tag;
}, 10, 2 );

/* Nice logo for admin login
/* ------------------------------------ */
add_filter( 'login_headerurl', function() { ?>
	<style>
	body.login {
		background-color: #57AB27;
	}
	.login #nav a, .login #backtoblog a {
		color: white;
	}
	#login > h1 {
		content: ' ';
		display: none;
	}
	#login form {
		background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/src/img/logo/logo.svg');
		background-repeat: no-repeat;
		background-size: 75%;
		background-position: center 3em;
		padding-top: 23em;
	}
	</style>
<?php
});
add_filter('login_headertitle', function() {
	return get_option('blogname');
});

/* Rename WP standard 'Berichten' to 'Nieuws'
/* ------------------------------------ */
add_action( 'admin_menu', function() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Nieuws';
	$submenu['edit.php'][5][0] 	= __('Nieuws', 'od');
	$submenu['edit.php'][10][0] = __('Nieuws toevoegen', 'od');
	$submenu['edit.php'][16][0] = __('Nieuws Tags', 'od');
	remove_menu_page( 'occhiodocumentationpage' );
	remove_menu_page( 'edit-comments.php' ); // for now, waiting for decision
	remove_meta_box( 'authordiv','post','normal' );
});
add_action( 'init', function() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name 			= __('Nieuws', 'od');
	$labels->singular_name 	= __('Nieuws', 'od');
	$labels->all_items 		= __('Alle nieuws', 'od');
	$labels->add_new 		= __('Nieuws toevoegen', 'od');
	$labels->add_new_item 	= __('Nieuws toevoegen', 'od');
	$labels->edit_item 		= __('Bewerk nieuws', 'od');
	$labels->new_item 		= __('Nieuws', 'od');
	$labels->view_item 		= __('Bekijk Nieuws', 'od');
	$labels->search_items 	= __('Zoek nieuws', 'od');
	$labels->not_found 		= __('Geen nieuws gevonden', 'od');
	$labels->not_found_in_trash = __('Geen nieuws gevonden gevonden in de prullenbak', 'od');
	$labels->all_items 		= __('Alle nieuws', 'od');
	$labels->menu_name 		= __('Nieuws', 'od');
	$labels->name_admin_bar = __('Nieuws', 'od');
});

/* remove the WP-button on the left top in admin
/* ------------------------------------ */
add_action( 'wp_before_admin_bar_render', function() {
	global $wp_admin_bar; //p($wp_admin_bar);

	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'comments' );
});

add_filter( 'enter_title_here', function( $title ) {
	if( get_post_type() == 'quote' ) {
		$title = __('Korte titel invoeren (voor in admin)', 'od');
	} elseif( get_post_type() == 'people' ) {
		$title = __('Voor- en achternaam invoeren', 'od');
	} elseif( get_post_type() == 'post' ) {
		$title .= __(' (max. 60 tekens)', 'od');
	}
	return $title;
});

/* Customn columns for posttypes in admin
/* ------------------------------------ */
add_action( 'manage_pages_columns', 'custom_columns', 5 );
add_action( 'manage_posts_columns', 'custom_columns', 5 );
function custom_columns( $columns ) {
	if( get_post_type() == 'post' ) {
		$columns = array_slice($columns, 0, 1, true) +
			array('thumb' => __('Foto', 'od')) +
			array_slice($columns, 1, 1, true) +
			array('person' => __('Blog auteur', 'od')) +
			array_slice($columns, 2, count($columns)-1, true);
	}
	if( get_post_type() == 'people' ) {
		$columns = array_slice($columns, 0, 1, true) +
			array('thumb' => __('Profielfoto', 'od')) +
			array_slice($columns, 1, count($columns)-1, true);
	}
	if( get_post_type() == 'press' ) {
		$columns = array_slice($columns, 0, 1, true) +
			array('thumb' => __('Foto', 'od')) +
			array_slice($columns, 1, 1, true) +
			array('source' => __('Bron', 'od')) +
			array_slice($columns, 2, count($columns)-1, true);
	}
	return $columns;
}
add_action( 'manage_pages_custom_column', 'display_custom_columns', 5, 2 );
add_action( 'manage_posts_custom_column', 'display_custom_columns', 5, 2 );
function display_custom_columns( $column_name, $id ) {
	switch($column_name) {
		case 'thumb' :
			$iImageID 	= get_post_thumbnail_id();
			if( !$iImageID ) {
				echo '<a href="'.get_edit_post_link().'">['.__('geen foto toegevoegd', 'od').']</a>';
				break;
			}
			$sImageUrl 	= wp_get_attachment_image_src($iImageID, 'admin_preview');
			echo '<a href="'.get_edit_post_link().'"><img src="'.$sImageUrl[0].'"></a>';
			break;
		case 'person' :
			$oWriter = get_field('post_writer');
			echo '<a href="'.get_edit_post_link($oWriter->ID).'">'.$oWriter->post_title.'</a>';
			break;
		case 'source' :
			$sSource = get_field('press_source');
			if( empty($sSource) ) { $sSource = '-'; }
			echo '<i>'.$sSource.'</i>';
			break;
	}
}
add_action('admin_head', function() {
    echo '<style type="text/css">.column-thumb { text-align: center; width: 12em; overflow: hidden }</style>';
});

/* Make featuered image required for people
/* ------------------------------------ */
add_action('save_post', 'od_check_thumbnail');
function od_check_thumbnail( $post_id ) {

	if( get_post_type($post_id) != 'people' ) { return; }

	if( !has_post_thumbnail($post_id) ) {
		// set a transient to show the users an admin message
		set_transient( 'has_post_thumbnail', 'no' );
		// unhook this function so it doesn't loop infinitely
		remove_action( 'save_post', 'od_check_thumbnail');
		// update the post set it to draft
		wp_update_post( array('ID' => $post_id, 'post_status' => 'draft') );
		add_action( 'save_post', 'od_check_thumbnail' );

	} else {
		delete_transient( 'has_post_thumbnail' );
	}
}
add_action( 'admin_notices', function() {

	// check if the transient is set, and display the error message
	if( get_transient('has_post_thumbnail') == 'no' ) {
		echo '<div id="message" class="error"><p><strong>'.__( 'Stel een profielfoto in. Deze collega kan niet gepubliceerd worden zonder een foto.', 'od' ).'</strong></p></div>';
		delete_transient( 'has_post_thumbnail' );
	}
});
