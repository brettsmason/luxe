<article <?php Hybrid\Attr\render( 'entry' ) ?>>
	<header class="entry__header wrapper">
		<h1 class="entry__title"><?php single_post_title() ?></h1>

		<div class="entry__byline">
			<?php Hybrid\Post\render_date() ?>
			<?php Hybrid\Post\render_author( [ 'before' => Luxe\sep() ] ) ?>
			<?php Hybrid\Post\render_comments_link( [ 'before' => Luxe\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\render( 'partials', 'pagination-singular' ) ?>
	</div>

	<footer class="entry__footer wrapper">
		<?php
			Hybrid\Post\render_terms( [
				'taxonomy' => 'category',
				'before'   => '<div class="entry__terms-wrapper">' . Luxe\fetch_svg( 'folder-open', [ 'title' => 'Categories:' ] ),
				'after'    => '</div>',
			] )
		?>

		<?php
			Hybrid\Post\render_terms( [
				'taxonomy' => 'post_tag',
				'before'   => '<div class="entry__terms-wrapper">' . Luxe\fetch_svg( 'hashtag', [ 'title' => 'Tags:' ] ),
				'after'    => '</div>',
			] )
		?>
	</footer>
</article>
