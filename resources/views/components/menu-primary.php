<?php
if ( ! has_nav_menu( 'primary' ) ) {
	return;
}
?>

<nav id="menu-primary" class="menu menu--primary">
	<button id="menu-toggle" class="menu__toggle" aria-expanded="false" aria-controls="menu__items--primary">
		<span class="menu__label screen-reader-text"><?php esc_html_e( 'Menu', 'luxe' ); ?></span>
	</button>

	<?php
	wp_nav_menu(
		[
			'theme_location' => 'primary',
			'container'      => '',
			'menu_id'        => 'menu__items--primary',
			'menu_class'     => 'menu__items menu__items--primary',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard',
		]
	)
	?>
</nav>
