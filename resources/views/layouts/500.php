<div class="entry entry--error">
	<header class="entry__header">
		<h1 class="entry__title"><?php echo esc_html__( 'Oops! Something went wrong.', 'luxe' ); ?></h1>
	</header>

	<div class="entry__content">
		<?php
		if ( function_exists( 'wp_service_worker_error_message_placeholder' ) ) {
			wp_service_worker_error_message_placeholder();
		}
		if ( function_exists( 'wp_service_worker_error_details_template' ) ) {
			wp_service_worker_error_details_template();
		}
		?>
	</div>
</div>
