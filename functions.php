<?php

/**
 * Register post types and taxonomies
 */
add_action( 'after_setup_theme', function() {

	// register theme settings
	Theme_Settings::Register();
	Framework_Contact::Register();
	Framework_Usp::Register();
	Framework_Products::Register();
	Framework_Calculator::Register();
	Framework_News::Register();
	Framework_Press::Register();

	// register all models
	Quote::Register();
	Press::Register();
	People::Register();

	// add css for editor
	// add_editor_style( 'dist/css/app.css' );

	// Setup Footer Widget columns in: snippet-footer-widgets.php
	Sidebar_Footer::Register();

}, 15 );

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'app', get_stylesheet_directory_uri() . '/dist/css/app.min.css', '', getLastCssModified(), 'screen' ); // main style
	wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/dist/css/print.min.css', '', getLastCssModified(), 'print' ); // print style

/**
 * Enqueue scripts
 */
	wp_enqueue_script( 'jquery'); // jQuery, in head
	wp_enqueue_script( 'googlemapsapi', 'https://www.gstatic.com/charts/loader.js', array(), getLastJsModified(), $in_footer = true ); // Load google maps
	wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/dist/js/app.min.js', array(), getLastJsModified(), $in_footer = true ); // app scripts, in footer
});
