<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<?php Hybrid\View\display( 'partials', 'head' ) ?>

	<body <?php Hybrid\Attr\display( 'body' ) ?>>
		<div class="app">
			<?php Hybrid\View\display( 'header', Hybrid\Template\hierarchy() ) ?>

			<?php Hybrid\View\display( 'content', Hybrid\Template\hierarchy() ) ?>

			<?php Hybrid\View\display( 'sidebar', 'subsidiary', [ 'name' => 'subsidiary' ] ) ?>

			<?php Hybrid\View\display( 'footer', Hybrid\Template\hierarchy() ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
