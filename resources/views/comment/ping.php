<li <?php Hybrid\attr( 'comment' ) ?>>

	<div class="comment__meta">
		<span class="comment__author"><?php comment_author_link() ?></span>
		<?= Luxe\get_meta_sep() ?>
		<?php /* translators: %s how many days ago. */ ?>
		<a href="<?php comment_link() ?>" class="comment__permalink"><time class="comment__published"><?php printf( __( '%s ago', 'luxe' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ) ?></time></a>
		<?php edit_comment_link( null, Luxe\get_meta_sep() ) ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
