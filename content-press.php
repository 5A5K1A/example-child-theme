<main class="articles">
	<?php if( have_posts() ) :
		if( !is_single() ) :
			$bArchive = TRUE;
			$sIntro = get_post_field('post_content', PRESS); ?>

		<header class="blog-page--title">
			<h1><?php echo get_the_title( PRESS ); ?></h1>
			<?php if( !empty($sIntro) && get_query_var('paged') < 1 ) {
				echo od_add_content_class( $sIntro, 'blog-page--intro' );
				} ?>
		</header>
		<section class="blogs">
			<div class="blogs--grid">
	<?php endif;

		while( have_posts() ) :
			the_post();

			// get custom post source
			$sSource  = get_field( 'press_source' );

			// get post thumnail (or fallback)
			$iImageID = od_get_post_thumbnail_id();

			// get (pretty) post datetime
			$sTimeToShow  = get_the_time( get_option( 'date_format' ) );

			if( is_single() ) :
				// get image data
				$sImageSize = 'press_header';
				$aImageData = wp_get_attachment_image_src( $iImageID, $sImageSize );
				$sImageUrl  = $aImageData[0];

				// get download link
				$aFile      = get_field('press_file');
			?>

				<article <?php post_class('articles--article press-detail'); ?> id="post-<?php the_ID(); ?>">
					<header class="blog--header hero-header" style="background-image: url('<?php echo $sImageUrl; ?>')">
						<div class="hero-header--text-container">
							<h1 class="hero-header--title"><?php the_title(); ?></h1>
							<time class="hero-header--date"><?php echo $sTimeToShow; ?></time>
						</div>
					</header>

					<section class="blog--container intro">
						<?php if( !empty($sSource) ) { echo __('Bron: ', 'od').$sSource; } ?>
						<?php the_content(); ?>
						<?php if( !empty($aFile) ) { echo od_get_link( $aFile['url'], __('Download ', 'od').$aFile['title'] ); } ?>
					</section>

					<?php Template::Render('snippet-blog-addtoany'); ?>

				</article>

		<?php else : ?>

			<?php Template::Render( 'snippet-item-press', array('oPost' => get_post(), 'type' => 'archive', 'iImageID' => $iImageID, 'sSource' => $sSource) ); ?>

		<?php endif; ?>

	<?php endwhile;

	if( $bArchive == TRUE ) : ?>
		</div>
	</section>

	<?php endif; ?>

	<?php else : get_template_part('snippet', 'not-found'); endif; ?>

</main>
