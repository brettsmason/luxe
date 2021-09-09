<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title(); ?>

		<div class="entry__byline">
			<?php Hybrid\Theme\Post\display_date(); ?>
			<?php Hybrid\Theme\Post\display_author(); ?>
			<?php Hybrid\Theme\Post\display_comments_link(); ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content(); ?>
		<?php $engine->display( 'components', 'pagination-singular' ); ?>
	</div>

	<footer class="entry__footer">
		<?php Hybrid\Theme\Post\display_terms( [ 'taxonomy' => 'category' ] ); ?>
		<?php Hybrid\Theme\Post\display_terms( [ 'taxonomy' => 'post_tag' ] ); ?>
	</footer>
</article>
