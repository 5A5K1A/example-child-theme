<?php
	$oPost      = $this->oPost;
	$sImageSize = 'blog_overview';

	if( $this->type == 'related' ) {
		// get post thumnail (or fallback)
		$iImageID = od_get_post_thumbnail_id( $oPost->ID );
		// get custom post author
		$oAuthor  = get_field( 'post_writer', $oPost->ID );

	} else {
		$iImageID = $this->iImageID;
		$oAuthor  = $this->oAuthor;
	}

	// get time to show
	$sTimeToShow = od_get_the_timetoshow( $oPost->ID );
?>

<article <?php post_class( 'blog-item', $oPost->ID ); ?> id="post-<?php echo $oPost->ID; ?>">
	<a class="blog-item--link" href="<?php the_permalink( $oPost->ID ); ?>">
		<div class="blog-item--img-container">
			<?php echo wp_get_attachment_image( $iImageID, $sImageSize, '', array('class' => 'blog-item--img') ); ?>
		</div>
		<h2 class="blog-item--title"><?php echo $oPost->post_title; ?></h2>
		<p class="blog-item--meta">
			<span class="blog-item--author"><?php echo $oAuthor->post_title; ?></span> <span class="blog-item--seperation">*</span> <time class="blog-item--date" datetime="<?php echo $oPost->post_date; ?>"><?php echo $sTimeToShow; ?></time>
		</p>
	</a>

</article>
