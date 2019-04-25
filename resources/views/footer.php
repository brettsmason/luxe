<footer class="app-footer u-text-center">
	<div class="app-footer__wrapper wrapper">
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
