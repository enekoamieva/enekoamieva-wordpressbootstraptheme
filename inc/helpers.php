<?php

/**
 * Excerpt posts
 */
function bootstraptheme_the_excerpt( $trim_character_count = 0 ) {
    if( ! has_excerpt() || $trim_character_count === 0 ) {
        //WP Default Excerpt
        the_excerpt();
        return;
    } else {
        //Custom excerpt
        $excerpt = wp_strip_all_tags( get_the_excerpt() );
        $excerpt = substr( $excerpt, 0, $trim_character_count );
        $excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );

        echo $excerpt . '[...]';
    }
}


/**
 * Excerpt Read More
 */
function bootstraptheme_excerpt_read_more( $more = '' ) {
    if( ! is_single() ) {
        $more = sprintf(
            '<button class="mt-4 btn btn-info"><a class="bootstraptheme-read-more text-white" href="%1$s">%2$s</a></button>',
            get_permalink( get_the_ID() ),
            __( 'Read More', 'bootstraptheme' )
        );
    }

    echo $more;
}


/**
 * Blog pagination
 */
function bootstraptheme_pagination() {
    $allowed_tags = array(
        'span'  => [
            'class' => []
        ],
        'a' => [
            'class' => [],
            'href' => [],
        ]
    );

    $args = array(
        'before_page_number'    => '<span class="btn border border-secondary mr-2 mb-2">',
        'after_page_number'     => '</span>'
    );

    printf(
        '<nav class="bootstraptheme-pagination clearfix">%s</nav>',
        wp_kses( paginate_links($args), $allowed_tags )
    );
}

?>