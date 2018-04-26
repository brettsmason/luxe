<main id="main" class="app-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\render_view( 'entry/single', Hybrid\get_post_hierarchy() ) ?>

		<?php endwhile ?>

		<?php comments_template( '/resources/views/partials/comments.php' ) ?>

	<?php endif ?>
</main>
