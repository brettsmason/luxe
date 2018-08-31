<header class="app-header">
	<div class="app-header__wrapper wrapper wrapper--wide">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'luxe' ) ?></a>

		<div class="app-header__branding">
			<?php the_custom_logo() ?>
			<?php Hybrid\Site\display_title( [ 'class' => 'app-header__title u-h4' ] ) ?>
			<?php Hybrid\Site\display_description() ?>
		</div>

		<?php Hybrid\View\display( 'menu', 'primary', [ 'name' => 'primary' ] ) ?>
	</div>
</header>
