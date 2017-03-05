<?php

/* Hooks
/* ------------------------------------ */

/* Customize the search form
/* ------------------------------------ */
add_filter( 'get_search_form', function( $form ) {
	$sSearchHolder = __('Wat zoek je?', 'od');
	return <<<EOHTML
		<form method="get" class="searchform" action="/">
			<div class="input-group">
				<input name="s" type="search" class="form-control" placeholder="{$sSearchHolder}">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</form>
EOHTML;
});

/*
* Exclude certain Pages from Search Results
* http://stanhub.com/how-to-exclude-a-page-from-wordpress-search-results/
*/
add_filter( 'pre_get_posts' , 'search_exc_pages' );
function search_exc_pages( $query ) {

	$aExclPages = array(
		HOME,
		NOT_FOUND,
		TESTPAGE, // Occhio styling blokken pagina
	);

	if( $query->is_admin ) {
		return $query;
	}

	if( $query->is_search ) {
		$query->set( 'post__not_in' , $aExclPages );
		$query->set( 'post_type', array('post', 'page') );
	}
	return $query;
}

/*  Add responsive container to embeds
/* ------------------------------------ */
function od_embed_html( $html, $url, $attr ) {

	// ugly version load oembed class
	require_once('wp-includes/class-oembed.php');

	// slow process to check data type
	$oEmbed   = new WP_oEmbed();
	$provider = $oEmbed->get_provider( $url, $args );
	$data     = $oEmbed->fetch( $provider, $url, $args );

	// if type is video
	if( $data->type == 'video' ) {

		// check if class already exists
		if( strpos($html, 'class="') ) {
			// add class
			$html = str_replace( 'class="', 'class="embed-responsive-item ', $html );
		} else {
			// dirty string replace to add class
			$html = str_replace( '<iframe', '<iframe class="embed-responsive-item"', $html );
		}

		return <<<EOHTML
	<div class="embed-responsive embed-responsive-16by9">
		{$html}
	</div>

EOHTML;
	}

	return $html;

}

add_filter( 'embed_oembed_html', 'od_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'od_embed_html', 10, 3 );

/* replaces [...] with ... in excerpt
/* ------------------------------------ */
add_filter( 'excerpt_more', function( $more ) {
	return '...';
});

/* Extra filter for the_title breakingpoints
/* ------------------------------------ */
add_filter( 'the_title', function( $title ) {
	return str_replace('||', '&shy;', $title);
});

/* Convert absolute URLs in content to site relative ones
/* Inspired by http://thisismyurl.com/6166/replace-wordpress-static-urls-dynamic-urls/
/* ------------------------------------ */
add_filter( 'content_save_pre', function( $content ) {

	$sSiteURL    = get_bloginfo('url');
	$sNewContent = str_replace(' src=\"'.$sSiteURL, ' src=\"', $content );

	return str_replace(' href=\"'.$sSiteURL, ' href=\"', $sNewContent );
},'99');

add_filter( 'addtoany_sharing_disabled', function() {
	return true;
});

add_filter( 'wp_revisions_to_keep', function( $number, $post ) {
	if( in_array(OD_ENV, array( 'local', 'dev' )) ) { return $number; }
	else { return 3; }
}, 10, 2 );
