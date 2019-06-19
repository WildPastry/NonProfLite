<?php
/**
 * customiser
 * @package nonproflite
 */

function npl_customize_register($wp_customize)
{
	// remove default options –––––––––––––––––––––––––––––––––––––––––––––––
	// $wp_customize->remove_section('installed_themes'); // Themes // 0
	// $wp_customize->remove_section('title_tagline'); // Site Identity // 20
	// $wp_customize->remove_section('colors'); // Colours // 40
	$wp_customize->remove_section('header_image'); // Header Image // 60
	$wp_customize->remove_section('background_image'); // Background Image // 80
	$wp_customize->remove_section('static_front_page'); // Home Page Settings // 120
	$wp_customize->remove_section('custom_css'); // Additional CSS // 200
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// create homepage panel ––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_panel('homepage_panel', array(
		'title'      => __('Home Page Content', 'nonproflite'),
		'priority'   => 10,
		'description' => 'Edit the home page content'
	));
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// create colours panel –––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_panel('site_colours_panel', array(
		'title'      => __('Site Colours', 'nonproflite'),
		'priority'   => 15,
		'description' => 'Edit the site colours'
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// create font panel –––––––––––––––––––––––––––––––––––––––––––––––––––––
	// $wp_customize->add_panel('site_font_panel', array(
	// 	'title'      => __('Site Font', 'nonproflite'),
	// 	'priority'   => 20,
	// 	'description' => 'Edit the site font'
	// ));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// slideshow –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('featured_slide_section', array(
		'title'      => __('Slideshow', 'non-prof-lite'),
		'description' => 'Insert images for the home page slideshow',
		'priority'   => 15,
		'panel' => 'homepage_panel'
	));

	for ($i = 1; $i <= 3; $i++) {
		$wp_customize->add_setting('featured_slide_' . $i . '_setting', array(
			'default'   => get_template_directory_uri() . '/assets/img/default-slide.jpg',
			'transport' => 'refresh',
		));

		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'featured_slide_' . $i . '_control',
			array(
				'label'      => __('Slideshow Image ' . $i, 'non-prof-lite'),
				'section'    => 'featured_slide_section',
				'settings'   => 'featured_slide_' . $i . '_setting'
			)
		));
	}
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// colours –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// background
	$wp_customize->add_section('background_colour_section', array(
		'title'      => __('Background colour', 'nonproflite'),
		'priority'   => 5,
		'panel' => 'site_colours_panel'
	));

	$wp_customize->add_setting('background_colour_setting', array(
		'default'   => '#fff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'background_colour_control',
		array(
			'label'      => __('Set the background colour', 'nonproflite'),
			'description' => __('Using this option you can change the background colour of your site'),
			'section'    => 'background_colour_section',
			'settings'   => 'background_colour_setting',
		)
	));

	// heading text
	$wp_customize->add_section('heading_colour_section', array(
		'title'      => __('Heading text', 'nonproflite'),
		'priority'   => 10,
		'panel' => 'site_colours_panel'
	));

	$wp_customize->add_setting('heading_colour_setting', array(
		'default'   => '#2b2b2b',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'heading_colour_control',
		array(
			'label'      => __('Set the heading text colour', 'nonproflite'),
			'description' => __('Using this option you can change the heading colour throughout your entire site'),
			'section'    => 'heading_colour_section',
			'settings'   => 'heading_colour_setting',
		)
	));

	// paragraph text
	$wp_customize->add_section('paragraph_colour_section', array(
		'title'      => __('Body text', 'nonproflite'),
		'priority'   => 15,
		'panel' => 'site_colours_panel'
	));

	$wp_customize->add_setting('paragraph_colour_setting', array(
		'default'   => '#2b2b2b',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'paragraph_colour_control',
		array(
			'label'      => __('Set the body text colour', 'nonproflite'),
			'description' => __('Using this option you can change the body text colour throughout your entire site'),
			'section'    => 'paragraph_colour_section',
			'settings'   => 'paragraph_colour_setting',
		)
	));

	// menu and footer bg colours
	$wp_customize->add_section('menu-footer-bg_colour_section', array(
		'title'      => __('Menu and footer background', 'nonproflite'),
		'priority'   => 20,
		'panel' => 'site_colours_panel'
	));

	$wp_customize->add_setting('menu-footer-bg_colour_setting', array(
		'default'   => '#b74f87',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'menu-footer-bg_colour_control',
		array(
			'label'      => __('Set the menu and footer background colour', 'nonproflite'),
			'description' => __('Using this option you can change the background colour of the menu and footer throughout your entire site'),
			'section'    => 'menu-footer-bg_colour_section',
			'settings'   => 'menu-footer-bg_colour_setting',
		)
	));

	// menu and footer text colours
	$wp_customize->add_section('menu-footer-text_colour_section', array(
		'title'      => __('Menu and footer text', 'nonproflite'),
		'priority'   => 25,
		'panel' => 'site_colours_panel'
	));

	$wp_customize->add_setting('menu-footer-text_colour_setting', array(
		'default'   => '#ffffff',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		'menu-footer-text_colour_control',
		array(
			'label'      => __('Set the menu and footer text colour', 'nonproflite'),
			'description' => __('Using this option you can change the text colour of the menu and footer throughout your entire site'),
			'section'    => 'menu-footer-text_colour_section',
			'settings'   => 'menu-footer-text_colour_setting',
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// fonts –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('custom_font_section', array(
		'title'      => __('Site Fonts', 'nonproflite'),
		'priority'   => 20
	));

	$wp_customize->add_setting('custom_font_setting', array(
		'transport' => 'refresh'
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_font_control',
		array(
			'label'      => __('Set the site font', 'nonproflite'),
			'description' => __('Using this option you can change the font throughout your entire site'),
			'section'    => 'custom_font_section',
			'settings'   => 'custom_font_setting',
			'type'    => 'select',
			'choices' => array(
				'default' => 'Fira Sans',
				'merriweather' => 'Merriweather',
				'quicksand' => 'Quicksand'
			)
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// custom intro ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	$wp_customize->add_section('custom_intro_section', array(
		'title'      => __('Custom intro text', 'nonproflite'),
		'priority'   => 25
	));

	$wp_customize->add_setting('custom_intro_setting', array(
		'default'   => 'Welcome to CHCH Bull Breed Rescue',
		'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		'custom_intro_control',
		array(
			'label'      => __('Change custom intro text', 'nonproflite'),
			'section'    => 'title_tagline',
			'settings'   => 'custom_intro_setting',
		)
	));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	// featured posts ––––––––––––––––––––––––––––––––––––––––––––––––––––––
	// $wp_customize->add_section('front_page_section', array(
	//   'title'      => __('Front Page Info', 'nonproflite'),
	//   'priority'   => 25,
	// ));

	// $wp_customize->add_setting('featured-post-setting', array(
	//   'default'   => ' ',
	//   'transport' => 'refresh',
	// ));

	// $args = array(
	//   'posts_per_page' => -1
	// );

	// $allPosts = get_posts($args);

	// $options = array();
	// $options[''] = 'Please select a post';
	// foreach ($allPosts as $singlePost) {
	//   $options[$singlePost->ID] = $singlePost->post_title;
	// }

	// $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'featured-post-control', array(
	//   'label'      => __('Featured Post', 'nonproflite'),
	//   'section'    => 'front_page_section',
	//   'settings'   => 'featured-post-setting',
	//   'type'       => 'select',
	//   'choices' => $options
	// )));
	// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

} // end of customiser function
add_action('customize_register', 'npl_customize_register');

// css for colours panel –––––––––––––––––––––––––––––––––––––––––––––––––
function nonproflite_customize_css()
{
	?>
	<style type="text/css">
		/* background */
		body {
			background:
				<?php echo get_theme_mod('background_colour_setting', '#fff');
				?>;
		}

		/* paragraph text */
		p,
		li {
			color:
				<?php echo get_theme_mod('paragraph_colour_setting', '#2b2b2b');
				?>;
		}

		/* headings text */
		h1
		h1,
		h2,
		h3,
		h4,
		h5 {
			color:
				<?php echo get_theme_mod('heading_colour_setting', '#2b2b2b');
				?>;
		}

		/* font */
		* {
			font-family:
				<?php echo get_theme_mod('custom_font_setting', 'Fira Sans');
				?>;
		}

		/* menu and footer */
		.menuModule li,
		footer {
			background:
				<?php echo get_theme_mod('menu-footer-bg_colour_setting', '#b74f87');
				?>;
		}

		.menuModule a,
		footer p,
		footer a {
			color:
				<?php echo get_theme_mod('menu-footer-text_colour_setting', '#ffffff');
				?>;
		}

		.menuModule a:hover {
			border-bottom: 2px solid <?php echo get_theme_mod('menu-footer-text_colour_setting', '#ffffff');
																?>;
			border-top: 2px solid <?php echo get_theme_mod('menu-footer-text_colour_setting', '#ffffff');
														?>;
		}
	</style>
<?php
} // end of css for colours panel
add_action('wp_head', 'nonproflite_customize_css');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
