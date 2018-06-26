<?php
Hybrid\render_pagination( 'posts', [
	'prev_text'       => __( '&larr; Previous' ),
	'next_text'       => __( 'Next &rarr;' ),
	'title_text'      => __( 'Posts Navigation' ),
	'container_class' => 'pagination pagination--posts',
	'title_class'     => 'pagination__title screen-reader-text'
] );
