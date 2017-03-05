<?php

class Framework_Products {

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
				'type'          => 'text',
				'instructions'  => '',
				'required'      => 1,
				'placeholder'   => '',
				'prepend'       => '',
				'append'        => '',
				'maxlength'     => '',
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
				'key'    => 'group_58209747412eb',
				'title'  => __('Producten van ', 'od').get_bloginfo(),
				'fields' => array (
					$aFieldMain + array (
						'key'           => 'field_58209747d4800',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Afzonderlijke producten</h2>',
						'name'          => 'products',
						'type'          => 'repeater',
						'instructions'  => __('Het eerste product toont een zon als icoon, het tweede toont een stuurwiel. Deze zijn hard-coded; voor wijzigingen graag contact opnemen met ', 'od').'<a href="mailto:support@occhio.nl">Occhio</a>'.'.',
						'required'      => 0,
						'collapsed'     => '',
						'min'           => 1,
						'max'           => 2,
						'layout'        => 'row',
						'button_label'  => 'Nieuw product toevoegen',
						'sub_fields'    => array (
							$aFieldText + array (
								'key'           => 'field_582097485af2c',
								'label'         => 'Eerste regel',
								'name'          => 'product_firstline',
								'default_value' => '',
							),
							$aFieldText + array (
								'key'           => 'field_582097485af52',
								'label'         => 'Tweede regel',
								'name'          => 'product_secondline',
								'default_value' => '',
							),
							$aFieldText + array (
								'key'           => 'field_582097485af72',
								'label'         => 'Derde regel',
								'name'          => 'product_thirdline',
								'default_value' => '',
							),
							$aFieldMain + array (
								'key'           => 'field_582097485af94',
								'label'         => 'Product pagina',
								'name'          => 'product_page',
								'type'          => 'page_link',
								'instructions'  => '',
								'required'      => 1,
								'post_type'     => array (
									0 => 'page',
								),
								'taxonomy'      => array (),
								'allow_null'    => 0,
								'allow_archives' => 1,
								'multiple'      => 0,
							),
						),
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'occhio-products',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => 1,
				'description'           => '',
			));
		}
	}
}