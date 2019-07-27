<?php
if ( ! has_nav_menu( $data->location ) ) {
	return;
}
?>

<nav id="js-menu-<?= esc_attr( $data->location ) ?>" class="menu menu--<?= esc_attr( $data->location ) ?>">
	<?php
	wp_nav_menu(
		[
			'theme_location' => $data->location,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard',
		]
	)
	?>
</nav>
