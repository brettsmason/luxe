<main id="main" class="app-main">
	<?php Hybrid\View\display( 'partials', 'archive-header' ) ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\View\display( 'entry/archive', Hybrid\Post\hierarchy() ) ?>

		<?php endwhile ?>

		<?php Hybrid\View\display( 'partials', 'pagination-posts' ) ?>

	<?php endif ?>
</main>
