<?php

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

?>