<article <?= Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<?= Hybrid\Post\render_title() ?>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
