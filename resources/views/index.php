<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ) ?> class="no-js">
	<?= Hybrid\View\render( 'components', 'head' ) ?>

	<body <?= Hybrid\Attr\render( 'body' ) ?>>
		<?php do_action( 'wp_body_open' ) ?>

		<div class="app">
			<?= Hybrid\View\render( 'components', 'header' ) ?>

			<div class="app-content">
				<main id="main" class="app-main">
					<?= Hybrid\View\render( 'layouts', Hybrid\Template\hierarchy() ) ?>
				</main>
			</div>

			<?= Hybrid\View\render( 'components', 'sidebar', [ 'location' => 'subsidiary' ] ) ?>

			<?= Hybrid\View\render( 'components', 'footer' ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
