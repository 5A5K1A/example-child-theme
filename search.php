<?php
/**
 * @package WordPress
 * @subpackage Child theme created by Occhio Web Development
 */

get_header();

global $wp_query;
$iTotalResults  = $wp_query->found_posts;
$sSearchString  = strtolower( get_search_query() );
$sSearchResults = ( $iTotalResults > 1 ) ? __('Zoekresultaten', 'od') : __('Zoekresultaat', 'od');

$sNewerEntries  = __('Terug', 'od');
$sOlderEntries  = __('Meer artikelen', 'od');

?>

<main class="articles search">
	<article <?php post_class('articles--article'); ?> id="post-<?php the_ID(); ?>">
		<section class="articles--intro intro section">
			<div class="section--text">

			<?php if( have_posts() && !empty($sSearchString) ) : ?>
				<header>
					<h1><?php echo $iTotalResults." ".$sSearchResults." ".__('voor', 'od')." '".$sSearchString."'"; ?></h1>
				</header>
			</div>
		</section>
	</article>

			<?php while( have_posts() ) : the_post(); ?>

	<article <?php post_class('articles--article'); ?> id="post-<?php the_ID(); ?>">
		<section class="articles--intro intro section">
			<div class="section--text">
				<header>
					<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<?php the_excerpt(); ?>
			</div>
		</section>
	</article>

			<?php endwhile; ?>

	<nav class="page-navigation">
		<div class="page-navigation--prev">
			<?php echo str_replace('<a href=', '<a class="single-link" href=', get_previous_posts_link($sNewerEntries) ); ?>
		</div>
		<div class="page-navigation--next">
			<?php echo str_replace('<a href=', '<a class="single-link" href=', get_next_posts_link($sOlderEntries) ); ?>
		</div>
	</nav>

		<?php else : ?>

				<header>
					<h1><?php _e('Geen resultaten gevonden. Probeer opnieuw?', 'od'); ?></h1>
					<p><?php get_search_form(); ?></p>
				</header>
			</div>
		</section>
	</article>

		<?php endif; ?>

</main>
<?php get_footer(); ?>