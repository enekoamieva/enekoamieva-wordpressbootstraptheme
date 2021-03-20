<?php


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
    if( ! isset( $_POST['hide_page_title_meta_box_nonce_name'] ) || 
        ! wp_verify_nonce( $_POST['hide_page_title_meta_box_nonce_name'], 'bootstraptheme_meta_box_nonce' ) ) {
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

?>