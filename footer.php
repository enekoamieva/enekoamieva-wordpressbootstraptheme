<?php

/**
 * Footer template
 * 
 * @package bootstraptheme
 */

?>

    <footer>
        <h3>Footer</h3>

        <?php if( is_active_sidebar( 'sidebar-2' ) ): ?>
            <aside>
                <?php dynamic_sidebar( 'sidebar-2' ) ?>
            </aside>
        <?php endif; ?>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>