<?php
/**
 * Quote class
 */

class Quote extends PostType {
	/**
	 * Required variables
	 */
	protected $post_type           = 'quote';
	protected $label_name          = 'Quotes';
	protected $label_name_singular = 'Quote';
	protected $args = array(
		'menu_icon'           => 'dashicons-format-quote',
		'labels'	          => array(
			'add_new_item' => 'Nieuwe quote',
			'add_new'      => 'Nieuwe quote',
		),
		'rewrite'             => array(
			'slug'         => 'quote',
		),
		'capability_type'     => 'post',
		'has_archive'         => false,
		'exclude_from_search' => true,
		'supports'            => array( 'title', 'author' ),
	);
}