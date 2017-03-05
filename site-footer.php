<footer class="site-footer">

	<nav class="nav--menu menu is-footer">
		<div class="nav--menu menu">
			<div class="menu--contact menu--lists">
				<?php Template::Render( 'snippet-footer-contact'); ?>
			</div>
			<?php Template::Render( 'snippet-menu-lists'); ?>

		</div>
	</nav>

	<section class="social">
		<div class="social--icons">
			<h3 class="social--title"><?php _e('Volg ons', 'od'); ?></h3>
			<?php Template::Render('snippet-social-media'); ?>
		</div>
		<div class="social--mail">
			<?php echo od_get_link( NEWSLETTER, get_field('newsletter_text', 'options'), array('class' => 'mailchimp--link single-link') ); ?>
		</div>
	</section>

</footer>
