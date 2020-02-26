/**
 * Customize preview script.
 *
 * This file handles the JavaScript for the live preview frame in the customizer.
 * The final result gets saved into `public/js/customizer.js`.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @see       @link https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Site title.
wp.customize( 'blogname', ( value ) => {
	value.bind( ( to ) => {
		document.querySelector( '.app-header__title-link' ).textContent = to;
	} );
} );

// Site description.
wp.customize( 'blogdescription', ( value ) => {
	value.bind( ( to ) => {
		document.querySelector( '.app-header__description' ).textContent = to;
	} );
} );

// Site title/description toggle.
wp.customize( 'header_text', ( value ) => {
	value.bind( ( to ) => {
		const headerItems = document.querySelectorAll( '.app-header__title-link, .app-header__description' );

		headerItems.forEach( ( text ) => {
			if ( false === to ) {
				text.style.clip = 'rect(0 0 0 0)';
				text.style.position = 'absolute';
			} else {
				text.style.clip = null;
				text.style.position = null;
			}
		} );
	} );
} );

