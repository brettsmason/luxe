<header class="app-header w-full">
	<a class="skip-link screen-reader-text" href="#main"><?php echo esc_html__( 'Skip to content', 'luxe' ) ?></a>

	<div class="app-header__wrapper container flex items-center">
		<div class="app-header__branding">
			<?php the_custom_logo() ?>
			<?php Hybrid\Site\display_title( [ 'class' => 'text-lg font-bold' ] ) ?>
			<?php Hybrid\Site\display_description() ?>
		</div>

		<?php $engine->display( 'components', 'menu-primary' ) ?>
	</div>
</header>
