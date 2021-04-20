<?php

/**
 * Theme Functions
 * 
 * @package bootstraptheme
 */

if( ! defined( 'BOOTSTRAPTHEME_BUILD_DIR_URI' ) ) {
    define( 'BOOTSTRAPTHEME_BUILD_DIR_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );
}

if( ! defined( 'BOOTSTRAPTHEME_BUILD_JS_URI' ) ) {
    define( 'BOOTSTRAPTHEME_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/js' );
}

if( ! defined( 'BOOTSTRAPTHEME_BUILD_JS_DIR_PATH' ) ) {
    define( 'BOOTSTRAPTHEME_BUILD_JS_DIR_PATH', untrailingslashit( get_stylesheet_directory() ) . '/assets/build/js' );
}

if( ! defined( 'BOOTSTRAPTHEME_BUILD_IMG_URI' ) ) {
    define( 'BOOTSTRAPTHEME_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/src/img' );
}

if( ! defined( 'BOOTSTRAPTHEME_BUILD_CSS_URI' ) ) {
    define( 'BOOTSTRAPTHEME_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/css' );
}

if( ! defined( 'BOOTSTRAPTHEME_BUILD_CSS_DIR_PATH' ) ) {
    define( 'BOOTSTRAPTHEME_BUILD_CSS_DIR_PATH', untrailingslashit( get_stylesheet_directory() ) . '/assets/build/css' );
}

function bootstraptheme_enqueue_scripts() {

    //Register Styles
    wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/assets/src/library/bootstrap/css/bootstrap.min.css');
    wp_register_style( 'main-css', BOOTSTRAPTHEME_BUILD_CSS_URI . '/main.css', ['bootstrap-css'], filemtime( BOOTSTRAPTHEME_BUILD_CSS_DIR_PATH . '/main.css' ) );
    
    //Register Scripts
    wp_register_script( 'main-js', BOOTSTRAPTHEME_BUILD_JS_URI . '/main.js', [], filemtime( BOOTSTRAPTHEME_BUILD_JS_DIR_PATH . '/main.js' ), true );
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/assets/src/library/bootstrap/js/bootstrap.min.js', ['jquery'], false, true  );

    //Enqueue Styles
    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'main-css' );

    //Enqueue Scripts
    wp_enqueue_script( 'main-js' );
    wp_enqueue_script( 'bootstrap-js' );

    //Remove Gutenberg block library CSS from loading on the frontend
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wp-block-style' ); //Remove Woocommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'bootstraptheme_enqueue_scripts' );


//Theme HELPERS
include get_template_directory() . '/inc/helpers.php';

//Theme METABOXES
include get_template_directory() . '/inc/metaboxes.php';


/**
 * Theme Support
 */
function bootstraptheme_setup_theme() {
    include get_template_directory() . '/inc/theme-support.php';
}
add_action( 'after_setup_theme', 'bootstraptheme_setup_theme' );


/**
 * Register Menu
 */
function bootstraptheme_register_menus() {
    register_nav_menus([
        'header-menu'   => __( 'Header Menu', 'bootstraptheme'),
        'footer-menu'   => __( 'Footer Menu', 'bootstraptheme')
    ]);
}
add_action( 'init', 'bootstraptheme_register_menus' );


/**
 * Get Menu ID
 */
function get_menu_id( $location ) {
    //Get all locations
    $locations = get_nav_menu_locations();

    //Get object id by location
    $menu_id = $locations[$location];

    return !empty( $menu_id ) ? $menu_id : '' ;
}

/**
 * Get Child Menu items
 */
function get_child_menu_items( $menu_array, $parent_id ) {
    $child_menus = [];

    if( ! empty( $menu_array ) && is_array( $menu_array ) ) {
        foreach( $menu_array as $menu ) {
            if( intval( $menu->menu_item_parent ) === $parent_id ) {
                array_push( $child_menus, $menu );
            }
        }
    }

    return $child_menus;
}

/**
 * Sidebars
 */
function bootstraptheme_register_sidebar() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'bootstraptheme' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main Sidebar', 'bootstraptheme' ),
        'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar( array(
        'name'          => __( 'Footer Sidebar', 'bootstraptheme' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Footer Sidebar', 'bootstraptheme' ),
        'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action( 'widgets_init', 'bootstraptheme_register_sidebar' );
