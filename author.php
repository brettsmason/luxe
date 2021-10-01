<?php
global $wp_query;

$context          = Timber::context();
$context['posts'] = Timber::get_posts();

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author            = new Timber\User( $wp_query->query_vars['author'] );
	$context['author'] = $author;
	$context['title']  = 'Author Archives: ' . $author->name();
}

Timber::render( [ 'author.twig', 'archive.twig' ], $context );
