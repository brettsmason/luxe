<article <?php Hybrid\Attr\display( 'entry' ); ?>>
	<figure class="entry__image">
		<?php the_post_thumbnail( 'post-thumbnail' ); ?>
	</figure>

	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title(); ?>

		<div class="entry__byline">
			<?php Hybrid\Theme\Post\display_date(); ?>
			<?php Hybrid\Theme\Post\display_author(); ?>
			<?php Hybrid\Theme\Post\display_comments_link(); ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt(); ?>
	</div>
</article>
