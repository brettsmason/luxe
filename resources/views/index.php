<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ) ?> class="no-js">
	<?= Hybrid\View\render( 'partials', 'head' ) ?>

	<body <?= Hybrid\Attr\render( 'body' ) ?>>
		<?php do_action( 'wp_body_open' ) ?>

		<div class="app">
			<?= Hybrid\View\render( 'header' ) ?>

			<div class="app-content">
				<main id="main" class="app-main">
					<?= Hybrid\View\render( 'content', Hybrid\Template\hierarchy() ) ?>
				</main>

				<?php if ( Luxe\display_sidebar() ) : ?>
					<?= Hybrid\View\render( 'partials', 'sidebar' ) ?>
				<?php endif; ?>
			</div>

			<?= Hybrid\View\render( 'footer' ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
