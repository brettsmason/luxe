<article <?php Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<?php Hybrid\Post\render_title( [ 'class' => 'entry__title u-h4' ] ) ?>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
