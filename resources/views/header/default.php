<header class="app-header u-p-1">
	<div class="app-header__wrapper wrapper wrapper--wide">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'luxe' ) ?></a>

		<div class="app-header__branding">
			<?php the_custom_logo() ?>
			<?php Hybrid\Site\render_title( [ 'class' => 'app__header-title u-h4' ] ) ?>
			<?php Hybrid\Site\render_description() ?>
		</div>

		<?php Hybrid\View\render( 'menu', 'primary', [ 'name' => 'primary' ] ) ?>
	</div>
</header>
