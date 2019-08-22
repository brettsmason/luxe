<?php $engine = Hybrid\App::resolve( 'view/engine' ) ?>

<!doctype html>
<html <?= Hybrid\Attr\render( 'html' ) ?> class="no-js">
	<?= $engine->render( 'components', 'head' ) ?>

	<body <?= Hybrid\Attr\render( 'body' ) ?>>
		<?php wp_body_open() ?>

		<div class="app">
			<?= $engine->render( 'components', 'header' ) ?>

			<div class="app-content">
				<main id="main" class="app-main">
					<?= $engine->render( 'layouts', Hybrid\Template\hierarchy() ) ?>
				</main>
			</div>

			<?= $engine->render( 'components', 'sidebar', [ 'location' => 'subsidiary' ] ) ?>

			<?= $engine->render( 'components', 'footer' ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
