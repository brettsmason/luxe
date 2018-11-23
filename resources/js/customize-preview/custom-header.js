/**
 * Custom Header script.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
export default function() {

  // Site title.
  wp.customize( 'blogname', ( value ) => {
    value.bind( ( to ) => {
      document.querySelector( '.app-header__title a' ).textContent = to;
    });
  });

  // Site description.
  wp.customize( 'blogdescription', ( value ) => {
    value.bind( ( to ) => {
      document.querySelector( '.app-header__description' ).textContent = to;
    });
  });

  // Header text color.
  wp.customize( 'header_textcolor', ( value ) => {
    value.bind( ( to ) => {
      const headerItems = document.querySelectorAll( '.app-header__title a, .app-header__description' );

      headerItems.forEach( ( text ) => {
        if ( 'blank' === to ) {
          text.style.clip = 'rect(0 0 0 0)';
          text.style.position = 'absolute';
        } else {
          text.style.clip = null;
          text.style.position = null;
          text.style.color = to;
        }
      });
    });
  });
}
