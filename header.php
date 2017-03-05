<?php
/**
 * @package WordPress
 * @subpackage WordPress Theme by Occhio Web Development
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('&laquo;', true, 'right'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php get_template_part('head', 'icons'); ?>

		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#57AB27">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#57AB27">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">

  		<!-- styles and scripts enqueued in functions.php -->
		<?php wp_head(); ?>

		<!--[if lt IE 9]>
			<script type="text/javascript" src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<!--
			This website/webapplication is developed by:
			Occhio
			https://www.occhio.nl/
			info@occhio.nl
			+31 (0)20 320 78 70
		-->
	</head>
	<body <?php body_class(); ?>>
		<?php Template::Render('site-header'); ?>