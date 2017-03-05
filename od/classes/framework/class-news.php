<?php

class Framework_News {

	public function Register() {

		if( function_exists('acf_add_local_field_group') ) {

			$aFieldMain = array (
				'conditional_logic' => 0,
				'wrapper'           => array (
					'width' => '',
					'class' => '',
					'id'    => '',
				),
			);

			$aFieldText = $aFieldMain + array(
				'required'    => 1,
				'type'        => 'text',
				'placeholder' => '',
				'prepend'     => '',
				'append'      => '',
			);

			$aFieldMessage = $aFieldMain + array(
				'required'      => 0,
				'name'          => '',
				'type'          => 'message',
				'instructions'  => '',
				'required'      => 0,
				'new_lines'     => 'wpautop',
				'esc_html'      => 0,
			);

			$sHeaderStyle = 'color: #132862; background-color: #80DEEA; font-weight: 600; font-size: 1.5em; margin-bottom: 0.5em;';

			acf_add_local_field_group(array (
				'key' => 'group_582d71ea8f40c',
				'title' => 'Blog instellingen',
				'fields' => array (
					$aFieldMessage + array (
						'key'           => 'field_582d72defa367',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Instellingen blog artikelen</h2>',
						'message'       => 'De titel & intro tekst is in te stellen via de <a href="'.get_edit_post_link(BLOG).'">Blog pagina</a>.',
					),
					$aFieldText + array (
						'key'           => 'field_982d723756361',
						'label'         => 'Tekst boven social share iconen',
						'name'          => 'blog_share',
						'instructions'  => '',
						'default_value' => 'Deel dit artikel op social media',
						'maxlength'     => '',
					),
					$aFieldMain + array (
						'key'           => 'field_582d724956362',
						'label'         => 'Fallback foto (voor als er geen Uitgelichte afbeelding is toegevoegd)',
						'name'          => 'blog_fallback',
						'type'          => 'image',
						'instructions'  => '',
						'required'      => 1,
						'return_format' => 'id',
						'preview_size'  => 'blog_wide',
						'library'       => 'all',
						'min_width'     => 1400,
						'min_height'    => 500,
						'min_size'      => '',
						'max_width'     => '',
						'max_height'    => '',
						'max_size'      => '',
						'mime_types'    => '',
					),
				),
				'location' => array (
					array (
						array (
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'occhio-news',
						),
					),
				),
				'menu_order'      => 0,
				'position'        => 'acf_after_title',
				'style'           => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'  => '',
				'active'          => 1,
				'description'     => '',
			));

		}
	}
}
