<?php
if ( ! has_nav_menu( $location ) ) {
	return;
}
?>

<nav id="menu-<?php echo esc_attr( $location ) ?>" class="menu menu--<?php echo esc_attr( $location ) ?>">
	<?php
	wp_nav_menu(
		[
			'theme_location' => $location,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items menu__items--' . esc_attr( $location ),
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard',
		]
	)
	?>
</nav>
