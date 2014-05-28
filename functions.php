<?php 

// Register Menu
// =====================================================
	function register_my_menu() {
		register_nav_menu('header-menu',__( 'Header Menu' ));
	}
	add_action( 'init', 'register_my_menu' );

// Post Thumbnail Support
// =====================================================
	add_theme_support( 'post-thumbnails' ); 

// Custom Header Support
// =====================================================
	$defaults = array(
		'random-default'		=> false,
		'default-text-color'	=> '#fff',
		'width'					=> 400,
		'height'				=> 40,
		'flex-height'			=> true,
		'flex-width'			=> true,
		'header-text'			=> false,
	);
	add_theme_support( 'custom-header', $defaults );

// Validate Gravatar
// =====================================================
	function gr_validate_gravatar($email) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}

// Customize Theme Colors
// =====================================================
	function gr_customize_register( $wp_customize ) {
		// Header Color
		$wp_customize->add_setting( 'header_color' , array(
			'default'     => '#ed1c24',
			'transport'   => 'refresh',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label'        => __( 'Header Color', 'header_color' ),
			'section'    => 'header_image',
			'settings'   => 'header_color',
		) ) );
		// Link Color
		$wp_customize->add_setting( 'link_color' , array(
			'default'     => '#3873ed',
			'transport'   => 'refresh',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'        => __( 'Link Color', 'link_color' ),
			'section'    => 'colors',
			'settings'   => 'link_color',
		) ) );
	}
	add_action( 'customize_register', 'gr_customize_register' );

// Admin Bar
// ====================================================
	add_action('get_header', 'gr_filter_head');
	function gr_filter_head() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}


// Infinite Scroll Ajax
// ====================================================
	function gr_infinitepaginate(){ 
		get_template_part( 'loop' , 'ajax');
		exit;
	}
	add_action('wp_ajax_infinite_scroll', 'gr_infinitepaginate');           // for logged in user
	add_action('wp_ajax_nopriv_infinite_scroll', 'gr_infinitepaginate');    // if user not logged in

	function gr_get_permalink(){ 
		$new_url_page_id = $_POST['new_url_page_id'];
		$new_url_page_id = get_permalink($new_url_page_id);
		echo $new_url_page_id;

		die();
	}
	add_action('wp_ajax_get_permalink', 'gr_get_permalink');           // for logged in user
	add_action('wp_ajax_nopriv_get_permalink', 'gr_get_permalink');    // if user not logged in


// Advertising Sidebar
// ====================================================
	$ad_sidebar = array(
		'name'          => 'Advertising',
		'id'            => "ad",
		'description'   => '',
		// 'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		// 'before_title'  => '<h2 class="widgettitle">',
		// 'after_title'   => "</h2>\n",
	);
	register_sidebar( $ad_sidebar );




