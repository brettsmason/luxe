<header class="app-header">
	<a class="skip-link screen-reader-text" href="#main"><?= esc_html__( 'Skip to content', 'luxe' ) ?></a>

	<div class="app-header__wrapper">
		<div class="app-header__branding">
			<?= get_custom_logo() ?>
			<?= Hybrid\Site\render_title() ?>
			<?= Hybrid\Site\render_description() ?>
		</div>

		<?= $engine->render( 'components', 'menu', [ 'location' => 'primary' ] ) ?>
	</div>
</header>
