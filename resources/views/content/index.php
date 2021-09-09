<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title(); ?>
	</header>

	<div class="entry__summary">
		<?php the_excerpt(); ?>
	</div>
</article>
