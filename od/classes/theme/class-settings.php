<?php

class Theme_Settings {

	public function Register() {

		// setup theme settings
		if( function_exists('acf_add_options_page') ) {


			acf_add_options_page(array(
				'page_title' 	=> __('Producten van ', 'od').get_bloginfo(),
				'menu_title'	=> __('Producten', 'od'),
				'menu_slug' 	=> 'occhio-products',
				'capability'	=> 'edit_posts',
				'redirect'		=> false,
				'position'      => '57',
				'icon_url'      => 'dashicons-portfolio',
			));

			acf_add_options_page(array(
				'page_title' 	=> __('Instellingen kostencalculator ', 'od'),
				'menu_title'	=> __('Calculator', 'od'),
				'menu_slug' 	=> 'occhio-calculator',
				'capability'	=> 'edit_posts',
				'redirect'		=> false,
				'position'      => '57.5',
				'icon_url'      => 'dashicons-forms',
			));

			acf_add_options_page(array(
				'page_title' 	=> __('Thema General Settings', 'od'),
				'menu_title'	=> __('Thema Settings', 'od'),
				'menu_slug' 	=> 'theme-general-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> true,
				'position'      => '59.5',
				'icon_url'      => 'dashicons-schedule',
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> __('Contact Settings', 'od'),
				'menu_title'	=> __('Contact Info', 'od'),
				'slug'          => 'occhio-contact',
				'parent_slug'	=> 'theme-general-settings',
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> __('USP Settings', 'od'),
				'menu_title'	=> __('USP Settings', 'od'),
				'slug'          => 'occhio-usp',
				'parent_slug'	=> 'theme-general-settings',
			));

			acf_add_options_page(array(
				'page_title' 	=> __('Nieuws instellingen', 'od'),
				'menu_title' 	=> __('Instellingen', 'od'),
				'menu_slug' 	=> 'occhio-news',
				'capability' 	=> 'edit_posts',
				'parent_slug'	=> 'edit.php',
				'redirect'	    => false,
			));

			acf_add_options_page(array(
				'page_title' 	=> __('Persbericht instellingen', 'od'),
				'menu_title' 	=> __('Instellingen', 'od'),
				'menu_slug' 	=> 'occhio-press',
				'capability' 	=> 'edit_posts',
				'parent_slug'	=> 'edit.php?post_type=press',
				'redirect'	    => false,
			));
		}
	}
}