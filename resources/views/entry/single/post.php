<article <?php Hybrid\Attr\display( 'entry' ) ?>>
	<header class="entry__header wrapper">
		<?php Hybrid\Post\display_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Post\display_date() ?>
			<?php Hybrid\Post\display_author( [ 'before' => Luxe\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Luxe\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'partials', 'pagination-singular' ) ?>
	</div>

	<footer class="entry__footer wrapper">
		<?php
			Hybrid\Post\display_terms(
				[
					'taxonomy' => 'category',
					'before'   => '<div class="entry__terms-wrapper">' . Luxe\fetch_svg( 'folder-open', [ 'title' => 'Categories:' ] ),
					'after'    => '</div>',
				]
			)
			?>

		<?php
			Hybrid\Post\display_terms(
				[
					'taxonomy' => 'post_tag',
					'before'   => '<div class="entry__terms-wrapper">' . Luxe\fetch_svg( 'hashtag', [ 'title' => 'Tags:' ] ),
					'after'    => '</div>',
				]
			)
			?>
	</footer>
</article>
