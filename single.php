<?php

/**
 * Single template file
 * 
 * @package bootstraptheme
 */
?>

<?php get_header(); ?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">

        <?php if ( have_posts() ) : ?>

            <div class="container">

                <?php if( is_home() && ! is_front_page() ): ?>
                    <header class="mb-5">
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'template-parts/content' ); ?>

                <?php endwhile; ?>

            </div><!-- .container -->

            <?php else: ?>

                <?php get_template_part( 'template-parts/content-none' ); ?>

        <?php endif; ?>

        <div class="container">
            <?php
                previous_post_link();
                next_post_link();
            ?>
        </div>

    </main>
</div>

<?php get_footer(); ?>