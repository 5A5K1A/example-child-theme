<?php

class Framework_Calculator {

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

			$aFieldMessage = $aFieldMain + array(
				'name'          => '',
				'type'          => 'message',
				'instructions'  => '',
				'required'      => 0,
				'new_lines'     => 'wpautop',
				'esc_html'      => 0,
			);

			$aFieldPercentage = $aFieldMain + array(
				'min'           => '',
				'max'           => '',
				'placeholder'   => '',
				'prepend'       => '',
				'append'        => '%',
				'type'          => 'number',
				'instructions'  => '',
				'required'      => 1,
			);

			$aOptions = array(
				'location' => array (
					array (
						array (
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'occhio-calculator',
						),
					),
				),
				'menu_order'      => 0,
				'position'        => 'acf_after_title',
				'style'           => 'seamless',
				'instruction_placement' => 'label',
				'hide_on_screen'  => '',
				'active'          => 1,
				'description'     => '',
			);

			$sHeaderStyle = 'color: #132862; background-color: #80DEEA; font-weight: 600; font-size: 1.5em; margin-bottom: 0.5em;';

			acf_add_local_field_group( $aOptions + array (
				'key'    => 'group_5s7627063f31e',
				'title'  => 'Options: Calculator',
				'fields' => array (
					$aFieldMessage + array (
						'key'           => 'field_a8177701b7c02',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Basis percentage voor kostencalculator</h2>',
						'message'       => '',
					),
				),
				'label_placement' => 'top',
			));

			acf_add_local_field_group( $aOptions + array (
				'key'    => 'group_5ss627063f31e',
				'title'  => 'Options: Calculator',
				'fields' => array (
					$aFieldPercentage + array (
						'default_value' => '194.1',
						'step'          => '0.1',
						'key'           => 'field_58762728ceae2',
						'label'         => 'Basis percentage',
						'name'          => 'calc_base_perc',
					),
				),
				'label_placement' => 'left',
			));

			acf_add_local_field_group( $aOptions + array (
				'key'    => 'group_5sss27063f31e',
				'title'  => 'Options: Calculator',
				'fields' => array (
					$aFieldMessage + array (
						'key'           => 'field_aa177701b7c02',
						'label'         => '<h2 style="'.$sHeaderStyle.'">Percentage voor de verschillende profielen</h2>',
						'message'       => '',
					),
				),
				'label_placement' => 'top',
			));

			acf_add_local_field_group( $aOptions + array (
				'key'    => 'group_5ssss7063f31e',
				'title'  => 'Options: Calculator',
				'fields' => array (
					$aFieldPercentage + array (
						'default_value' => '0.006075',
						'step'          => '0.000001',
						'key'           => 'field_58762774ceae3',
						'label'         => '<span style="color: #132862; padding: 0.5em 1em; background-color: #FFCDD2;">Rood percentage</span>',
						'name'          => 'calc_rood_perc',
					),
					$aFieldPercentage + array (
						'default_value' => '0.006099',
						'step'          => '0.000001',
						'key'           => 'field_587627b2ceae4',
						'label'         => '<span style="color: #132862; padding: 0.5em 1em; background-color: #FFE0B2;">Oranje percentage</span>',
						'name'          => 'calc_oranje_perc',
					),
					$aFieldPercentage + array (
						'default_value' => '0.006126',
						'step'          => '0.000001',
						'key'           => 'field_58762859503a6',
						'label'         => '<span style="color: #132862; padding: 0.5em 1em; background-color: #FFF9C4;">Geel percentage</span>',
						'name'          => 'calc_geel_perc',
					),
					$aFieldPercentage + array (
						'default_value' => '0.006152',
						'step'          => '0.000001',
						'key'           => 'field_58762a403c12c',
						'label'         => '<span style="color: #132862; padding: 0.5em 1em; background-color: #D1F1BE;">Groen percentage</span>',
						'name'          => 'calc_groen_perc',
					),
					$aFieldPercentage + array (
						'default_value' => '0.00618',
						'step'          => '0.000001',
						'key'           => 'field_58762a5a3c12d',
						'label'         => '<span style="color: #132862; padding: 0.5em 1em; background-color: #E0F7FA;">Blauw percentage</span>',
						'name'          => 'calc_blauw_perc',
					),
				),
				'label_placement' => 'left',
			));

		}
	}
}