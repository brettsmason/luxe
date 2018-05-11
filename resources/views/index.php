<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<?php Hybrid\render_view( 'partials', 'head' ) // Load partials/head template. ?>

	<body <?php Hybrid\attr( 'body' ) ?>>
		<div class="app">
			<?php Hybrid\render_view( 'header', Hybrid\get_global_hierarchy() ) // Load header/* template. ?>

			<div class="app-content wrapper">
				<?php Hybrid\render_view( 'content', Hybrid\get_global_hierarchy() ) // Load content/* template. ?>

				<?php if ( Luxe\display_sidebar() ) : ?>
					<?php Hybrid\render_view( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>
				<?php endif; ?>
			</div>

			<?php Hybrid\render_view( 'sidebar', 'subsidiary', [ 'name' => 'subsidiary' ] ) ?>

			<?php Hybrid\render_view( 'footer', Hybrid\get_global_hierarchy() ) // Load footer/* template. ?>
		</div><!-- .app -->

		<?php wp_footer() ?>
	</body>
</html>
