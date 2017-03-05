<?php foreach( $this->aStaff as $oStaffmember ) :
	$elPerson = new People( $oStaffmember->ID );
	$oPerson  = $elPerson->GetDataObject();

	if( $sImagePosition == 'right' || !isset($sImagePosition) ) { $sImagePosition = 'left'; }
	else { $sImagePosition = 'right'; }
 ?>
	<section class="articles--section section has-img--<?php echo $sImagePosition; ?>">
		<div class="section--text">
			<h2 id="<?php echo $oPerson->slug; ?>"><?php echo $oPerson->name; ?></h2>
			<p class="h4-like"><?php echo $oPerson->role; ?></p>

			<?php echo od_get_link( $oPerson->linkedin, 'LinkedIn', array('class' => 'staff--link staff--linkedin') ); ?>
			<?php echo od_get_link( 'mailto:'.$oPerson->email, 'E-mail', array('class' => 'staff--link staff--mail') ); ?>
			<?php echo od_add_content_class( $oPerson->intro, 'staff--intro' ); ?>
			<?php echo od_add_content_class( $oPerson->content ); ?>
		</div>
		<div class="section--img">
			<?php echo wp_get_attachment_image( $oPerson->image_id, 'content_image', '', array('itemprop' => 'image') ); ?>
		</div>
	</section>
<?php endforeach; ?>
