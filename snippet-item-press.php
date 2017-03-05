<?php
	$oPost      = $this->oPost;
	$sImageSize = 'blog_overview';
	$iImageID   = $this->iImageID;
	$sSource    = $this->sSource;

	// get time to show
	$sTimeToShow = get_the_time( get_option( 'date_format' ), $oPost->ID );
?>

<article <?php post_class( 'blog-item', $oPost->ID ); ?> id="post-<?php echo $oPost->ID; ?>">
	<a class="blog-item--link" href="<?php the_permalink( $oPost->ID ); ?>">
		<div class="blog-item--img-container">
			<?php echo wp_get_attachment_image( $iImageID, $sImageSize, '', array('class' => 'blog-item--img') ); ?>
		</div>
		<h2 class="blog-item--title"><?php echo $oPost->post_title; ?></h2>
		<p class="blog-item--meta">
			<span class="blog-item--source"><?php echo $sSource; ?></span> <span class="blog-item--seperation">*</span> <time class="blog-item--date" datetime="<?php echo $oPost->post_date; ?>"><?php echo $sTimeToShow; ?></time>
		</p>
	</a>

</article>
