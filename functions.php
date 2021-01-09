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


/**
 * Theme Support
 */

function bootstraptheme_setup_theme() {

    //Title
    add_theme_support( 'title-tag' );

    //Logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ));

    //Custom Background
    add_theme_support( 'custom-background', [
        'default-color' => '#fff',
        'default_image' => ''
    ]);

    //Featured Image
    add_theme_support( 'post-thumbnails' );

    //Register image sizes
    add_image_size( 'featured-thumbnail', 350, 233, true );

    //Refresh Widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    //Feed Links
    add_theme_support( 'automatic-feed-links' );

    //HTML5
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ]);

    //Gutenberg
    add_theme_support( 'wp-block-styles' );

    //Aligment Gutenberg Blocks
    add_theme_support( 'align-wide' );

    //Content Width
    if ( ! isset( $content_width ) ) {
        $content_width = 1200;
    }

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
 * Register Metaboxes
 */
function add_custom_meta_box() {
    $screens = [ 'post' ];

    foreach ( $screens as $screen ) {
        add_meta_box(
            'hide-page-title',                           // Unique ID
            __( 'Hide page title', 'bootstraptheme' ),  // Box title
            'custom_meta_box_html',                     // Content callback, must be of type callable
            $screen,                                    // Post type
            'side'                                      //Context
        );
    }

    function custom_meta_box_html( $post ) {
        $value = get_post_meta( $post->ID, '_hide_page_title', true );

        //Nonce for verification
        wp_nonce_field( 'bootstraptheme_meta_box_nonce', 'hide_page_title_meta_box_nonce_name' );
        ?>

        <label for="bootstraptheme-field"><?php esc_html_e( 'Hide the page title', 'bootstraptheme' ); ?></label>
        <select name="bootstraptheme_hide_title_field" id="bootstraptheme-field" class="postbox">
            <option value=""><?php esc_html_e( 'Select', 'bootstraptheme' ); ?></option>
            <option value="yes" <?php selected( $value, 'yes' ); ?> ><?php esc_html_e( 'Yes', 'bootstraptheme' ); ?></option>
            <option value="no" <?php selected( $value, 'no' ); ?> ><?php esc_html_e( 'No', 'bootstraptheme' ); ?></option>
        </select>

        <?php
    }
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );

/**
 * Save values Metaboxes
 */
function save_post_meta_data( $post_id ) {

    //When the post is saved or updated, check if current user is authorized
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    //Check if the nonce value we receive is the same
    if( ! isset( $_POST['hide_page_title_meta_box_nonce_name'] ) || ! wp_verify_nonce( $_POST['hide_page_title_meta_box_nonce_name'], 'bootstraptheme_meta_box_nonce' ) ) {
        return;
    }

    if ( array_key_exists( 'bootstraptheme_hide_title_field', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_hide_page_title',
            $_POST['bootstraptheme_hide_title_field']
        );
    }
}
add_action( 'save_post', 'save_post_meta_data' );