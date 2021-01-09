<?php

/**
 * Template for post entry meta
 * 
 * @package bootstraptheme
 */

$post_date = get_the_date( 'l j F, Y', $post->ID );
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
?>

<div class="entry-meta mb-3">
    <time class="entry-date published" datetime="<?php esc_attr_e( get_the_date(DATE_W3C) ); ?>">
        <span class="posted-one text-secondary">
            <?php esc_html_e( 'Posted on', 'bootstraptheme'); ?>
            <a href="<?php the_permalink(); ?>">
                <?php esc_attr_e( $post_date ); ?>
            </a>
        </span>
    </time>

    <span class="byline text-secondary">
        <span class="author vcard">
            <?php esc_html_e( 'by', 'bootstraptheme'); ?>
            <a href="<?php echo esc_url($author_url) ; ?>">
                <?php esc_html_e( get_the_author() ); ?>
            </a>
        </span>
    </span>
</div>