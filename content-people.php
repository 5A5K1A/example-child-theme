<main class="articles">

	<?php if( have_posts() ) :
		while( have_posts() ) :
			the_post();

			$elAuthor  = new People();
			$oAuthor   = $elAuthor->GetDataObject();

			$sImage      = NULL;
			$sExtraClass = NULL;

			if( has_post_thumbnail() ) {
				$sExtraClass = 'has-img--right';
				$sImageSize  = 'content_image';
				$sImage      = wp_get_attachment_image( get_post_thumbnail_id(), $sImageSize, '', array('itemprop' => 'image') );
			}
		 ?>

		<article <?php post_class('articles--article'); ?> id="post-<?php the_ID(); ?>">

			<section class="articles--intro intro section <?php echo $sExtraClass; ?>">
				<div class="section--text">
					<header>
						<h1>
							<?php the_title(); ?><?php if( !empty($oAuthor->birth) ) { echo ' ('.$oAuthor->birth.')'; } ?>
						</h1>
					</header>
					<br />
					<div class="staff--meta">
						<p class="author--name"><?php echo $oAuthor->role; ?></p>
						<?php echo od_get_link( $oAuthor->linkedin, 'LinkedIn', array('class' => 'author--link author--linkedin') ); ?>
						<?php echo od_get_link( 'mailto:'.$oAuthor->email, 'E-mail', array('class' => 'author--link author--mail') ); ?>
						<?php echo od_add_content_class( $oAuthor->intro, 'author--intro' ); ?>
					</div>

					<?php the_content(); ?>
				</div>

			<?php if( !empty($sImage) ) : ?>
				<div class="section--img">
					<?php echo $sImage; ?>
				</div>
			<?php endif; ?>
			</section>

		</article>

		<?php endwhile;

	else : get_template_part('snippet', 'not-found');
	endif; ?>

</main>
