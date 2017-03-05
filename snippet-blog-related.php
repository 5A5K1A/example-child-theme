<?php
	$aPosts = od_get_related_posts( get_the_ID() );
?>

<section class="related-blogs is-brown">
	<header class="related-blogs--title">
		<h2><?php _e('Onze andere blog artikelen', 'od'); ?></h2>
	</header>
	<div class="related-blogs--container blogs">
		<div class="blogs--grid">
			<?php foreach( $aPosts as $oPost ) {
				Template::Render( 'snippet-item-blog', array('oPost' => $oPost, 'type' => 'related') );
			} ?>
		</div>
	</div>
</section>
