<footer class="app-footer u-text-center u-px-1">
	<div class="app-footer__wrapper wrapper">
		<?php Hybrid\View\render( 'menu', 'inline', [ 'name' => 'subsidiary' ] ) ?>

		<p class="app-footer__credit">
			<?php
			printf(
				// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
				esc_html__( 'Copyright &#169; %1$s %2$s', 'luxe' ),
				date_i18n( 'Y' ), Hybrid\Site\fetch_home_link()
			);
			?>

			<?= Luxe\sep() ?>

			<?php
				// translators: %1$s is theme name, and %2$s is link to theme site.
				printf( esc_html__( 'Theme %1$s by %2$s', 'luxe' ), 'Luxe', '<a href="https://github.com/brettsmason/">Brett Mason</a>' );
			?>
		</p>
	</div>
</footer>
