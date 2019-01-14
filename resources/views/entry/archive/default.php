<?php
/**
 * Archive template.
 *
 * @package Luxe
 */

?>

<article <?php Hybrid\Attr\display( 'entry' ) ?>>
	<header class="entry__header">
		<?php Hybrid\Post\display_title( [ 'class' => 'entry__title u-h4' ] ) ?>
	</header>

	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>
</article>
