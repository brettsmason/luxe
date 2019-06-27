<article <?= Hybrid\Attr\render( 'entry' ) ?>>
	<figure class="entry__image">
		<?php the_post_thumbnail( 'post-thumbnail' ) ?>
	</figure>

	<header class="entry__header">
		<?= Hybrid\Post\render_title() ?>

		<div class="entry__byline">
			<?= Hybrid\Post\render_date() ?>
			<?= Hybrid\Post\render_author() ?>
			<?= Hybrid\Post\render_comments_link() ?>
		</div>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>