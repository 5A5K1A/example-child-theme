<?php
if( function_exists('get_fields') ) :
	$aSocial = GetSocialInfo();
?>

<ul class="social--list">

	<?php if( !empty($aSocial['facebook']) ) {
		echo '<li class="social--item">'.od_get_link( $aSocial['facebook'], '<span class="screen-reader">Facebook</span>', array('aria-label' => get_bloginfo('name').__(' op Facebook', 'od'), 'class' => 'social--link social--facebook') ).'</li>';
	} ?>

	<?php if( !empty($aSocial['twitter']) ) {
		echo '<li class="social--item">'.od_get_link( $aSocial['twitter'], '<span class="screen-reader">Twitter</span>', array('aria-label' => get_bloginfo('name').__(' op Twitter', 'od'), 'class' => 'social--link social--twitter') ).'</li>';
	} ?>

	<?php if( !empty($aSocial['linkedin']) ) {
		echo '<li class="social--item">'.od_get_link( $aSocial['linkedin'], '<span class="screen-reader">LinkedIn</span>', array('aria-label' => get_bloginfo('name').__(' op LinkedIn', 'od'), 'class' => 'social--link social--linkedin') ).'</li>';
	} ?>

</ul>
<?php endif; ?>
