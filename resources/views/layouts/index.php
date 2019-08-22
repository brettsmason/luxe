<?= $engine->render( 'components', 'archive-header' ) ?>

<?php if ( have_posts() ) : ?>

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <?= $engine->render( 'content', Hybrid\Template\hierarchy() ) ?>

    <?php endwhile ?>

    <?= $engine->render( 'components', 'pagination-posts' ) ?>

<?php endif ?>
