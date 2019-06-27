<?php Hybrid\View\display( 'components', 'archive-header' ) ?>

<?php if ( have_posts() ) : ?>

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <?php Hybrid\View\display( 'content', Hybrid\Template\hierarchy() ) ?>

    <?php endwhile ?>

    <?php Hybrid\View\display( 'components', 'pagination-posts' ) ?>

<?php endif ?>