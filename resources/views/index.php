<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<?php Hybrid\View\render( 'partials', 'head' ) ?>

	<body <?php Hybrid\Attr\render( 'body' ) ?>>
		<div class="app">
			<?php Hybrid\View\render( 'header', Hybrid\Template\hierarchy() ) ?>

			<div class="app-content wrapper u-px-1 u-py-1">
				<?php Hybrid\View\render( 'content', Hybrid\Template\hierarchy() ) ?>

				<?php if ( Luxe\display_sidebar() ) : ?>
					<?php Hybrid\View\render( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>
				<?php endif; ?>
			</div>

			<?php Hybrid\View\render( 'sidebar', 'subsidiary', [ 'name' => 'subsidiary' ] ) ?>

			<?php Hybrid\View\render( 'footer', Hybrid\Template\hierarchy() ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
