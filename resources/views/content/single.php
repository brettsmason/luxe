<main id="main" class="app-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\View\display( 'entry/single', Hybrid\Post\hierarchy() ) ?>

		<?php endwhile ?>

		<?php comments_template() ?>

	<?php endif ?>
</main>
