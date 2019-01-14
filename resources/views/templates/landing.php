<?php
/**
 * Landing page template.
 * Used to create pages that have no header/footer.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<?php Hybrid\View\display( 'partials', 'head' ) ?>

	<body <?php Hybrid\Attr\display( 'body' ) ?>>
		<div class="app">
			<?php Hybrid\View\display( 'content', Hybrid\Template\hierarchy() ) ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
