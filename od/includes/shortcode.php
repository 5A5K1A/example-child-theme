<?php

// usage: [CONTACT_INFO]
add_shortcode( 'CONTACT_INFO', function() {
	if( strpos($_SERVER['QUERY_STRING'], 'page=wp-help-documents') !== FALSE ) { return '[CONTACT_INFO]'; }
	return Template::Render('snippet-footer-contact');
});