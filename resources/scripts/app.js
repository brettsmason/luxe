/**
 * Primary front-end script.
 *
 * Primary JavaScript file. Any includes or anything imported should
 * be filtered through this file and eventually saved back into the
 * `/dist/scripts/app.js` file.
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

import ResponsiveMenu from './responsive-menu';

// Setup a new menu
let menu = new ResponsiveMenu('primary-menu', {});

/**
 * A simple immediately-invoked function expression to kick-start
 * things and encapsulate our code.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
(function () {
})();
