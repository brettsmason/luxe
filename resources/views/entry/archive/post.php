<article <?php Hybrid\attr( 'entry' ) ?>>
	<header class="entry__header">
		<h2 class="entry__title u-h4"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

		<div class="entry__byline">
			<?php Hybrid\post_date() ?>
			<?php Hybrid\post_author( [ 'before' => Luxe\get_meta_sep() ] ) ?>
			<?php Hybrid\post_comments( [ 'before' => Luxe\get_meta_sep() ] ) ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
