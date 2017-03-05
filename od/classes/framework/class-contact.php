<?php

class Framework_Contact {

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

			$aFieldSocial = $aFieldMain + array (
				'prefix'        => '',
				'type'          => 'text',
				'instructions'  => '',
				'required'      => 0,
				'default_value' => '',
				'placeholder'   => '',
				'append'        => '',
				'maxlength'     => '',
				'readonly'      => 0,
				'disabled'      => 0,
			);

			$aFieldMessage = $aFieldMain + array(
				'name'          => '',
				'type'          => 'message',
				'instructions'  => '',
				'required'      => 0,
				'new_lines'     => 'wpautop',
				'esc_html'      => 0,
			);

			$sHeaderStyle = 'color: #132862; background-color: #80DEEA; font-weight: 600; font-size: 1.5em; margin-bottom: 0.5em;';

			acf_add_local_field_group( array (
				'key'    => 'group_5811f353429bb',
				'title'  => 'Contact Info',
				'fields' => array (
					$aFieldMessage + array (
						'key'           => 'field_68177701b7c02',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Algemene contactgegevens</h2>',
						'message'       => '',
					),
					$aFieldMain + array (
						'key'           => 'field_5811f40910f2b',
						'label'         => 'Telefoonnummer',
						'name'          => 'contact_phone',
						'type'          => 'text',
						'instructions'  => '',
						'required'      => 1,
						'default_value' => '',
						'prepend'       => '',
						'append'        => '',
						'placeholder'   => '',
						'maxlength'     => '',
					),
					$aFieldMain + array (
						'key'           => 'field_5811f44710f2c',
						'label'         => 'E-mailadres',
						'name'          => 'contact_email',
						'type'          => 'email',
						'instructions'  => '',
						'required'      => 1,
						'default_value' => '',
						'prepend'       => '',
						'append'        => '',
						'placeholder'   => '',
						'maxlength'     => '',
					),
					$aFieldMain + array (
						'key'           => 'field_5811f47310f2d',
						'label'         => 'Adres',
						'name'          => 'contact_address',
						'type'          => 'textarea',
						'instructions'  => '',
						'required'      => 1,
						'default_value' => '',
						'rows'          => 2,
						'new_lines'     => 'br',
						'placeholder'   => '',
						'maxlength'     => '',
					),
					$aFieldMain + array (
						'key'           => 'field_5811f4a910f2e',
						'label'         => 'Plaats op de kaart',
						'name'          => 'contact_location',
						'type'          => 'google_map',
						'instructions'  => '',
						'required'      => 1,
						'center_lat'    => 52.356,
						'center_lng'    => 4.869,
						'zoom'          => 19,
						'height'        => 300,
					),
					$aFieldMessage + array (
						'key'           => 'field_68177701b7c03',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Instellingen Social Media</h2>',
						'message'       => '<strong>'.__('Let op', 'od').':</strong> '.__('Vul hier de complete url in van de social media kanalen. Dat wil zeggen inclusief https:// of http://', 'od'),
					),
					$aFieldSocial + array (
						'key'           => 'field_5576e221bd548',
						'label'         => 'Twitter',
						'name'          => 'sm_twitter',
						'prepend'       => '<img src="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/svgs/fi-social-twitter.svg" alt="Twitter" width="20" />',
					),
					$aFieldSocial + array (
						'key'           => 'field_5576e26a97063',
						'label'         => 'Facebook',
						'name'          => 'sm_facebook',
						'prepend'       => '<img src="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/svgs/fi-social-facebook.svg" alt="Facebook" width="20" />',
					),
					$aFieldSocial + array (
						'key'           => 'field_5577e7aab8b10',
						'label'         => 'LinkedIn',
						'name'          => 'sm_linkedin',
						'prepend'       => '<img src="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/svgs/fi-social-linkedin.svg" alt="Instagram" width="20" />',
					),
					$aFieldMessage + array (
						'key'           => 'field_58177701b7c02',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Instellingen Helpdesk-blok</h2>',
						'message'       => '',
					),
					$aFieldMain + array (
						'key'           => 'field_6711f40910f2b',
						'label'         => 'Titel',
						'name'          => 'helpdesk_title',
						'type'          => 'text',
						'instructions'  => '',
						'required'      => 1,
						'default_value' => '',
						'prepend'       => '',
						'append'        => '',
						'placeholder'   => '',
						'maxlength'     => '',
					),
					$aFieldMain + array (
						'key'           => 'field_6811f40910f2b',
						'label'         => 'Ondertitel',
						'name'          => 'helpdesk_text',
						'type'          => 'text',
						'instructions'  => '',
						'required'      => 1,
						'default_value' => '',
						'prepend'       => '',
						'append'        => '',
						'placeholder'   => '',
						'maxlength'     => '',
					),
					$aFieldMain + array (
						'key'           => 'field_88204eb594bbc',
						'label'         => 'Foto van de helpdesk',
						'name'          => 'helpdesk_image',
						'type'          => 'image',
						'instructions'  => '',
						'required'      => 1,
						'return_format' => 'id',
						'preview_size'  => 'thumbnail',
						'library'       => 'all',
						'min_width'     => '',
						'min_height'    => '',
						'min_size'      => '',
						'max_width'     => '',
						'max_height'    => '',
						'max_size'      => '',
						'mime_types'    => '',
					),
					$aFieldMessage + array (
						'key'           => 'field_58136171b7d02',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Instellingen Nieuwsbrief-link (in de footer)</h2>',
						'message'       => '',
					),
					$aFieldMain + array (
						'key'           => 'field_9161f40910f2b',
						'label'         => 'Tekst',
						'name'          => 'newsletter_text',
						'type'          => 'text',
						'instructions'  => '',
						'required'      => 1,
						'default_value' => '',
						'prepend'       => '',
						'append'        => '',
						'placeholder'   => '',
						'maxlength'     => '',
					),
				),
				'location'   => array (
					array (
						array (
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'occhio-contact',
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