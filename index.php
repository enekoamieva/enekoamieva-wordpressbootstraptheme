<?php

/**
 * Main template file
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

                <div class="row">


                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="col-lg-4 col-md-6 col-xs-1">
                            <?php get_template_part( 'template-parts/content' ); ?>
                        </div>

                    <?php endwhile; ?>
                </div><!-- .row -->

            </div><!-- .container -->

            <?php else: ?>

                <?php get_template_part( 'template-parts/content-none' ); ?>

        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>