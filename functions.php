<?php 

// Validate Gravatar
// =====================================================

	function globalreport_validate_gravatar($email) {
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

// Register Menus
// =====================================================

	// Header Menu
	function register_main_menu() {
		register_nav_menu('header-menu',__( 'Header Menu' ));
	}
	add_action( 'init', 'register_main_menu' );

// Register Sidebars
// ====================================================

	// Ad Sidebar
	$ad_sidebar = array(
		'name'          => 'Advertising',
		'id'            => "ad",
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
	);
	register_sidebar( $ad_sidebar );

// Theme Support
// =====================================================

	// Post Thumbnail
	add_theme_support( 'post-thumbnails' ); 

	// Custom Header
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


// Theme Customization
// =====================================================

	function globalreport_customize_register( $wp_customize ) {
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
	add_action( 'customize_register', 'globalreport_customize_register' );

// Admin Bar
// ====================================================

	add_action('get_header', 'globalreport_filter_head');
	function globalreport_filter_head() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}

// Ajax
// ====================================================

	// Infinate Paginate
	function globalreport_infinitepaginate(){ 
		get_template_part( 'loop' , 'ajax');
		exit;
	}
	add_action('wp_ajax_infinite_scroll', 'globalreport_infinitepaginate');           // for logged in user
	add_action('wp_ajax_nopriv_infinite_scroll', 'globalreport_infinitepaginate');    // if user not logged in

	// Get Permalink
	function globalreport_get_permalink(){ 
		$new_url_page_id = $_POST['new_url_page_id'];
		$new_url_page_id = get_permalink($new_url_page_id);
		echo $new_url_page_id;

		die();
	}
	add_action('wp_ajax_get_permalink', 'globalreport_get_permalink');           // for logged in user
	add_action('wp_ajax_nopriv_get_permalink', 'globalreport_get_permalink');    // if user not logged in

// Comments
// ====================================================

	if ( ! function_exists( 'globalreport_comment' ) ) :
	function globalreport_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'globalreport' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'globalreport' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?>>
			<div id="comment-<?php comment_ID(); ?>" class="comment-block">
				<div class="comment-meta comment-author vcard">
					<?php
						printf( '<b class="fn">%1$s</b> %2$s',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'globalreport' ) . '</span>' : ''
						);
					?>
				</div><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'globalreport' ); ?></p>
				<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
				</section><!-- .comment-content -->

				<div class="comment-actions">
					<?php edit_comment_link( __( 'Edit', 'globalreport' ), '<p class="edit-link">', '</p>' ); ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'globalreport' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</div><!-- /.comment -->
		</li>
		<?php
			break;
		endswitch; // end comment_type check
	}
	endif;