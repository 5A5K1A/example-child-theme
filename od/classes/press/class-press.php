<?php
/**
 * Press class
 */

class Press extends PostType {
	/**
	 * Required variables
	 */
	protected $post_type           = 'press';
	protected $label_name          = 'Persberichten';
	protected $label_name_singular = 'Persbericht';
	protected $args = array(
		'menu_icon'           => 'dashicons-clipboard',
		'labels'	          => array(
			'add_new_item' => 'Nieuw persbericht',
			'add_new'      => 'Nieuw persbericht',
		),
		'rewrite'             => array(
			'slug'         => 'persbericht',
		),
		'capability_type'     => 'post',
		'has_archive'         => 'in-het-nieuws',
		'exclude_from_search' => false,
	);
}