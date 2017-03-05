<?php

/* Useful utils
/* ------------------------------------ */

/**
 * Strips url from obsolete stuff, for prettier display
 * @param      string  $url    The url
 * @return     string  The cleaned up & pretty url for displaying
 */
function od_strip_url( $url ) {
	return rtrim( str_replace(array( 'https://', 'http://', 'www.' ), '', $url), '/' );
}

/**
 * Adds a span for easy styling
 * @param      string  $string  The string
 * @return     string  The styled string
 */
function AddStylingSpan( $string ) {
	return preg_replace( '#\*(.*?)\*#', '<em>$1</em>', $string );
}

/**
 * Creates a link with attributes (if provided) => no more dirty HTML in php
 * @param      string  $url    The url (can be post id too)
 * @param      string  $text   The text
 * @param      array   $attr   The attribute
 * @return     string  The compiled <a href...>
 */
function od_get_link( $url, $text, $attr = NULL ) {
	// early exit on no values
	if( empty($url) || empty($text) || $url == 'mailto:' || $url == 'tel:' ) { return; }

	// check if url is just a post id
	if( is_int($url) ) {
		$post_id = $url;
		$url     = get_the_permalink( $post_id );
		// early exit
		if( empty($url) ) { return; }
	}

	// setup start of a href
	$html = '<a href="'.str_replace( ' ', '', $url ).'"';

	// add attributes
	foreach( $attr as $name => $value ) { $html .= ' '.$name.'="'.$value.'"'; }

	// finish off the link
	$html .= '>'.$text.'</a>';

	// and return
	return $html;
}
function od_link( $url, $text, $attr = NULL ) {
	echo od_get_link( $url, $text, $attr = NULL );
}

/**
 * Adds an extra class on content p's
 * @param      string  $sContent  The content
 * @param      string  $sClass    The class
 * @return     string  Pretty content with added class
 */
function od_add_content_class( $sContent, $sClass = NULL ) {

	$sPrettyContent = apply_filters( 'the_content', $sContent );
	return str_replace( '<p>', '<p class="'.$sClass.'">', $sPrettyContent );
}

/**
 * Gets the author of the blogpost
 * @param      integer   $post_id   The identifier
 * @return     array     Array with the relevant data
 */
function od_get_the_post_author( $post_id = NULL ) {

	// get current post ID if none provided
	if( $post_id == NULL ) { $post_id = get_the_ID(); }
	// early return if no ID
	if( empty($post_id) ) { return; }

	// get people object
	$oAuthor     = get_field( 'post_writer', $post_id );

	// early return if person is not published
	if( $oAuthor->post_status != 'publish' ) { return; }

	// get custom fields
	$aAuthorData = get_fields($oAuthor);
	foreach( $aAuthorData as $key => $value ) {
		if( !empty($value) ) {
			$sCleanKey = str_replace( 'people_', '', $key );
			$aData[$sCleanKey] = $value;
		}
	}

	// add name and slug too
	$aData['name'] = $oAuthor->post_title;
	$aData['slug'] = $oAuthor->post_name;

	return $aData;
}

/**
 * Gets the pretty/ formatted date
 * @param      integer   $post_id   The post identifier
 * @param      integer   $limit     The limit of days ago
 * @return     string    Prettified date display
 */
function od_get_the_timetoshow( $post_id = NULL, $limit = 10 ) {

	// get current post ID if none provided
	if( $post_id == NULL ) { $post_id = get_the_ID(); }
	// early return if no ID
	if( empty($post_id) ) { return; }

	// get post date
	$sPostDate    = get_the_date( 'Y-m-d H:i:s', $post_id );
	// get limit date
	$sMaxDate     = date( 'Y-m-d H:i:s', strtotime('-'.$limit.' days', strtotime('now')) );

	// check if postdate is within limit
	if( $sMaxDate < $sPostDate ) {
		// show number of days ago
		$sCurrentDate = current_time('timestamp');
		$sDaysAgo     = human_time_diff( get_the_time('U', $post_id), $sCurrentDate );
		$sTimeToShow  = $sDaysAgo.' '.__('geleden', 'od');
	} else {
		// show date
		$sTimeToShow  = get_the_time( get_option('date_format'), $post_id );
	}

	return $sTimeToShow;
}
function od_the_timetoshow( $post_id = NULL, $limit = 10 ) {
	echo od_get_the_timetoshow( $post_id, $limit );
}

