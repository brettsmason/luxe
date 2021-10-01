<?php
$context          = Timber::context();
$context['posts'] = Timber::get_posts();
$templates        = [ 'index.twig' ];

if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}

Timber::render( $templates, $context );
