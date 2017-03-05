<?php
	// safety settings
	$sProfileValue = $sSelectedProfile = $sAmountValue = $sWarning = NULL;
	$sShow = 'hide';

	// set variables
	$iPercentage = $iCosts = $i = 0;
	if( GetValue('profile') ) {
		$sSelectedProfile = GetValue('profile');
		$bCalculate = TRUE;
	}
	if( GetValue('amount') ) {
		$iSelectedAmount  = GetValue('amount');
		$sAmountValue     = 'value="'.$iSelectedAmount.'"';
	} else {
		$iSelectedAmount  = 500000;
	}

	$aProfiles = array(
		'rood'   => __('Zeer offensief', 'od'),
		'oranje' => __('Offensief', 'od'),
		'geel'   => __('Neutraal', 'od'),
		'groen'  => __('Defensief', 'od'),
		'blauw'  => __('Zeer defensief', 'od')
	);

	if( $bCalculate ) {
		$sUrl = get_site_url().'/?control=Calculator&profile='.$sSelectedProfile.'&amount='.$iSelectedAmount;
		$oResponse = json_decode( @file_get_contents($sUrl) );

		if( !$oResponse->error ) {
			$iPercentage = $oResponse->percentage;
			$iCosts = $oResponse->costs;
			$sShow = NULL;
		} else {
			$sWarning = '<p class="message">'.$oResponse->message.'</p>';
		}
	}
?>

<section class="section calculator">
	<div class="section--calculator">
		<?php echo $sWarning; ?>
		<form action="" method="post" class="calculator--form form">
			<fieldset class="form--profile profile-calc">
				<legend class="profile-calc--title"><?php _e('Wat is je beleggingsprofiel?', 'od'); ?></legend>
			<?php foreach( $aProfiles as $sColor => $sDescription ) :
				if( $sColor == $sSelectedProfile ) { $bChecked = TRUE; }
				else { $bChecked = FALSE; } ?>
				<input class="profile-calc--radio" type="radio" name="profile" id="profile_<?php echo $sColor; ?>" value="<?php echo $sColor; ?>"<?php if( $i == 0 ) { echo ' required'; $i++; } if( $bChecked ) { echo ' checked'; } ?>>
				<label class="profile-calc--label" for="profile_<?php echo $sColor; ?>">
					<span class="profile-calc--wrapper<?php if( $bChecked ) { echo ' bg-'.$sColor; } ?>">
						<span class="profile-calc--button<?php if( $bChecked ) { echo ' bg-'.$sColor.'--underline'; } ?>"><?php echo ucfirst($sColor); ?></span>
					</span>
					<span class="profile-calc--explain"><?php echo $sDescription; ?></span>
				</label>
			<?php endforeach; ?>
			</fieldset>

			<fieldset class="form--amount">
				<legend><?php _e('Met welk bedrag ga je beleggen?', 'od'); ?></legend>
				<label for="amount"><?php _e('Bedrag', 'od'); ?></label>
				<input type="number" name="amount" min="15000" max="1000000" step="1" required <?php echo $sAmountValue; ?>>
			</fieldset>

			<input type="submit" value="<?php _e('Berekenen', 'od'); ?>">

			<div class="form--output costs <?php echo $sShow; ?>">
				<p class="costs--title"><?php _e('Je jaarlijkse kosten zijn', 'od'); ?></p>
				<span class="costs--percentage percentage"><?php echo od_get_pretty_number( $iPercentage, 2 ); ?>%</span>
				<span class="costs--cost cost">&euro;<?php echo od_get_pretty_number( $iCosts ); ?></span>
			</div>

		</form>
	</div>
</section>
