<?php
/**
 * @package WordPress
 * @subpackage Child theme created by Occhio Web Development
 */

get_header(); ?>

<main class="articles">

	<?php if( have_posts() ) :
		while( have_posts() ) :
			the_post();
			// get flex content
			$aFlexContent = get_field( 'flex_content' );
			// get image data
			$iImageID = od_get_post_thumbnail_id();
			$sImageSize = 'home_header';
			$aImageData = wp_get_attachment_image_src( $iImageID, $sImageSize );
			$sImageUrl  = $aImageData[0]; ?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<header class="hero-header video-custom">
				<video class="video" muted autoplay loop poster="<?php echo $sImageUrl; ?>">
					<!-- <source src="<?php get_stylesheet_directory(); ?>/dist/img/video/butterfly.mp4" type="video/mp4"> -->
					<!-- <source src="http://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
					<source src="http://techslides.com/demos/sample-videos/small.webm" type="video/webm"> -->
					<img src="<?php echo $sImageUrl; ?>" title="Your browser does not support the <video> tag">
				</video>

				<div class="hero-header--text-container">
					<h1 class="hero-header--title"><?php echo get_field('home_title'); ?></h1>
					<span class="hero-header--subtitle"><?php echo get_field('home_subtitle'); ?></span>
					<button class="play" type="button" name="button"><span class="play--icon"></span> <span class="play--text"><?php echo get_field('home_playtext'); ?></span></button>
				</div>
			</header>

			<?php // render flexblocks if any
			if( $aFlexContent ) :
				Template::Render( 'snippet-flexcontent', array('aFlexContent' => $aFlexContent) );
			endif; ?>
		</article>

	<?php endwhile; ?>

	<?php endif; ?>
</main>

<?php get_footer(); ?>
