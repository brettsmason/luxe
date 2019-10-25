<li <?= Hybrid\Attr\render( 'comment' ) ?>>
	<figure class="comment__avatar">
		<?= get_avatar( $comment, $args['avatar_size'], '', '', [ 'class' => 'comment__avatar-img' ] ) ?>
	</figure>

	<div class="comment__body">
		<header class="comment__meta">
			<?= Hybrid\Comment\render_author() ?>
			<?=
			Hybrid\Comment\render_permalink(
				[
					'text' => sprintf(
						// Translators: 1 is the comment date and 2 is the time.
						esc_html__( '%1$s at %2$s', 'luxe' ),
						Hybrid\Comment\render_date( [ 'format' => 'jS F Y' ] ),
						Hybrid\Comment\render_time()
					),
				]
			)
			?>
			<?= Hybrid\Comment\render_edit_link() ?>
		</header>

		<div class="comment__content">

			<?php if ( ! Hybrid\Comment\is_approved() ) : ?>
				<p class="comment__moderation">
					<?= esc_html__( 'Your comment is awaiting moderation.', 'luxe' ) ?>
				</p>
			<?php endif ?>

			<?php comment_text() ?>
		</div>

		<?php if ( comments_open() ) : ?>
			<div class="comment__actions">
				<?= Hybrid\Comment\render_reply_link() ?>
			</div>
		<?php endif ?>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
