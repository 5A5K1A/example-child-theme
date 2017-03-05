<?php $aData = $this->aData;
	$sImage      = NULL;
	$sButtonLink = NULL;
	$sExtraClass = NULL;

	if( !empty($aData['content_show']) ) {
		// build button link if needed
		if( in_array('button', $aData['content_show']) && !empty($aData['content_button_text']) && !empty($aData['content_button_link']) ) {
			$sButtonLink = od_get_link( $aData['content_button_link'], $aData['content_button_text'], array('class' => 'single-link section--button') );
			$sExtraClass = 'has-button';
		}

		// setup image data if needed
		if( in_array('image', $aData['content_show']) && !empty($aData['content_image']) ) {
			$sExtraClass .= ' has-img--'.$aData['content_image_side'];
			$sImageSize  = 'content_image';
			$sImage      = wp_get_attachment_image( $aData['content_image'], $sImageSize, '', array('itemprop' => 'image') );
		}
	}
?>

<section class="articles--section section <?php echo $sExtraClass; ?>">
	<div class="section--text">
		<?php echo od_add_content_class( $aData['content_text'], '' ); ?>
		<?php echo $sButtonLink; ?>
	</div>

<?php if( !empty($sImage) ) : ?>
	<div class="section--img<?php if( is_front_page() ) { echo '--l'; } ?>">
		<?php echo $sImage; ?>
	</div>
<?php endif; ?>

</section>
