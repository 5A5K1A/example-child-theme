<?php

/* Profile specific hooks (for profile & profit pages)
/* ------------------------------------ */

/**
 * Gets the profile colors (with their pretty names)
 * @return     array  The profile colors (with their pretty names)
 */
function od_get_profile_colors() {
	return array(
		'rood'   => __('Rood', 'od'),
		'oranje' => __('Oranje', 'od'),
		'geel'   => __('Geel', 'od'),
		'groen'  => __('Groen', 'od'),
		'blauw'  => __('Blauw', 'od'),
	);
}

/**
 * Renders the table footer rows
 * @param      array    $array  The array with totals
 * @return     string   The table footer rows
 */
function od_get_tfoot( $array ) {
	if( !$array ) { return; }

	$row_one = $row_two = NULL;
	$row_one_text = __('Totaal', 'od');
	$row_two_text = __('In ', 'od').'&#37;';

	foreach( od_get_profile_colors() as $color => $color_name ) {
		if( $array[$color] < 0 ) { $class = 'neg'; }
		else { $class = 'pos'; }
		$row_one .= '<td class="'.$class.'">'.od_get_pretty_number( (100 + $array[$color]), 2 ).'</td>';
		$row_two .= '<td class="'.$class.'">'.od_get_pretty_number($array[$color], 2).'&#37;</td>';
	}

	return <<<EOHTML

			<!--<tr>
				<th scope="row">{$row_one_text}</th>
				{$row_one}
			</tr>-->
			<tr>
				<th scope="row">{$row_two_text}</th>
				{$row_two}
			</tr>
EOHTML;
}

 /**
  * Renders the table body row from array of data
  * @param      array           $array       The array
  * @param      string          $type        The type
  * @param      integer|string  $last_month  The last month
  * @return     string          The table body row
  */
function od_get_tbody( $array, $type = 'month', $last_month = 12 ) {

	if( $type == 'year' && $last_month != 12 ) {
		$months       = od_get_months();
		$current_year = date('Y');

		// get last day of this month
		$last_day = date( 't', strtotime($current_year.'-'.$last_month.'-01') );
		$limit_text   = '<span>'.__('t/m ', 'od').$last_day.' '.strtolower($months[$last_month]).'</span>';
	}

	foreach( $array as $label => $percentage ) {

		if( $type == 'year' && $label == $current_year ) { $label .= $limit_text; }

		$row = NULL;

		foreach( od_get_profile_colors() as $color => $color_name ) {
			if( $percentage[$color] < 0 ) { $sClass = 'neg'; }
			else { $sClass = 'pos'; }
			$row .= '<td class="'.$sClass.'">'.od_get_pretty_number($percentage[$color], 2).'&#37;</td>';
		}

		$tbody .= <<<EOHTML

			<tr>
				<th scope="row">{$label}</th>
				{$row}
			</tr>
EOHTML;
	}
	return $tbody;
}
