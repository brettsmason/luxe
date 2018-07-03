<main id="main" class="app-main wrapper grid grid--3">
	<?php Hybrid\render_view( 'partials', 'archive-header' ) ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\render_view( 'entry/archive', Hybrid\get_post_hierarchy() ) ?>

		<?php endwhile ?>

		<?php Hybrid\render_view( 'partials', 'pagination-posts' ) ?>

	<?php endif ?>
</main>
