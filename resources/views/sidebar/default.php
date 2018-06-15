<?php
if ( ! is_active_sidebar( $data->name ) ) :
	return;
endif;
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?>">
	<?php dynamic_sidebar( $data->name ) ?>
</aside>
