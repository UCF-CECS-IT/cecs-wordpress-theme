<!DOCTYPE html>
<html lang="en-us">
	<head>
		<?php wp_head(); ?>
	</head>
	<body ontouchstart <?php body_class(); ?>>
		<a class="skip-navigation bg-complementary text-inverse box-shadow-soft" href="#content">Skip to main content</a>
		<div id="ucfhb"></div>

		<?php do_action( 'after_body_open' ); ?>

		<?php if ( $ucfwp_header_markup = ucfwp_get_header_markup() ) : ?>
		<header class="site-header">
			<?php echo $ucfwp_header_markup; ?>
		</header>
		<?php endif; ?>

		<main class="site-main">
			<?php echo ucfwp_get_subnav_markup(); ?>
			<?php cecs_display_announcements() ?>
			<div class="site-content" id="content" tabindex="-1">
