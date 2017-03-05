<?php

class Framework_Usp {

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

			$aTab = $aFieldMain + array (
				'name'         => '',
				'type'         => 'tab',
				'instructions' => '',
				'required'     => 0,
				'placement'    => 'top',
			);

			$aFieldText = $aFieldMain + array(
				'required'    => 1,
				'type'        => 'text',
				'placeholder' => '',
				'prepend'     => '',
				'append'      => '',
			);

			$aFieldPageLink = $aFieldMain + array (
				'required'       => 1,
				'type'           => 'page_link',
				'instructions'   => '',
				'post_type'      => array (
					0 => 'page',
				),
				'taxonomy'       => array (
				),
				'allow_null'     => 0,
				'allow_archives' => 1,
				'multiple'       => 0,
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
				'key' => 'group_581779afcf32f',
				'title' => 'Options: USP settings',
				'fields' => array (
					$aFieldMessage + array (
						'key'           => 'field_88177701b7c03',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Algemene instellingen voor het USP-blok</h2>',
						'message'       => '',
					),
					$aFieldText + array (
						'key'           => 'field_581779c8e0dbf',
						'label'         => 'Titel',
						'name'          => 'usp_title',
						'instructions'  => '',
						'default_value' => 'What\'s (really) in it for you?',
						'maxlength'     => '',
					),
					$aFieldMessage + array (
						'key'           => 'field_78177701b7c03',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Afzonderlijke USP\'s</h2>',
						'message'       => __('Je kunt door de verschillende tabbladen heen klikken om voor elke USP de teksten en link aan te passen.', 'od').'<br />'.__('Om een speciale styling mee te geven aan een woord, dient deze tussen asterisks (*) geplaatst te worden.', 'od'),
					),

					// USP no.1
					$aTab + array (
						'key'          => 'field_581c971616de1',
						'label'        => '- USP 1 -',
						'endpoint'     => 0,
					),
					$aFieldText + array (
						'key'           => 'field_58177e9d7acb3',
						'label'         => 'Tekst USP slide 1',
						'name'          => 'usp_no1_slide_text',
						'instructions'  => '',
						'default_value' => 'Minder risico door *spreiding*',
						'maxlength'     => '',
					),
					$aFieldText + array(
						'key'           => 'field_78177e9d7acb3',
						'label'         => 'Actie tekst',
						'name'          => 'usp_no1_action_text',
						'instructions'  => '',
						'default_value' => 'Hoe past dit in jouw situatie?',
						'maxlength'     => '',
					),
					$aFieldText + array(
						'key'           => 'field_88177e9d7acb3',
						'label'         => 'Button tekst',
						'name'          => 'usp_no1_button_text',
						'instructions'  => '',
						'default_value' => '',
						'maxlength'     => '',
					),
					$aFieldPageLink + array (
						'key'           => 'field_68177e9d7acb3',
						'label'         => 'Button link',
						'name'          => 'usp_no1_button_link',
					),

					// USP no.2
					$aTab + array (
						'key'          => 'field_581c971616de2',
						'label'        => '- USP 2 -',
						'endpoint'     => 0,
					),
					$aFieldText + array (
						'key'           => 'field_58177ed07acb4',
						'label'         => 'Tekst USP 2',
						'name'          => 'usp_no2_slide_text',
						'instructions'  => '',
						'default_value' => 'Wij staan bij elke stap voor je klaar (als je dat wil)',
						'maxlength'     => '',
					),
					$aFieldText + array (
						'key'           => 'field_88177ed07acb4',
						'label'         => 'Actie tekst',
						'name'          => 'usp_no2_action_text',
						'instructions'  => '',
						'default_value' => 'Hoe past dit in jouw situatie?',
						'maxlength'     => '',
					),
					$aFieldText + array(
						'key'           => 'field_78177ed07acb4',
						'label'         => 'Button tekst',
						'name'          => 'usp_no2_button_text',
						'instructions'  => '',
						'default_value' => '',
						'maxlength'     => '',
					),
					$aFieldPageLink + array (
						'key'           => 'field_68177ed07acb4',
						'label'         => 'Button link',
						'name'          => 'usp_no2_button_link',
					),

					// USP no.3
					$aTab + array (
						'key'          => 'field_581c971616de3',
						'label'        => '- USP 3 -',
						'endpoint'     => 0,
					),
					$aFieldText + array (
						'key'           => 'field_58177edf7acb5',
						'label'         => 'Tekst USP 3',
						'name'          => 'usp_no3_slide_text',
						'instructions'  => '',
						'default_value' => 'Je belegt in alleen ècht duurzame bedrijven',
						'maxlength'     => '',
					),
					$aFieldText + array (
						'key'           => 'field_88177edf7acb5',
						'label'         => 'Actie tekst',
						'name'          => 'usp_no3_action_text',
						'instructions'  => '',
						'default_value' => 'Hoe past dit in jouw situatie?',
						'maxlength'     => '',
					),
					$aFieldText + array(
						'key'           => 'field_78177edf7acb5',
						'label'         => 'Button tekst',
						'name'          => 'usp_no3_button_text',
						'instructions'  => '',
						'default_value' => '',
						'maxlength'     => '',
					),
					$aFieldPageLink + array (
						'key'           => 'field_68177edf7acb5',
						'label'         => 'Button link',
						'name'          => 'usp_no3_button_link',
					),

					// USP no.4
					$aTab + array (
						'key'          => 'field_581c971616de4',
						'label'        => '- USP 4 -',
						'endpoint'     => 0,
					),
					$aFieldText + array (
						'key'           => 'field_58177eed7acb6',
						'label'         => 'Tekst USP 4',
						'name'          => 'usp_no4_slide_text',
						'instructions'  => '',
						'default_value' => 'Ons doel is klanten helpen, niet winst maken',
						'maxlength'     => '',
					),
					$aFieldText + array (
						'key'           => 'field_88177eed7acb6',
						'label'         => 'Actie tekst',
						'name'          => 'usp_no4_action_text',
						'instructions'  => '',
						'default_value' => 'Hoe past dit in jouw situatie?',
						'maxlength'     => '',
					),
					$aFieldText + array(
						'key'           => 'field_78177eed7acb6',
						'label'         => 'Button tekst',
						'name'          => 'usp_no4_button_text',
						'instructions'  => '',
						'default_value' => '',
						'maxlength'     => '',
					),
					$aFieldPageLink + array (
						'key'           => 'field_68177eed7acb6',
						'label'         => 'Button link',
						'name'          => 'usp_no4_button_link',
					),

					// USP no.5
					$aTab + array (
						'key'          => 'field_581c971616de5',
						'label'        => '- USP 5 -',
						'endpoint'     => 0,
					),
					$aFieldText + array (
						'key'           => 'field_58177ef97acb7',
						'label'         => 'Tekst USP 5',
						'name'          => 'usp_no5_slide_text',
						'instructions'  => '',
						'default_value' => 'Je kosten zijn echt heel *laag*',
						'maxlength'     => '',
					),
					$aFieldText + array (
						'key'           => 'field_88177ef97acb7',
						'label'         => 'Actie tekst',
						'name'          => 'usp_no5_action_text',
						'instructions'  => '',
						'default_value' => 'Hoe past dit in jouw situatie?',
						'maxlength'     => '',
					),
					$aFieldText + array(
						'key'           => 'field_78177ef97acb7',
						'label'         => 'Button tekst',
						'name'          => 'usp_no5_button_text',
						'instructions'  => '',
						'default_value' => '',
						'maxlength'     => '',
					),
					$aFieldPageLink + array (
						'key'           => 'field_68177ef97acb7',
						'label'         => 'Button link',
						'name'          => 'usp_no5_button_link',
					),
				),
				'location' => array (
					array (
						array (
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'occhio-usp',
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
