<footer class="app-footer">
	<div class="app-footer__wrapper container">
		<p class="app-footer__copyright text-sm">
			<?php
			printf(
				/* Translators: %1$s is the date, %2$s is the site name. */
				esc_html__( 'Copyright &#169; %1$s %2$s', 'luxe' ),
				date_i18n( 'Y' ),
				get_bloginfo( 'name' )
			);
			?>
		</p>
	</div>
</footer>
