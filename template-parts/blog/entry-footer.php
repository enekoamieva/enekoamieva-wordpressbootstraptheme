<?php

/**
 * Template for post entry footer
 * 
 * @package bootstraptheme
 */

$post_terms = wp_get_post_terms( get_the_ID(), ['category', 'post_tag'] );

if( empty( $post_terms ) || ! is_array( $post_terms ) ) {
    return;
}
?>

<div class="entry-footer mt-4">
    <?php
    foreach( $post_terms as $key => $article_term ) {
        ?>
        <button class="btn border border-secondary mb-2 mr-2">
            <a class="entry-footer-link text-black-50" href="<?php echo esc_url( get_term_link( $article_term ) ); ?>">
                <?php echo esc_html( $article_term -> name ); ?>
            </a>
        </button>
        <?php
    }
    ?>
</div>