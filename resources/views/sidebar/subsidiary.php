<?php
if ( ! is_active_sidebar( $data->name ) ) :
	return;
endif;
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?> wrapper grid grid--auto">
	<?php dynamic_sidebar( $data->name ) ?>
</aside>
