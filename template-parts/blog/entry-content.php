<?php

/**
 * Template for post entry content
 * 
 * @package bootstraptheme
 */

?>

<div class="entry-content">
    <?php
        if( is_single() ) {
            the_content(
                sprintf(
                    wp_kses(
                        __('Continue reading %s <span class="meta-nav">&rarr</span>', 'bootstraptheme'),
                        [
                            'span' => [
                                'class' => []
                            ]
                        ]
                    ),
                    the_title( '<span class="screen-reader-text">', '</span>', false )
                )
            );
            //Post pagination
            wp_link_pages( $args );
            $args = array(
                'before'    => '<div class="page-links">' . esc_html( 'Pages:', 'bootstraptheme' ),
                'after'     => '</div>'
            );

        } else {
            bootstraptheme_the_excerpt(200);
            bootstraptheme_excerpt_read_more();
        }
    ?>
</div>