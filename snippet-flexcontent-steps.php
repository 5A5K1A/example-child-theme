<?php
	$aSteps = $this->aSteps;

	if( !empty($aSteps) ) :
?>

<section class="steps">
	<ul class="steps--list">
		<?php
		foreach( $aSteps as $aStep ) {
			Template::Render( 'snippet-item-step', array('aData' => $aStep) );
		} ?>
	</ul>
</section>

<?php endif; ?>