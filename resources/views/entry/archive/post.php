<article <?php Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<h2 class="entry__title u-h4"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

		<div class="entry__byline">
			<?php Hybrid\Post\render_date() ?>
			<?php Hybrid\Post\render_author( [ 'before' => Luxe\get_meta_sep() ] ) ?>
			<?php Hybrid\Post\render_comments_link( [ 'before' => Luxe\get_meta_sep() ] ) ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
