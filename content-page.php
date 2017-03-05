<main class="articles">

	<?php if( have_posts() ) :
		while( have_posts() ) :
			the_post();
			$sImage      = NULL;
			$sExtraClass = NULL;

			if( has_post_thumbnail() ) {
				$sExtraClass = 'has-img--right';
				$sImageSize  = 'medium';
				$sImage      = wp_get_attachment_image( get_post_thumbnail_id(), $sImageSize, '', array('itemprop' => 'image') );
			}
			$aFlexContent = get_field( 'flex_content' ); ?>

		<article <?php post_class('articles--article'); ?> id="post-<?php the_ID(); ?>">

			<section class="articles--intro intro section <?php echo $sExtraClass; ?>">
				<div class="section--text">
					<header>
						<h1><?php the_title(); ?></h1>
					</header>

					<?php the_content(); ?>
				</div>

			<?php if( !empty($sImage) ) : ?>
				<div class="section--img">
					<?php echo $sImage; ?>
				</div>
			<?php endif; ?>
			</section>

			<?php // if this is the "CALCULATOR" page, display the calculator
			if( in_array(get_the_ID(), array( CALCULATOR, TESTPAGE )) ) :
				Template::Render( 'snippet-flexcontent-calculator' );
			endif; ?>

			<?php // if this is the "FAQ" page, display the questions & answers
			if( in_array(get_the_ID(), array( FAQ, TESTPAGE )) ) :
				Template::Render( 'snippet-flexcontent-faq', array('aFaq' => get_field('faq')) );
			endif; ?>

			<?php // if this is the "employee" page, display the employees
			if( in_array(get_the_ID(), array( STAFF, TESTPAGE )) ) :
				Template::Render( 'snippet-flexcontent-staff', array('aStaff' => get_field('staff')) );
			endif; ?>

			<?php // if this is the "profiles" page, display the profile colors
			if( in_array(get_the_ID(), array( PROFILE, TESTPAGE )) ) :
				Template::Render( 'snippet-flexcontent-profile', array('aProfiles' => get_field('profile'), 'sDisclaimer' => get_field('profile_disclamer') ) );
			endif; ?>

			<?php // if this is the "profits" page, display the profit charts
			if( in_array(get_the_ID(), array( PROFIT, TESTPAGE )) ) :
				Template::Render( 'snippet-flexcontent-profit', array('aArchive' => get_field('profit_archive'), 'aCurrent' => get_field('profit_current') ) );
			endif; ?>

			<?php // if this is the "STEPS" page, display the steps on how to join
			if( in_array(get_the_ID(), array( STEPS, TESTPAGE )) ) :
				Template::Render( 'snippet-flexcontent-steps', array('aSteps' => get_field('steps')) );
			endif; ?>

			<?php // if this is the "iframe" page, display the iframe
			if( get_field('iframe_url') != '' ) :
				Template::Render( 'snippet-flexcontent-iframe', array('sIframeUrl' => get_field('iframe_url'), 'iHeight' => get_field('iframe_height') ) );
			endif; ?>

			<?php // render flexblocks if any
			if( $aFlexContent ) : ?>
				<?php Template::Render( 'snippet-flexcontent', array('aFlexContent' => $aFlexContent) ); ?>
			<?php endif; ?>
		</article>

	<?php endwhile; ?>

	<?php else : get_template_part('snippet', 'not-found'); endif; ?>
</main>
