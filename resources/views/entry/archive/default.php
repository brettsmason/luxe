<article <?php Hybrid\attr( 'entry' ) ?>>
	<header class="entry__header">
		<h2 class="entry__title u-h4"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
