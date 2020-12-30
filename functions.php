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