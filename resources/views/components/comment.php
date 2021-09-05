<li <?php Hybrid\Attr\display( 'comment' ) ?>>
	<figure class="comment__avatar">
		<?php echo get_avatar( $comment, $args['avatar_size'], '', '', [ 'class' => 'comment__avatar-img' ] ) ?>
	</figure>

	<div class="comment__body">
		<header class="comment__meta">
			<?php Hybrid\Theme\Comment\display_author() ?>
			<?php
			Hybrid\Theme\Comment\display_permalink(
				[
					'text' => sprintf(
						// Translators: 1 is the comment date and 2 is the time.
						esc_html__( '%1$s at %2$s', 'luxe' ),
						Hybrid\Theme\Comment\render_date( [ 'format' => 'jS F Y' ] ),
						Hybrid\Theme\Comment\render_time()
					),
				]
			)
			?>
			<?php Hybrid\Theme\Comment\display_edit_link() ?>
		</header>

		<div class="comment__content">

			<?php if ( ! Hybrid\Theme\Comment\is_approved() ) : ?>
				<p class="comment__moderation">
					<?php echo esc_html__( 'Your comment is awaiting moderation.', 'luxe' ) ?>
				</p>
			<?php endif ?>

			<?php comment_text() ?>
		</div>

		<?php if ( comments_open() ) : ?>
			<div class="comment__actions">
				<?php Hybrid\Theme\Comment\display_reply_link() ?>
			</div>
		<?php endif ?>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
