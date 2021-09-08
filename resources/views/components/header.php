<header class="app-header">
	<a class="skip-link screen-reader-text" href="#main"><?php echo esc_html__( 'Skip to content', 'luxe' ); ?></a>

	<div class="app-header__wrapper">
		<div class="app-header__branding">
			<?php the_custom_logo(); ?>
			<?php Hybrid\Theme\Site\display_title(); ?>
			<?php Hybrid\Theme\Site\display_description(); ?>
		</div>

		<?php $engine->display( 'components', 'menu-primary' ); ?>
	</div>
</header>
