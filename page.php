<?php
$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$templates       = [ "page-{$timber_post->post_name}.twig", 'page.twig' ];

Timber::render( $templates, $context );
