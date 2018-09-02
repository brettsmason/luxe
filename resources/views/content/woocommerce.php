<div class="app-content wrapper">
	<main id="main" class="app-main">
		<?php woocommerce_content() ?>
	</main>

	<?php if ( Luxe\display_sidebar() ) : ?>
		<?php Hybrid\View\display( 'sidebar', 'primary', [ 'name' => 'primary' ] ) ?>
	<?php endif; ?>
</div>
