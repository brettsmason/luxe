<?php
if ( ! is_active_sidebar( $location ) ) {
	return;
}
?>

<aside class="sidebar sidebar--<?php echo esc_attr( $location ) ?>">
	<?php dynamic_sidebar( $location ) ?>
</aside>
