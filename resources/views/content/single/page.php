<article <?= Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<?= Hybrid\Post\render_title() ?>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?= Hybrid\View\render( 'comments', 'pagination-singular' ) ?>
	</div>
</article>
