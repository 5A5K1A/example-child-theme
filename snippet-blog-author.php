<?php
	$elAuthor  = new People( $this->oAuthor );
	$oAuthor   = $elAuthor->GetDataObject();
?>

<section class="author" itemscope itemtype="http://schema.org/Person" iitemprop="author">
	<div class="author--container">
		<?php echo wp_get_attachment_image( $oAuthor->image_id, 'thumbnail', '', array('itemprop' => 'image', 'class' => 'author--img') ); ?>
		<div class="author--meta">
			<p class="author--name" itemprop="name">
					<?php echo od_get_link( $oAuthor->permalink, $oAuthor->shortlabel, array('class' => 'author--link') ); ?>
			</p>
			<?php echo od_get_link( $oAuthor->linkedin, '<span class="screen-reader">'.od_strip_url($oAuthor->linkedin).'</span>', array('class' => 'author--link author--linkedin') ); ?>
			<?php echo od_get_link( 'mailto:'.$oAuthor->email, '<span class="screen-reader">'.$oAuthor->email.'</span>', array('class' => 'author--link author--mail') ); ?>
			<?php echo od_add_content_class( $oAuthor->intro, 'author--intro' ); ?>
		</div>
	</div>
</section>
