<article <?php Hybrid\Attr\display( 'entry' ) ?>>
	<figure class="entry__image">
		<?php the_post_thumbnail( 'post-thumbnail' ) ?>
	</figure>

	<header class="entry__header">
		<?php Hybrid\Post\display_title( [ 'class' => 'entry__title u-h4' ] ) ?>

		<div class="entry__byline">
			<?php Hybrid\Post\display_date() ?>
			<?php Hybrid\Post\display_author( [ 'before' => Luxe\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Luxe\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
