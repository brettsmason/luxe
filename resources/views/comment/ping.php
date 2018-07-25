<li <?php Hybrid\Attr\render( 'comment' ) ?>>

	<div class="comment__meta">
		<span class="comment__author"><?php comment_author_link() ?></span>
		<?= Luxe\sep() ?>
		<?php /* translators: %s how many days ago. */ ?>
		<a href="<?php comment_link() ?>" class="comment__permalink"><time class="comment__published"><?php printf( __( '%s ago', 'luxe' ), esc_attr( human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ) // phpcs:ignore WordPress.XSS.EscapeOutput ?></time></a>
		<?php edit_comment_link( null, Luxe\sep() ) ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
