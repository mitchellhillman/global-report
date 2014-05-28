<!DOCTYPE HTML>
<html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php wp_title('|', true, 'right'); ?></title></title>

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen">
		<link rel="icon" type="image/x-icon" href="favicon.ico" />
		<link rel="apple-touch-icon-precomposed" href="icon.png" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>

		<!-- Custom Theme Colors -->
		<style type="text/css">
			.masthead {
				background-color: <?php echo get_theme_mod('header_color'); ?>;
			}
			a {
				color: <?php echo get_theme_mod('link_color'); ?>;
			}
			.current-menu-item a,
			.current_page_item a  {
				color: <?php echo get_theme_mod('header_color'); ?>;
			}
		</style>
	</head>
	<body <?php body_class($class); ?>>
		
		<div class="header">
			<div class="masthead <?php if (is_archive()): ?>archive<?php endif; ?>">
				<?php if (get_header_image() != ''): ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php header_image(); ?>" alt="<?php bloginfo( $name ); ?>" /></a>
				<?php else: ?>
					<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( $name ); ?></a></h1>
				<?php endif ?>
				<?php if (is_archive()): ?>
					<p class="category-title"><?php single_cat_title( '', true ) ?></p>
				<?php endif ?>
			</div><!-- /.masthead -->

			<div class="drawer-toggles">
				<a href="#" data-target="drawer-menu" class="menu">Menu</a>
				<a href="#" data-target="drawer-search" class="search">Search</a>
			</div>
			
			<div class="drawer-container">
				<div class="drawer drawer-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
				</div>
				<div class="drawer drawer-search">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div><!-- /.header -->

		<div class="content">