<?php
/**
 * @package WordPress
 * @subpackage Child theme created by Occhio Web Development
 */
	if( trim($_SERVER['REQUEST_URI'], '/') == 'stijldocument' || trim($_SERVER['REQUEST_URI'], '/') == 'testdocument' ) {
		header('location: /?control=dev&method=' . trim($_SERVER['REQUEST_URI'], '/'));
		exit;
	}
	get_header();

	$oPost = get_post(NOT_FOUND);
	setup_postdata( $oPost );
	$sImage      = NULL;
	$sExtraClass = NULL;

	if( has_post_thumbnail( $oPost->ID ) ) {
		$sExtraClass = 'has-img';
		$sImageSize  = 'medium';
		$sImage      = wp_get_attachment_image( get_post_thumbnail_id( $oPost->ID ), $sImageSize, '', array('itemprop' => 'image') );
	}
	$aFlexContent = get_field( 'flex_content', $oPost->ID );
?>
	<main class="articles">
		<article <?php post_class('articles--article'); ?> id="post-<?php echo $oPost->ID; ?>">

			<section class="articles--intro intro section <?php echo $sExtraClass; ?>">
				<div class="section--text">
					<header>
						<h1><?php echo get_the_title( $oPost->ID ); ?></h1>
					</header>

					<?php the_content(); ?>
				</div>

			<?php if( !empty($sImage) ) : ?>
				<div class="section--img">
					<?php echo $sImage; ?>
				</div>
			<?php endif; ?>

			</section>

			<?php // render flexblocks if any
			if( $aFlexContent ) : ?>
				<?php Template::Render( 'snippet-flexcontent', array('aFlexContent' => $aFlexContent) ); ?>
			<?php endif; ?>

		</article>
	</main>

<?php get_footer(); ?>
