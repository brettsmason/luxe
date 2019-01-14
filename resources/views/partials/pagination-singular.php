<?php
/**
 * Singular pagination.
 *
 * @package Luxe
 */

?>

<?php
Hybrid\Pagination\display(
	'singular', [
		'show_all'        => true,
		'prev_next'       => false,
		'title_text'      => __( 'Pages:', 'luxe' ),
	]
);
