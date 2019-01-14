<?php
/**
 * Archive header template.
 *
 * @package Luxe
 */

?>

<?php if ( ! is_front_page() ) : ?>

	<div class="archive-header">
		<?php
			the_archive_title( '<h1 class="archive-header__title">', '</h1>' );
			the_archive_description( '<div class="archive-header__description wrapper wrapper--narrow">', '</div>' );
		?>
	</div>

<?php endif ?>
