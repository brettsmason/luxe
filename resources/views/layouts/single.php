<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php $engine->display( 'content', Hybrid\Template\Hierarchy\hierarchy() ) ?>

	<?php endwhile ?>

	<?php comments_template( '/components/comments.php' ) ?>

<?php endif ?>
