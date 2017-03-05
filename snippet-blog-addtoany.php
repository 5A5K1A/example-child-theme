<?php if( !get_post_meta(get_the_ID(), 'sharing_disabled') ) : ?>
	<!-- add to any social share -->
	<section class="addtoany">
		<p class="addtoany--title"><?php echo get_field( 'blog_share', 'options' ); ?></p>
		<?php echo do_shortcode('[addtoany]'); ?>
	</section>
<?php endif; ?>
