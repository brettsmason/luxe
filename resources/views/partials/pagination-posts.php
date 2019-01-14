<?php
/**
 * Posts pagination.
 *
 * @package Luxe
 */

?>

<?php
Hybrid\Pagination\display(
	'posts', [
		'prev_text'  => Luxe\Svg\render( 'chevron-down', [ 'class' => 'pagination__anchor-icon pagination__anchor-icon--prev' ] ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'luxe' ) . '</span>',
		'next_text'  => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'luxe' ) . '</span>' . Luxe\Svg\render( 'chevron-down', [ 'class' => 'pagination__anchor-icon pagination__anchor-icon--next' ] ),
		'title_text' => __( 'Posts Navigation', 'luxe' ),
	]
);
