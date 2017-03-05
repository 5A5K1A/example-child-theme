<?php

/* Hooks based on ACF fields
/* ------------------------------------ */

/**
 * Register the Google API key
 */
add_action('acf/init', function() {
	acf_update_setting('google_api_key', GOOGLE_API_KEY);
});

/**
 * Exclude current post/page & unpublished ones from relationship field results
 */
add_filter('acf/fields/relationship/query', function( $args, $field, $post ) {
	$args['post__not_in'] = array( $post );
	$args['post_status']  = 'publish';
	return $args;
}, 10, 3);

/**
 * Runs before ACF saves the $_POST['acf'] data & toggles the image position
 */
add_action('acf/save_post', function( $post_id ) {

	$post_type = get_post_type($post_id);
	if( $post_type != 'page' ) { return; }

	$aFlexContent = $_POST['acf']['field_58175f71684ce'];
	if( empty($aFlexContent) ) { return; }

	foreach( $aFlexContent as $iRow => $aFlexData ) {
		if( $aFlexData['acf_fc_layout'] == 'content' && !empty($aFlexData['field_58219230c05f1']) && in_array('image', $aFlexData['field_58219230c05f1']) ) {

			if( $sImagePosition == 'right' || !isset($sImagePosition) ) { $sImagePosition = 'left'; }
			else { $sImagePosition = 'right'; }

			$_POST['acf']['field_58175f71684ce'][$iRow]['field_583c25259727a'] = $sImagePosition;
		}
	}
}, 1);

function GetContactInfo( $type = 'all' ) {
	if( $type != 'all' ) {
		if( !in_array($type, array('address', 'location', 'phone', 'email')) ) { return; }
		return get_field( 'contact_'.$type, 'options' );
	}
	$aContact = array(
		'address'  => get_field( 'contact_address', 'options' ),
		'location' => get_field( 'contact_location', 'options' ),
		'phone'    => get_field( 'contact_phone', 'options' ),
		'email'    => get_field( 'contact_email', 'options' ),
	);

	return $aContact;
}

function GetSocialInfo() {
	$aSocial = array(
		'twitter'  => get_field( 'sm_twitter', 'options' ),
		'facebook' => get_field( 'sm_facebook', 'options' ),
		'linkedin' => get_field( 'sm_linkedin', 'options' ),
	);

	return $aSocial;
}

function GetUspSettings( $slide = 'all' ) {
	if( $slide != 'all' ) {
		$aItem[$slide] = array(
			'usp_text'    => AddStylingSpan( get_field('usp_no'.$slide.'_slide_text', 'options') ),
			'action_text' => get_field('usp_no'.$slide.'_action_text', 'options'),
			'button_text' => get_field('usp_no'.$slide.'_button_text', 'options'),
			'button_url'  => get_field('usp_no'.$slide.'_button_link', 'options'),
		);
		return $aItem;
	}

	$aSettings = array(
		'header' => get_field( 'usp_title', 'options' ),
		'items'  => array(
			1 => array(
				'usp_text'    => AddStylingSpan( get_field('usp_no1_slide_text', 'options') ),
				'action_text' => get_field('usp_no1_action_text', 'options'),
				'button_text' => get_field('usp_no1_button_text', 'options'),
				'button_url'  => get_field('usp_no1_button_link', 'options'),
			),
			2 => array(
				'usp_text'    => AddStylingSpan( get_field('usp_no2_slide_text', 'options') ),
				'action_text' => get_field('usp_no2_action_text', 'options'),
				'button_text' => get_field('usp_no2_button_text', 'options'),
				'button_url'  => get_field('usp_no2_button_link', 'options'),
			),
			3 => array(
				'usp_text'    => AddStylingSpan( get_field('usp_no3_slide_text', 'options') ),
				'action_text' => get_field('usp_no3_action_text', 'options'),
				'button_text' => get_field('usp_no3_button_text', 'options'),
				'button_url'  => get_field('usp_no3_button_link', 'options'),
			),
			4 => array(
				'usp_text'    => AddStylingSpan( get_field('usp_no4_slide_text', 'options') ),
				'action_text' => get_field('usp_no4_action_text', 'options'),
				'button_text' => get_field('usp_no4_button_text', 'options'),
				'button_url'  => get_field('usp_no4_button_link', 'options'),
			),
			5 => array(
				'usp_text'    => AddStylingSpan( get_field('usp_no5_slide_text', 'options') ),
				'action_text' => get_field('usp_no5_action_text', 'options'),
				'button_text' => get_field('usp_no5_button_text', 'options'),
				'button_url'  => get_field('usp_no5_button_link', 'options'),
			),
		),
	);

	return $aSettings;
}

function GetProductData() {
	$aData = get_field('products', 'options');
	return $aData;
}
