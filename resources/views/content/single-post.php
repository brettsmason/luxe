<article <?= Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header">
		<?= Hybrid\Post\render_title() ?>

		<div class="entry__byline">
			<?= Hybrid\Post\render_date() ?>
			<?= Hybrid\Post\render_author() ?>
			<?= Hybrid\Post\render_comments_link() ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?= $engine->render( 'components', 'pagination-singular' ) ?>
	</div>

	<footer class="entry__footer">
		<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'category' ] ) ?>
		<?= Hybrid\Post\render_terms( [ 'taxonomy' => 'post_tag' ] ) ?>
	</footer>
</article>
