<main class="articles blog-page">
	<?php if( have_posts() ) :
		if( !is_single() ) :
			$bArchive = TRUE;
			$sIntro = get_post_field('post_content', BLOG); ?>

		<header class="blog-page--title">
			<h1><?php echo get_the_title( BLOG ); ?></h1>
			<?php if( !empty($sIntro) && get_query_var('paged') < 1 ) {
				echo od_add_content_class( $sIntro, $sClass = NULL );
				} ?>
		</header>
		<section class="blogs">
			<div class="blogs--grid">
	<?php endif;

		while( have_posts() ) :
			the_post();

			// get custom post author
			$oAuthor  = get_field( 'post_writer' );

			// get post thumnail (or fallback)
			$iImageID = od_get_post_thumbnail_id();

			// get (pretty) post datetime
			$sTimeToShow  = get_the_time( get_option( 'date_format' ) );

			if( is_single() ) :
				// get image data
				$sImageSize = 'blog_header';
				$aImageData = wp_get_attachment_image_src( $iImageID, $sImageSize );
				$sImageUrl  = $aImageData[0];
			?>

				<article <?php post_class('articles--article'); ?> id="post-<?php the_ID(); ?>" itemprop="mainContentOfPage" itemscope itemType="http://schema.org/Blog">
					<header class="blog--header hero-header" style="background-image: url('<?php echo $sImageUrl; ?>')">
						<div class="hero-header--text-container">
							<h1 class="hero-header--title" itemprop="headline"><?php the_title(); ?></h1>
							<time class="hero-header--date" datetime="<?php the_time('Y-m-d H:i:s') ?>" itemprop="datePublished"><?php echo $sTimeToShow; ?></time>
						</div>
					</header>

					<?php Template::Render( 'snippet-blog-author', array('oAuthor' => $oAuthor) ); ?>

					<section class="blog--container intro">
						<?php the_content(); ?>
					</section>

					<?php Template::Render('snippet-blog-addtoany'); ?>

					<?php Template::Render('snippet-blog-related'); ?>

				</article>

		<?php else : ?>

			<?php Template::Render( 'snippet-item-blog', array('oPost' => get_post(), 'type' => 'archive', 'iImageID' => $iImageID, 'oAuthor' => $oAuthor) ); ?>

		<?php endif; ?>

	<?php endwhile;

	if( $bArchive == TRUE ) : ?>
		</div>
	</section>

	<?php endif;
	get_template_part('snippet', 'prev-next'); ?>

	<?php else : get_template_part('snippet', 'not-found'); endif; ?>

</main>
