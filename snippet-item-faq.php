<?php
	$aData 		= $this->aData;
	$sLabel 	= sanitize_title( $aData['faq_question'] );
?>

<li class="faqs--item faq">
	<button class="faq--button">
		<?php echo $aData['faq_question']; ?>
	</button>
	<div class="faq--collaps">
		<?php echo apply_filters( 'the_content', $aData['faq_answer'] ); ?>
	</div>
</li>
