<?php
$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$templates       = [
	"single/single-{$timber_post->ID}.twig",
	"single/single-{$timber_post->post_type}.twig",
	"single/single-{$timber_post->slug}.twig",
	"single/single.twig"
];

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single/single-password.twig', $context );
} else {
	Timber::render( $templates, $context );
}
