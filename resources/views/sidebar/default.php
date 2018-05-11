<?php
if ( ! Luxe\display_sidebar() ) return;
if ( ! is_active_sidebar( $data->name ) ) return;
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?>">
	<?php dynamic_sidebar( $data->name ) ?>
</aside>
