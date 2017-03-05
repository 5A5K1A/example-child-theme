<?php
	// setup image data if needed
	if( !empty($this->aData['fullwidth_image']) ) :
		$sImageSize  = 'blog_wide';
		$sImage      = wp_get_attachment_image( $this->aData['fullwidth_image'], $sImageSize, '', array('itemprop' => 'image') );
?>

	<section class="articles--section section has-img--l">
		<?php echo $sImage; ?>
	</section>

<?php endif; ?>
