<?php
if ( ! has_nav_menu( $data->name ) ) :
	return;
endif
?>

<nav id="<?= esc_attr( $data->name ) ?>-menu" class="menu menu--<?= esc_attr( $data->name ) ?>">
	<button id="menu-toggle" class="menu__toggle" aria-expanded="false" aria-controls="menu__items--<?= esc_attr( $data->name ) ?>">
		<?php Luxe\svg( 'bars', [ 'class' => 'menu__toggle-icon' ] ) ?>
		<span class="menu__label screen-reader-text"><?= esc_html( 'Menu', 'luxe' ) ?></span>
	</button>

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
