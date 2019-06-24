<?php
/**
 * header
 * @package nonproflite
 */

// get site title
$blog_title = get_bloginfo('name');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="Non-Prof Lite - Custom Wordpress Theme">
	<meta name="description" content="Non-Prof Lite - Non-Prof Lite is a user-friendly and free WordPress theme">
	<meta name="keywords" content="one-column, flexible-header, accessibility-ready, custom-colors, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, slideshow, map-support">
	<title><?php echo $blog_title ?> | <?php the_title(); ?></title>
	<?php wp_head(); ?>
</head> <!-- head -->

<body <?php body_class(); ?>>

	<!-- logo and social media icons -->
	<?php get_template_part('inc/templates/logo-social'); ?>

	<!-- master container -->
	<div class="container-fluid-master">