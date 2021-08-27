<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php get_template_part( 'partials/content', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile; ?>

	<?php comments_template( 'partials/components/comments.php' ); ?>

<?php endif; ?>
