<?php

namespace Luxe\Timber;

use Hybrid\Contracts\Bootable;

class Site extends \Timber\Site implements Bootable {

	var $_branding;

	public function boot() {
		add_filter( 'timber/context', [ $this, 'addToContext' ] );
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function addToContext( $context ) {
		$context['site'] = $this;

		return $context;
	}

	/**
	 * Site branding
	 *
	 * @param array $args
	 * @return void
	 */
	public function branding( array $args = [] ) {

		if ( ! $this->_branding ) {

			$args = wp_parse_args(
				$args,
				[
					'tag'        => is_front_page() ? 'h1' : 'div',
					'class'      => 'app-header__title',
					'link_class' => 'app-header__title-link',
				]
			);

			$link = sprintf(
				'<a class="home-link" href="%s" rel="home">%s</a>',
				$this->link(),
				$this->name
			);

			$html = sprintf(
				'<%1$s class="%2$s">%3$s</%1$s>',
				tag_escape( $args['tag'] ),
				esc_attr( $args['class'] ),
				$link,
			);

			$this->_branding = $html;

		}

		return $this->_branding;
	}
}
