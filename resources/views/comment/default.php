<li <?php Hybrid\attr( 'comment' ) ?>>

	<header class="comment__meta">
		<?= get_avatar( $data->comment, $data->args['avatar_size'], '', '', [ 'class' => 'comment__avatar' ] ) ?>

		<span class="comment__author"><?php comment_author_link() ?></span>
		<br />
		<a href="<?php comment_link() ?>" class="comment__permalink"><time class="comment__published"><?php printf( __( '%s ago', 'luxe' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ?></time></a>
		<?php edit_comment_link( null, Luxe\get_meta_sep() ) ?>
		<?php Hybrid\comment_reply_link( [ 'before' => Luxe\get_meta_sep() ] ) ?>
	</header>

	<div class="comment__content">
		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
