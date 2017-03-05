<?php
	$aData        = $this->aData;
	$aRandomQuote = array();

	// check if quotes are specified
	if( $aData['quote_custom'] == 1 && !empty($aData['quote_selected']) ) {
		// extra check for adding only published quotes
		foreach( $aData['quote_selected'] as $iQuote ) {
			if( get_post_status($iQuote) == 'publish' ) {
				$aRandomQuote[] = $iQuote;
			}
		}
	}

	// extra safety net, so no error is shown
	if( count($aRandomQuote) < 1 ) {
		// get random published quote
		$aRandomQuote = get_posts(array(
			'post_type' 	=> 'quote',
			'post_status' 	=> 'publish',
			'orderby' 		=> 'rand',
			'showposts' 	=> 3,
		));
	}
?>

<section class="articles--section quotes">
	<?php
		foreach( $aRandomQuote as $iQuoteID ) {
			Template::Render('snippet-item-quote', array('iQuoteID' => $iQuoteID));
		}
	?>
</section>
