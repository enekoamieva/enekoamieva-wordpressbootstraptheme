<?php

/**
 * Theme Functions
 * 
 * @package bootstraptheme
 */

function bootstraptheme_enqueue_scripts() {

    //Register Styles
    wp_register_style( 'style-css', get_stylesheet_uri(), [], '1.0.0'  );
    wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', [], false, 'all'  );
    
    //Register Scripts
    wp_register_script( 'main-js', get_template_directory_uri() . '/assets/main.js', [], '1.0.0', true );
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', ['jquery'], false, true  );

    //Enqueue Styles
    wp_enqueue_style( 'style-css' );
    wp_enqueue_style( 'bootstrap-css' );

    //Enqueue Scripts
    wp_enqueue_script( 'main-js' );
    wp_enqueue_script( 'bootstrap-js' );
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
