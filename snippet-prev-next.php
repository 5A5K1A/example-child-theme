<?php
	$sNewerEntries = __('Terug', 'od');
	$sOlderEntries = __('Meer artikelen', 'od');
?>
	<nav class="page-navigation">
		<div class="page-navigation--prev">
			<?php echo str_replace('<a href=', '<a class="single-link" href=', get_previous_posts_link($sNewerEntries) ); ?>
		</div>
		<div class="page-navigation--next">
			<?php echo str_replace('<a href=', '<a class="single-link" href=', get_next_posts_link($sOlderEntries) ); ?>
		</div>
	</nav>
