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
        <div class="container">
        
            <div class="row">
                <!-- Content -->
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <?php if ( have_posts() ) : ?>



                        <?php if( is_home() && ! is_front_page() ): ?>
                            <header class="mb-5">
                                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                            </header>
                        <?php endif; ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'template-parts/content' ); ?>

                        <?php endwhile; ?>


                    <?php else: ?>

                        <?php get_template_part( 'template-parts/content-none' ); ?>

                    <?php endif; ?>

                    <!-- Pagination -->
                    <div class="prev-link"><?php previous_post_link(); ?></div>
                    <div class="next-link"><?php next_post_link(); ?></div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php get_sidebar(); ?>
                </div>
            </div>
            
        </div>
    </main>
</div>

<?php get_footer(); ?>