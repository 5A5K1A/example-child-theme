<?php
	$aFaq = $this->aFaq;
?>

<section class="section faqs">
	<ul class="faqs--list">
	<?php
	foreach( $aFaq as $aFaqItem ) {
		if( $aFaqItem['acf_fc_layout'] == 'title' ) {
			echo '<div class="faqs--title"><h2>'.$aFaqItem['faq_title'].'</h2></div>';
		} else {
			Template::Render( 'snippet-item-faq', array('aData' => $aFaqItem) );
		}
	} ?>
	</ul>
</section>
