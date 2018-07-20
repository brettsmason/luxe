<article <?php Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<?php Hybrid\Post\render_title( [ 'class' => 'entry__title u-h4' ] ) ?>

		<div class="entry__byline">
			<?php Hybrid\Post\render_date() ?>
			<?php Hybrid\Post\render_author( [ 'before' => Luxe\sep() ] ) ?>
			<?php Hybrid\Post\render_comments_link( [ 'before' => Luxe\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
