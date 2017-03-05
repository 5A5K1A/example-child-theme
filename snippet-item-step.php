<?php
	$aData 		= $this->aData;
?>

<li class="steps--item step">
	<div class="step--icon" style="background-image: url('<?php echo $aData['step_icon']; ?>')"></div>
	<div class="step--text">
		<h3 class="step--title"><?php echo $aData['step_title']; ?></h3>
		<?php echo od_add_content_class( $aData['step_text'], 'step--explenation' ); ?>
	</div>
</li>