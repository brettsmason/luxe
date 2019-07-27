<?php
if ( ! is_active_sidebar( $data->location ) ) {
	return;
}
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->location ) ?>">
	<?php dynamic_sidebar( $data->location ) ?>
</aside>
