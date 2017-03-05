<?php
	$aData = $this->aData;
	if( $aData['action_link'] == 'page' ) {
		$sUrl = $aData['action_link_url'];
	} else {
		$sUrl = $aData['action_link_file'];
	}
?>

<section class="articles--section section action">
	<header class="centered-title">
		<h2><?php echo $aData['action_title']; ?></h2>
	</header>

	<?php echo od_get_link( $sUrl, $aData['action_link_text'], array('class' => 'single-link--center action--button') ); ?>
</section>
