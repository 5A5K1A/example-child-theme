<?php
	$oPeople = new People();

	// where my people at?
	$aPeople = $oPeople->GetSome(100);
?>
	<section class="articles--section people">
		<div class="people--container">
			<ul class="people--list">
				<?php foreach( $aPeople as $oPerson ) {
					Template::Render('snippet-item-people', array('oPerson' => $oPerson) );
				} ?>
			</ul>
		</div>
	</section>
