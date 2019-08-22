<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?= $engine->render( 'content', Hybrid\Template\hierarchy() ) ?>

	<?php endwhile ?>

	<?php comments_template( '/components/comments.php' ) ?>

<?php endif ?>
