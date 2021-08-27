<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'partials/components/head' ); ?>

	<body <?php body_class(); ?>>
		<?php wp_body_open() ?>

		<div class="app">
			<?php
			do_action( 'get_header' );
			get_template_part( 'partials/components/header' );
			?>

			<div class="app-content">
				<main id="main" class="app-main">
					<?php require Luxe\Wrapper::template(); ?>
				</main>
			</div>

			<?php get_template_part( 'partials/components/footer' ); ?>
		</div>

		<?php wp_footer() ?>
	</body>
</html>
