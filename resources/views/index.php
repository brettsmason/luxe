<?php $engine = Hybrid\App::resolve( Hybrid\View\Contracts\Engine::class ) ?>

<!doctype html>
<html <?php Hybrid\Attr\display( 'html' ) ?>>
	<?php $engine->display( 'components', 'head' ) ?>

	<body <?php Hybrid\Attr\display( 'body' ) ?>>
		<?php wp_body_open() ?>

		<div class="app">
			<?php $engine->display( 'components', 'header' ) ?>

			<div class="app-content">
				<main id="main" class="app-main">
					<?php $engine->display( 'layouts', Hybrid\Template\Hierarchy\hierarchy() ) ?>
				</main>
			</div>

			<?php $engine->display( 'components', 'sidebar', [ 'location' => 'subsidiary' ] ) ?>

			<?php $engine->display( 'components', 'footer' ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
