<?php
/**
 * master functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package master
 */

if ( ! function_exists( 'master_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function master_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on master, use a find and replace
		 * to change 'master' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'master', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'master' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'master_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'master_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function master_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'master_content_width', 640 );
}
add_action( 'after_setup_theme', 'master_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function master_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'master' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'master' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'master_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function master_scripts() {
	wp_enqueue_style( 'master-style', get_stylesheet_uri() );

	wp_enqueue_script( 'master-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'master-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'master_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Hide the Default posts editor on Back office.
 */
function hide_edit_post_visual_editor() {
    echo '<style>
    div.editor-block-list__layout.block-editor-block-list__layout{display: none;}
    div.edit-post-visual-editor.editor-styles-wrapper{max-height: 200px;}
    </style>';
}
add_action('admin_head', 'hide_edit_post_visual_editor');

/**
 * Delete unmatched files.
 */
function delete_unmatched_files($pages_title, $files, $dir) {
    if ( count( $files ) !== count( $pages_title ) ) {
        for ( $i = 0; $i < count( $files ) -2; $i++) {
            if ( ! in_array( $files[$i], $pages_title ) ) {
                unlink( $dir . $files[$i] );
            }
        }
    }
}

/**
 * Require pages.
 */
function require_pages( $pages, $dir ) {
    foreach( $pages as $page ) {
        if ( file_exists( $dir . strtolower($page->post_title) . '.php' ) ) {
            require_once $dir . strtolower($page->post_title) . '.php';
        }
    }
}

/**
 * Manage pages.
 */
function manage_pages( $pages, $dir ) {
    $files = scandir( $dir, 1 );
    $pages_title = array();

    foreach ($pages as $page) {
        array_push( $pages_title, strtolower( $page->post_title ) . '.php' );
    }

    delete_unmatched_files( $pages_title, $files, $dir );
    require_pages( $pages_title, $dir );
}

/**
 * Create page route acf.
 */
function create_page_route_acf() {
    $pages = get_pages( array( 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
    $page = strtolower( $pages[0]->post_title );
    $dir = get_stylesheet_directory() . '/pages/';
    $file = fopen( $dir . $page . '.php', 'w' );
    fwrite(
    $file,
    "<?php
    /**
    * Template Name: {$pages[0]->post_title}
    *
    * It's the {$page} page of the application.
    * Please note that this is the WordPress construct of pages
    * and that other 'pages' on your WordPress site may use a
    * different template.
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package master
    */");
    fclose( $file );
    manage_pages( $pages, $dir );
}
add_action('save_post_page', 'create_page_route_acf');
