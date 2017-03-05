<?php
// setup  image sizes: $name, $width, $height, $crop

if( function_exists('add_image_size') ) {

	add_image_size('admin_preview', 100, 100, true);

	// image sizes for the blog part
	add_image_size( 'blog_overview', 360, 240, true );
	add_image_size( 'blog_wide', 860, 540, true );
	add_image_size( 'blog_header', 1400, 500, true );
	add_image_size( 'home_header', 1500, 1500, false );

	add_image_size( 'content_image', 900, 600, true );

	// TODO frontend image formaten checken & toevoegen
}

add_filter('image_size_names_choose', function( $aSizes ) {
	$aAddSizes = array(
		// 'content_image' => __( 'Inline image', 'od' ),
		'blog_wide' => __( 'Blog: volledige breedte', 'od' ),
	);
	$aNewSizes = array_merge( $aSizes, $aAddSizes );
	return $aNewSizes;
});

/**
 * Sets the default settings for adding media in a blog post
 */
add_action( 'after_setup_theme', function() {
	update_option( 'image_default_align', 'center' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'blog_wide' );

	add_theme_support( 'html5', array('gallery', 'caption') );
} );

add_filter( 'manage_media_columns', function( $cols ) {
	$cols['dimensions'] = __('Afmetingen (b x h)', 'od');
	return $cols;
} );
add_action( 'manage_media_custom_column', function( $column_name, $id ) {
	$meta = wp_get_attachment_metadata( $id );
	if( isset($meta['width']) ) {
		echo $meta['width'].' x '.$meta['height'];
	}
}, 10, 2 );

/**
 * Removing hardcoded width attr from inline image (for responsiveness)
 * @source : https://wpbeaches.com/responsively-removing-width-and-height-attributes-in-images-on-wordpress/
 */
add_shortcode( 'wp_caption', 'od_remove_fixed_width' );
add_shortcode( 'caption', 'od_remove_fixed_width' );
function od_remove_fixed_width( $attr, $content = null ) {
	if( !isset($attr['caption']) ) {
		if( preg_match('#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );

	if( $output != '' ) { return $output; }

	extract( shortcode_atts(array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
		), $attr)
	);

	if( 1 > (int) $width || empty($caption) ) { return $content; }

	if( $id ) {
		$id = 'id="'.esc_attr($id).'" ';
		return '<div '.$id.'class="wp-caption '.esc_attr($align).'" >'.do_shortcode( $content ).'<p class="wp-caption-text">'.$caption.'</p></div>';
	}
}
