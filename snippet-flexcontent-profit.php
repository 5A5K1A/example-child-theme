<?php
	// setup variables
	$iCurrentYear = date('Y');
	$sLastMonth   = 12;
	$sTableHead   = $sArchiveHTML = $sTotalsHTML = $sCurrentHTML = $sLimit = NULL;
	$aColors      = od_get_profile_colors();
	$aMonths      = od_get_months();
	$bCheck       = TRUE;

	// setup table header
	foreach( $aColors as $sColor => $sColorName ) {
		$aSumYears[$sColor] = $aSumMonths[$sColor] = 0;
		$sTableHead .= '<th scope="col" class="bg-' . $sColor . '"><span class="bg-' . $sColor . '--underline">'.$sColorName.'</span></th>';
	}

	// fill years array
	foreach( $this->aArchive as $aYearRow ) {
		foreach( $aColors as $sColor => $sColorName ) {
			// set variables
			$iYear               = $aYearRow['profit_year'];
			$iPercentage         = $aYearRow['profit_'.$sColor];

			// fill arrays
			if ($aSumYearsCalc[$sColor] == '') $aSumYearsCalc[$sColor] = 1;

			$iPercentageCalc = 1 + ($iPercentage / 100);
			$aSumYearsCum = $aSumYearsCalc[$sColor]  * $iPercentageCalc ;
			$aSumYearsCalc[$sColor] = $aSumYearsCum;

			$aSumYears[$sColor] = $aSumYearsCum *100 ;

			$aProfitYears[$iYear][$sColor] = $iPercentage;
		}
	}

	// fill months array (and add the sum to the years array)
	foreach( $this->aCurrent as $key => $aMonthRow ) {
		// early exit if no values are provided
		if( empty($aMonthRow['profit_rood']) ) { continue; }

		// set variables
		if( $bCheck == TRUE ) {
			// reset if this is the first month of the year
			if( $aMonthRow['profit_month'] == 1 ) {
				$iYear  = $iCurrentYear;
				$bCheck = FALSE;
			} else {
				$iLastYear = $iCurrentYear - 1;
				$iYear     = $iLastYear;
			}
		}

		// fill years & totals (sum) array
		foreach( $aColors as $sColor => $sColorName ) {
			// if this is current year add the percentages to the total
			if( $iYear == $iCurrentYear ) {
				$aProfitYears[$iCurrentYear][$sColor] += $aMonthRow['profit_'.$sColor];
				$aSumYearsCalc[$sColor] =  $aSumYearsCalc[$sColor] * ( 1 + ($aMonthRow['profit_'.$sColor]/100));
			}

			// fill arrays
			$sLastMonth = $aMonthRow['profit_month'];
			$sMonth     = $aMonths[$sLastMonth];
			$aProfitMonths[$sMonth][$sColor] = $aMonthRow['profit_'.$sColor];


			$aSumYears[$sColor]   = ($aSumYearsCalc[$sColor]   - 1) * 100;
		}
	}

	// setup other table parts
	$sTotalsHTML  = od_get_tfoot( $aSumYears );
	$sArchiveHTML = od_get_tbody( $aProfitYears, 'year', $sLastMonth );
	$sCurrentHTML = od_get_tbody( $aProfitMonths );

	// write data to json
	$aJSON = $aProfitYears;
	$aJSON['Totaal*'] = $aSumYears;
?>
<!-- create JSON file to make the graph -->
<script>
	var TableData = <?php echo json_encode($aJSON); ?>;
</script>
<section class="section profit">

	<header class="profit--header">
		<p class="profit--title">Profiel</p>
		<ul class="profit--list">
			<li class="profit--type bg-rood"><span class="bg-rood--underline">Rood</span></li>
			<li class="profit--type bg-oranje"><span class="bg-oranje--underline">Oranje</span></li>
			<li class="profit--type bg-geel"><span class="bg-geel--underline">Geel</span></li>
			<li class="profit--type bg-groen"><span class="bg-groen--underline">Groen</span></li>
			<li class="profit--type bg-blauw"><span class="bg-blauw--underline">Blauw</span></li>
		</ul>
	</header>

	<div class="google-chart">
	</div>

	<table class="chartify">
		<col><col><col><col><col><col>
		<thead>
			<tr>
				<td><?php _e('Profiel', 'od'); ?></td>
				<?php echo $sTableHead; ?>
			</tr>
		</thead>
		<tfoot>
			<?php echo $sTotalsHTML; ?>
		</tfoot>
		<tbody>
			<?php echo $sArchiveHTML; ?>
		</tbody>
	</table>

<?php if( get_field('profit_disclamer') != '' ) : ?>
	<p class="profit--footnote"><?php echo get_field('profit_disclamer'); ?></p>
<?php endif; ?>

	<table>
		<col><col><col><col><col><col>
		<thead>
			<tr>
				<td><?php echo $iCurrentYear; ?></td>
				<?php echo $sTableHead; ?>
			</tr>
		</thead>
		<tbody>
			<?php echo $sCurrentHTML; ?>
		</tbody>
	</table>

</section>
