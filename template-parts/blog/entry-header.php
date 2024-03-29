<?php

/**
 * Template for post entry header
 * 
 * @package bootstraptheme
 */

$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail( $the_post_id );
//Meta Box Hide title
$hide_title = get_post_meta( $the_post_id, '_hide_page_title', true );
//Heading class if Hide Title or not Hide Title
if( $hide_title === 'yes' ) {
    $heading_class = 'hide-heading';
    
} else {
    $heading_class = 'g';
}
//$heading_class = ! empty( $hide_title ) || $hide_title === 'yes' ? 'hide-heading' : '' ;
?>

<header class="entry-header">
    <!-- Featured Image -->
    <?php if( $has_post_thumbnail ): ?>
        <div class="entry-image mb-3">
            <a href="<?php the_permalink(); ?>">
                <?php
                if( is_single() ) {
                    the_post_thumbnail( 'full' );
                } else {
                    the_post_thumbnail( 'featured-thumbnail' );
                } 
                ?>
            </a>
        </div>
    <?php else: ?>
        <div class="entry-image mb-3">
            <a href="<?php the_permalink(); ?>">
                <img src="https://via.placeholder.com/350x233">
            </a>
        </div>
    <?php endif; ?>

    <!-- Title -->
    <?php if( is_single() || is_page() ): ?>
        <h1 class="page-title text-dark <?php echo esc_attr( $heading_class ); ?>"><?php the_title(); ?></h1>
    <?php else: ?>
        <h2 class="entry-title mb-3"><a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>

</header>