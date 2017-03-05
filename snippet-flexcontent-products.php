<?php
	$aData     = $this->aData;
	$aProducts = GetProductData();
?>

<section class="articles--section section product-choices">
	<header class="centered-title product-choices--title">
		<h2><?php echo $aData['products_title']; ?></h2>
	</header>

	<?php foreach( $aProducts as $iNumber => $aProduct ) {
		if( $iNumber == 0 ) { $sType = 'beheer'; } elseif( $iNumber == 1 ) { $sType = 'advies'; }
		Template::Render('snippet-item-product', array('sType' => $sType, 'aData' => $aProduct ) );
	} ?>
</section>
