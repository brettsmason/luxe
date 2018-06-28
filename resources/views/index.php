<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<?php Hybrid\render_view( 'partials', 'head' ) ?>

	<body <?php Hybrid\attr( 'body' ) ?>>
		<div class="app">
			<?php Hybrid\render_view( 'header', Hybrid\get_global_hierarchy() ) ?>

			<div class="app-content">
				<?php Hybrid\render_view( 'content', Hybrid\get_global_hierarchy() ) ?>

				<?php if ( Luxe\display_sidebar() ) : ?>
					<?php Hybrid\render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>
				<?php endif; ?>
			</div>

			<?php Hybrid\render_view( 'sidebar', 'subsidiary', [ 'name' => 'subsidiary' ] ) ?>

			<?php Hybrid\render_view( 'footer', Hybrid\get_global_hierarchy() ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
