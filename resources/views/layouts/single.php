<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php Hybrid\View\display( 'content', Hybrid\Template\hierarchy() ) ?>

	<?php endwhile ?>

	<?php comments_template( '/components/comments.php' ) ?>

<?php endif ?>