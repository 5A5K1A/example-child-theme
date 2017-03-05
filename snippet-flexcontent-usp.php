<?php $aData = GetUspSettings(); ?>

<div class="home-brown">
	<section class="articless--section usps">
		<header class="centered-title usp--title">
			<h2 class="usp--title"><?php echo $aData['header']; ?></h2>
		</header>

		<button class="usps--prev-button">
			<svg class="svg--arrow-left" width="27px" height="40px" viewBox="0 0 27 40"><polygon class="arrow" points="2.20268248e-13 0 19.9992124 20.0007876 0.00157523727 40 5.76681795 40 25.7628799 19.9992124 5.76366747 0"></polygon></svg>
		</button>
		<ul class="usps--list">
			<?php foreach( $aData['items'] as $iNumber => $aItem) {
				Template::Render( 'snippet-item-usp', array('iSlide' => $iNumber, 'aData' => $aItem) );
			} ?>
		</ul>
		<button class="usps--next-button">
			<svg class="svg--arrow-right" width="27px" height="40px" viewBox="0 0 27 40"><polygon class="arrow" points="2.20268248e-13 0 19.9992124 20.0007876 0.00157523727 40 5.76681795 40 25.7628799 19.9992124 5.76366747 0"></polygon></svg>
		</button>
	</section>
</div>
