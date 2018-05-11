<?php
if ( ! is_active_sidebar( $data->name ) ) return;
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?> wrapper">
	<?php dynamic_sidebar( $data->name ) ?>
</aside>
