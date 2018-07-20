<?php
if ( ! is_active_sidebar( $data->name ) ) :
	return;
endif;
?>

<aside class="sidebar sidebar--<?= esc_attr( $data->name ) ?> u-px-1 u-py-1">
	<div class="wrapper grid grid--auto">
		<?php dynamic_sidebar( $data->name ) ?>
	</div>
</aside>
