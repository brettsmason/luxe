<?php
Hybrid\render_pagination( 'comments', [
	'prev_text'       => __( '&larr; Previous', 'luxe' ),
	'next_text'       => __( 'Next &rarr;', 'luxe' ),
	'title_text'      => __( 'Comments Navigation' ),
	'container_class' => 'pagination pagination--comments',
	'title_class'     => 'pagination__title screen-reader-text'
] );
