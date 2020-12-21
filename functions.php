<?php

/**
 * Theme Functions
 * 
 * @package bootstraptheme
 */

function themecurso_enqueue_scripts() {
    wp_register_style( 'style-css', get_stylesheet_uri(), [], '1.0.0'  );
    wp_register_script( 'main-js', get_template_directory_uri() . '/assets/main.js', [], '1.0.0', true );

    wp_enqueue_style( 'style-css' );
    wp_enqueue_script( 'main-js' );
}
add_action( 'wp_enqueue_scripts', 'themecurso_enqueue_scripts' );