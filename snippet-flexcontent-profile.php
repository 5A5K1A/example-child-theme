<section class="profiles">
	<dl class="profiles--list">
		<?php foreach( $this->aProfiles as $iNumber => $aProfile ) {
			Template::Render('snippet-item-profile', array('iRow' => $iNumber, 'aData' => $aProfile ) );
		} ?>
	</dl>
<?php if( $this->sDisclaimer != '' ) : ?>
	<p class="profiles--footnote"><?php echo $this->sDisclaimer; ?></p>
<?php endif; ?>
</section>
