<main id="main" class="app-main wrapper grid grid--3">
	<?php Hybrid\View\render( 'partials', 'archive-header' ) ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\View\render( 'entry/archive', Hybrid\Post\hierarchy() ) ?>

		<?php endwhile ?>

		<?php Hybrid\View\render( 'partials', 'pagination-posts' ) ?>

	<?php endif ?>
</main>
