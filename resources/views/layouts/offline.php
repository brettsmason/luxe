<div class="entry entry--error">
	<header class="entry__header">
		<h1 class="entry__title"><?php esc_html__( 'Oops! It looks like you&#8217;re offline.', 'luxe' ); ?></h1>
	</header>

	<div class="entry__content">
		<?php
		if ( function_exists( 'wp_service_worker_error_message_placeholder' ) ) {
			wp_service_worker_error_message_placeholder();
		}
		?>
	</div>
</div>
