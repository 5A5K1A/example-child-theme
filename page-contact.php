<?php
/**
 * Template Name: Contact pagina
 *
 * @package WordPress
 * @subpackage Child theme created by Occhio Web Development
 */

get_header(); ?>

<main class="articles contact">

	<?php if( have_posts() ) :
		while( have_posts() ) :
			the_post();
			$aFlexContent = get_field( 'flex_content' );
			$aContact     = GetContactInfo();
			$aSocial      = GetSocialInfo();
	?>

		<article <?php post_class('articles--article'); ?> id="post-<?php the_ID(); ?>">

			<section class="articles--intro section">
				<div class="section--text">
					<header class="contact--title">
						<h1><?php the_title(); ?></h1>
					</header>

					<ul class="contact--list">
						<li class="contact--item">
							<address class="contact--adress">
								<?php echo $aContact['address']; ?>
							</address>
						</li>
						<li class="contact--item"><?php echo od_get_link( 'tel:'.$aContact['phone'], $aContact['phone'], array('class' => 'contact--link contact--tel', 'aria-label' => __('Bel ons op ', 'od').$aContact['phone']) ); ?></li>
						<li class="contact--item"><?php echo od_get_link( 'mailto:'.$aContact['email'], $aContact['email'], array('class' => 'contact--link contact--mail', 'aria-label' => __('E-mail ons via ', 'od').$aContact['email']) ); ?></li>
					</ul>
					<ul class="contact--list">
						<?php if( !empty($aSocial['facebook']) ) : ?>
							<li class="contact--item">
								<?php echo od_get_link( $aSocial['facebook'], od_strip_url($aSocial['facebook']), array('aria-label' => SITENAME.__(' op Facebook', 'od'), 'class' => 'contact--link contact--facebook') ); ?>
							</li>
						<?php endif; ?>

						<?php if( !empty($aSocial['twitter']) ) : ?>
							<li class="contact--item">
								<?php echo od_get_link( $aSocial['twitter'], od_strip_url($aSocial['twitter']), array('aria-label' => SITENAME.__(' op Twitter', 'od'), 'class' => 'contact--link contact--twitter') ); ?>
							</li>
						<?php endif; ?>

						<?php if( !empty($aSocial['linkedin']) ) : ?>
							<li class="contact--item">
								<?php echo od_get_link( $aSocial['linkedin'], od_strip_url($aSocial['linkedin']), array('aria-label' => SITENAME.__(' op LinkedIn', 'od'), 'class' => 'contact--link contact--linkedin') ); ?>
							</li>
						<?php endif; ?>
					</ul>

				</div>

				<div class="contact--map section--map">
					<ul>
						<li class="marker" data-lat="<?php echo $aContact['location']['lat']; ?>" data-lng="<?php echo $aContact['location']['lng']; ?>">
							<?php echo $aContact['address']; ?>
						</li>
					</ul>
				</div>
			</section>

			<?php // render flexblocks if any
			if( $aFlexContent ) :
				Template::Render( 'snippet-flexcontent', array('aFlexContent' => $aFlexContent) );
			endif; ?>
		</article>

	<?php endwhile; ?>

	<?php endif; ?>
</main>

<?php get_footer(); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY; ?>"></script>
<script type="text/javascript">
	(function($) {

		/*
		*  new_map
		*  This function will render a Google Map onto the selected jQuery element
		*
		*  @type	function
		*  @param	$el (jQuery element)
		*  @return	n/a
		*/
		function new_map( $el ) {
			// var
			var $markers = $el.find('.marker');

			// vars
			var args = {
				zoom		      : 30,
				center		      : new google.maps.LatLng(0, 0),
				mapTypeId	      : google.maps.MapTypeId.ROADMAP,
				mapTypeControl    : false,
				streetViewControl : false,
				scrollwheel       : false,
				styles            : [
					{
						"elementType": "geometry",
						"stylers": [
							{ "color": "#BCB6AF" }
						]
					},{
						"elementType": "labels.icon",
						"stylers": [
							{ "visibility": "off" }
						]
					},{
						"elementType": "labels.text.fill",
						"stylers": [
							{ "color": "#132862" }
						]
					},{
						"elementType": "labels.text.stroke",
						"stylers": [
							{ "color": "#ffffff" }
						]
					},{
						"featureType": "administrative",
						"elementType": "geometry",
						"stylers": [
							{ "visibility": "off" }
						]
					},{
						"featureType": "poi",
						"stylers": [
							{ "visibility": "off" }
						]
					},{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{ "color": "#ffffff" }
						]
					},{
						"featureType": "road",
						"elementType": "labels.icon",
						"stylers": [
							{ "visibility": "off" }
						]
					},{
						"featureType": "road",
						"elementType": "labels.text.fill",
						"stylers": [
							{ "color": "#BCB6AF" }
						]
					},{
						"featureType": "transit",
						"stylers": [
							{ "visibility": "off" }
						]
					},{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{ "color": "#F4F2F0" }
						]
					},{
						"featureType": "water",
						"elementType": "labels.text.fill",
						"stylers": [
							{ "color": "#132862" }
						]
					}
				],
			};

			// create map
			var map = new google.maps.Map( $el[0], args);

			// add a markers reference
			map.markers = [];

			// add markers
			$markers.each(function(){
				add_marker( $(this), map );
			});

			// center map
			center_map( map );

			// return
			return map;
		}

		/*
		*  add_marker
		*  This function will add a marker to the selected Google Map
		*
		*  @type	function
		*  @param	$marker (jQuery element)
		*  @param	map (Google Map object)
		*  @return	n/a
		*/
		function add_marker( $marker, map ) {

			// var
			var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

			// specify marker settings
			var iconBase = '<?php echo get_stylesheet_directory_uri(); ?>/dist/img/icons/';

			// create marker
			var marker = new google.maps.Marker({
				position	: latlng,
				map			: map,
				icon 		: {
					url     : iconBase + 'marker.svg',
					anchor  : new google.maps.Point(50, 50)
				}
			});

			// add to array
			map.markers.push( marker );

			// if marker contains HTML, add it to an infoWindow
			if( $marker.html() ) {
				// create info window
				var infowindow = new google.maps.InfoWindow({
					content		: $marker.html()
				});

				// show info window when marker is clicked
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open( map, marker );
				});
			}
		}

		/*
		*  center_map
		*  This function will center the map, showing all markers attached to this map
		*
		*  @type	function
		*  @param	map (Google Map object)
		*  @return	n/a
		*/
		function center_map( map ) {
			// vars
			var bounds = new google.maps.LatLngBounds();
			// loop through all markers and create bounds
			$.each( map.markers, function( i, marker ) {
				var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
				bounds.extend( latlng );
			});

			// only 1 marker?
			if( map.markers.length == 1 ) {
				// set center of map
				map.setCenter( bounds.getCenter() );
				map.setZoom( 13 );
			} else {
				// fit to bounds
				map.fitBounds( bounds );
			}
		}

		/*
		*  document ready
		*  This function will render each map when the document is ready (page has loaded)
		*
		*  @type	function
		*  @param	n/a
		*  @return	n/a
		*/
		// global var
		var map = null;

		$(document).ready(function() {
			$('.section--map').each(function() {
				// create map
				map = new_map( $(this) );
			});
		});

	})(jQuery);
</script>
