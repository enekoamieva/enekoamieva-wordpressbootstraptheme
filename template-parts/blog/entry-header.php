<?php

/**
 * Template for post entry header
 * 
 * @package bootstraptheme
 */

?>

<?php
$the_post_id = get_the_ID();
$has_post_thumbnail = get_the_post_thumbnail( $the_post_id );
//Meta Box Hide title
$hide_title = get_post_meta( $the_post_id, '_hide_page_title', true );
?>

<header class="entry-header">
    <!-- Featured Image -->
    <?php if( $has_post_thumbnail ): ?>
        <div class="entry-image mb-3">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php  the_post_thumbnail( 'featured-thumbnail' );  ?>
            </a>
        </div>
    <?php endif; ?>
    <?php echo $hide_title; ?>
</header>