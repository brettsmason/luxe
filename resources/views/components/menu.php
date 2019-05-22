<?php
if ( ! has_nav_menu( $data->location ) ) :
	return;
endif
?>

<nav <?= Hybrid\Attr\render( 'menu', $data->location ) ?>>
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
