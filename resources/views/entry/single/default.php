<article <?php Hybrid\Attr\display( 'entry' ) ?>>
	<header class="entry__header wrapper">
		<?php Hybrid\Post\display_title() ?>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'partials', 'pagination-singular' ) ?>
	</div>
</article>
