<article <?= Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<?= Hybrid\Post\render_title() ?>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?= $engine->render( 'components', 'pagination-singular' ) ?>
	</div>
</article>
