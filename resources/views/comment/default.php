<li <?php Hybrid\Attr\render( 'comment' ) ?>>
	<figure class="comment__avatar">
		<?= get_avatar( $data->comment, $data->args['avatar_size'], '', '', [ 'class' => 'comment__avatar-img' ] ) ?>
	</figure>

	<div class="comment__body">
		<header class="comment__meta">
			<?php Hybrid\Comment\render_author( [ 'after' => Luxe\sep() ] ) ?>
			<?php /* translators: %s how many days ago. */ ?>
			<?php Hybrid\Comment\render_permalink( [
				'text' => sprintf(
					// Translators: 1 is the comment date and 2 is the time.
					esc_html__( '%1$s at %2$s', 'luxe' ),
					Hybrid\Comment\fetch_date(),
					Hybrid\Comment\fetch_time()
				)
			] ) ?>
			<?php Hybrid\Comment\render_edit_link( [ 'before' => Luxe\sep() ] ) ?>
		</header>

		<div class="comment__content">

			<?php if ( ! Hybrid\Comment\is_approved() ) : ?>
				<p class="comment__moderation">
					<?php esc_html_e( 'Your comment is awaiting moderation.', 'luxe' ) ?>
				</p>
			<?php endif ?>

			<?php comment_text() ?>
		</div>

		<div class="comment__actions">
			<?php Hybrid\Comment\render_reply_link( [ 'before' => Luxe\fetch_svg( 'reply', [ 'class' => 'comment__reply-icon' ] ) ] ) ?>
		</div>

<?php /* No closing </div> and </li> is needed.  WordPress will know where to add it. */ ?>
