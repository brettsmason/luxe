<?php
$timber_context = $GLOBALS['timberContext'];
$templates     = [ 'page-plugin.twig' ];

if ( ! isset( $timber_context ) ) {
	throw new \Exception( 'Timber context not set in footer.' );
}

$timber_context['content'] = ob_get_contents();
ob_end_clean();

Timber::render( $templates, $timber_context );
