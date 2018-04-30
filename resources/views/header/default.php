<header class="app-header">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'luxe' ) ?></a>

	<div class="app-header__branding">
		<?php Hybrid\site_title( '', [ 'class' => 'app-header__title' ] ) ?>
		<?php Hybrid\site_description( '', [ 'class' => 'app-header__description' ] ) ?>
	</div>

	<?php Hybrid\render_view( 'menu', 'primary', [ 'name' => 'primary' ] ) ?>
</header>
