<?php
foreach( $this->aFlexContent as $aFlexblock ) {
	if( isset($aFlexblock['acf_fc_layout']) ) { ?>
		<?php Template::Render( 'snippet-flexcontent-'.$aFlexblock['acf_fc_layout'], array('aData' => $aFlexblock) ); ?>
	<?php }
}
