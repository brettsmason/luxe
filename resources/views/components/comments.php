<?php
if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) ) {
	return;
}
?>

<section class="comments-template">

	<div id="comments" class="comments">

		<?php if ( have_comments() ) : ?>

			<h2 class="comments__title"><?php comments_number() ?></h2>

			<?= Hybrid\View\render( 'components', 'pagination-comments' ) ?>

			<ol class="comments__list">

				<?php
				wp_list_comments(
					[
						'style'        => 'ol',
						'callback'     => function( $comment, $args, $depth ) {
							Hybrid\View\display( 'components', Hybrid\Comment\hierarchy(), compact( 'comment', 'args', 'depth' ) );
						}
					]
				)
				?>

			</ol>

		<?php endif ?>

		<?php if ( ! comments_open() && have_comments() ) : ?>

			<p class="comments__closed">
				<?= esc_html__( 'Comments are closed.', 'luxe' ) ?>
			</p>

		<?php endif ?>

	</div>

	<?php comment_form() ?>

</section>
