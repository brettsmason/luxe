<?php
$templates        = [ 'search.twig', 'archive.twig', 'index.twig' ];
$context          = Timber::context();
$context['title'] = 'Search results for ' . get_search_query();
$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );
