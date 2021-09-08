<article <?php Hybrid\Attr\display( 'entry' ); ?>>
	<header class="entry__header">
		<?php Hybrid\Theme\Post\display_title(); ?>
	</header>

	<div class="entry__summary">
		<?php the_excerpt(); ?>
	</div>
</article>
