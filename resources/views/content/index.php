<?php
/**
 * Fallback content template.
 *
 * @package Luxe
 */

?>

<div class="app-content wrapper">
	<main id="main" class="app-main">
		<?php Hybrid\View\display( 'partials', 'archive-header' ) ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<?php Hybrid\View\display( 'entry/archive', Hybrid\Post\hierarchy() ) ?>

			<?php endwhile ?>

			<?php Hybrid\View\display( 'partials', 'pagination-posts' ) ?>

		<?php endif ?>
	</main>

	<?php if ( Luxe\display_sidebar() ) : ?>
		<?php Hybrid\View\display( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>
	<?php endif; ?>
</div>
