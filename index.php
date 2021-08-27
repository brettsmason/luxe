<?php get_template_part( 'partials/archive-header' ); ?>

<?php if ( have_posts() ) : ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php get_template_part( 'partials/content', Hybrid\Template\hierarchy() ); ?>

	<?php endwhile; ?>

	<?php get_template_part( 'partials/components/pagination-posts' ); ?>

<?php endif; ?>
