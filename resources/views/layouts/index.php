<?php $engine->display( 'components', 'archive-header' ) ?>

<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php $engine->display( 'content', Hybrid\Template\Hierarchy\hierarchy() ) ?>

	<?php endwhile ?>

	<?php $engine->display( 'components', 'pagination-posts' ) ?>

	<?php
endif;
