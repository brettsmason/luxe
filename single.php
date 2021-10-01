<?php
$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$templates       = [ "single-{$timber_post->ID}.twig", "single-{$timber_post->post_type}.twig", "single-{$timber_post->slug}.twig", 'single.twig' ];

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( $templates, $context );
}