/**
 * Gets the featured image ID (or fallback if none is provided)
 * @param      integer   $post_id  The post identifier
 * @return     integer   The ID of the image to display
 */
function od_get_post_thumbnail_id( $post_id = NULL ) {

	// get current post ID if none provided
	if( $post_id == NULL ) { $post_id = get_the_ID(); }
	// early return if no ID
	if( empty($post_id) ) { return; }

	if( get_post_type($post_id) == 'post' ) { $post_type = 'blog'; }
	else { $post_type = get_post_type($post_id); }

	// check if has featured image
	if( has_post_thumbnail($post_id) ) {
		$iImageID = get_post_thumbnail_id( $post_id);
		if( empty($iImageID) ) {
			$iImageID = get_field( $post_type.'_fallback', 'options' );
		}
	} else {
		$iImageID = get_field( $post_type.'_fallback', 'options' );
	}
	return $iImageID;
}
function od_the_post_thumbnail_id( $post_id = NULL ) {
	echo od_get_post_thumbnail_id( $post_id );
}

/**
 * Gets the related posts of a blog article (appended with the newest)
 * @param      integer   $post_id   The post identifier
 * @return     array     Related posts
 */
function od_get_related_posts( $post_id = NULL ) {

	// get current post ID if none provided
	if( $post_id == NULL ) { $post_id = get_the_ID(); }
	// early return if no ID
	if( empty($post_id) || get_post_type($post_id) != 'post' ) { return; }

	// set counter to zero
	$iCounter      = 0;
	// get related posts set by admin
	$aRelatedPosts = get_field( 'post_related', $post_id );
	// setup array of post IDs to exclude
	$aExcludeIDs   = array( $post_id );
	$aPosts        = array();

	// (double) check provided related posts
	if( !empty($aRelatedPosts) ) {
		foreach( $aRelatedPosts as $oPost ) {
			if( $oPost->post_status == 'publish' && $oPost->ID != $post_id ) {
				$aPosts[]      = $oPost;
				$aExcludeIDs[] = $oPost->ID;
				$iCounter++;
			}
		}
	}

	// get more posts if less than three are provided
	if( $iCounter < 6 ) {
		$aArgs = array(
			'post_type' 	=> 'post',
			'post_status' 	=> 'publish',
			'showposts' 	=> (6 - $iCounter),
			'orderby'       => 'date',
			'order'         => 'DESC',
			'exclude'       => $aExcludeIDs,
		);
		$aExtraPosts = get_posts( $aArgs );

		// append them to the original array
		foreach( $aExtraPosts as $oPost ) {
			array_push( $aPosts, $oPost );
		}
	}

	return $aPosts;
}

/**
 * Gets the array with numbers and their corresponding month name
 * @return    array  The array with numbers and their corresponding month name
 */
function od_get_months() {
	return array(
		1 => __('Jan', 'od'),
		2 => __('Feb', 'od'),
		3 => __('Mrt', 'od'),
		4 => __('Apr', 'od'),
		5 => __('Mei', 'od'),
		6 => __('Jun', 'od'),
		7 => __('Jul', 'od'),
		8 => __('Aug', 'od'),
		9 => __('Sep', 'od'),
		10 => __('Okt', 'od'),
		11 => __('Nov', 'od'),
		12 => __('Dec', 'od'),
	);
}

/**
 * Formats the number to a pretty format
 * @param      integer  $number    The number
 * @param      integer  $decimals  The number of decimals
 * @return     string   Formatted number with dot as thousands separator and comma as decimals separator
 */
function od_get_pretty_number( $number, $decimals = 0 ) {
	return number_format($number, $decimals, ',', '.');
}
