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
	// $wp_customize->remove_section('static_front_page'); // Home Page Settings // 120
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
			'label'      => __('Set the background color', 'nonproflite'),
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
			'section'    => 'paragraph_colour_section',
			'settings'   => 'paragraph_colour_setting',
		)
	));

	// header and footer
	// $wp_customize->add_section('bar_colour_section', array(
	// 	'title'      => __('Header and footer', 'nonproflite'),
	// 	'priority'   => 20,
	// 	'panel' => 'site_colours_panel'
	// ));

	// $wp_customize->add_setting('bar_colour_setting', array(
	// 	'default'   => '#fff',
	// 	'transport' => 'refresh',
	// ));

	// $wp_customize->add_control(new WP_Customize_Color_Control(
	// 	$wp_customize,
	// 	'bar_colour_control',
	// 	array(
	// 		'label'      => __('Set Header and footer colour', 'nonproflite'),
	// 		'section'    => 'bar_colour_section',
	// 		'settings'   => 'bar_colour_setting',
	// 	)
	// ));

	// custom intro ––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	//   $wp_customize->add_section('custom_intro_section', array(
	//     'title'      => __('Custom intro text', 'nonproflite'),
	//     'priority'   => 80
	//   ));

	//   $wp_customize->add_setting('custom_intro_setting', array(
	//     'default'   => 'Welcome to nonproflite',
	//     'transport' => 'refresh',
	//   ));

	//   $wp_customize->add_control(new WP_Customize_Control(
	//     $wp_customize,
	//     'custom_intro_control',
	//     array(
	//       'label'      => __('Change custom intro text', 'nonproflite'),
	//       'section'    => 'title_tagline',
	//       'settings'   => 'custom_intro_setting',
	//     )
	//   ));
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
			background-color:
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
		h1,
		h2,
		h3,
		h4,
		h5 {
			color:
				<?php echo get_theme_mod('heading_colour_setting', '#2b2b2b');
				?>;
		}

		/* header and footer */
		/* .navbar,
			.footer {
				background-color:
					<?php echo get_theme_mod('bar_colour_setting', '#fff');
					?>;
			} */
	</style>
<?php
} // end of css for colours panel
add_action('wp_head', 'nonproflite_customize_css');
// –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
