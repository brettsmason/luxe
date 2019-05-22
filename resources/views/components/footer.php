<footer class="app-footer">
	<div class="app-footer__wrapper">
		<p class="app-footer__credit">
			<?php
			printf(
				esc_html__( 'Copyright &#169; %1$s %2$s', 'luxe' ),
				date_i18n( 'Y' ),
				get_bloginfo( 'name' )
			);
			?>
		</p>
	</div>
</footer>
