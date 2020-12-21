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