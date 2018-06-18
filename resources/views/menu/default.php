<?php
if ( ! has_nav_menu( $data->name ) ) :
	return;
endif
?>

<nav id="<?= esc_attr( $data->name ) ?>-menu" class="menu menu--<?= esc_attr( $data->name ) ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => $data->name,
		'container'      => '',
		'menu_id'        => 'menu__items--' . esc_attr( $data->name ),
		'menu_class'     => 'menu__items menu__items--' . esc_attr( $data->name ),
		'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		'item_spacing'   => 'discard',
	] )
	?>
</nav>
