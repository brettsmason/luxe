/**
 * Laravel Mix configuration file.
 *
 * This file stores all the configuration for using Laravel Mix as our primary
 * build tool for the theme. Laravel Mix is a layer built on top of Webpack that
 * simplifies much of the complexity of Webpack's configuration, and is well
 * suited for projects like WordPress themes.
 *
 * @link https://laravel.com/docs/5.6/mix
 *
 * @package   Luxe
 * @author    Brett Mason <brettsmason@gmail.com>
 * @copyright Copyright (c) 2018, Brett Mason
 * @link      https://github.com/brettsmason/luxe/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

const { mix } = require('laravel-mix');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

// Build config settings file.
const config = require('./config/build.json');

// Sets the path to the generated assets. By default, this is the `/public` folder
// in the theme. If doing something custom, make sure to change this everywhere.
mix.setPublicPath(config.publicPath);

// Compile JavaScript.
// Loop over each file listed in the config.
//
// @link https://laravel.com/docs/5.6/mix#working-with-scripts
config.files.scripts.forEach(file => {
	mix.js(`${config.source.scripts}/${file}`, config.dist.scripts);
});

// Compile SASS/CSS.
// Loop over each file listed in the config.
//
// @link https://laravel.com/docs/5.6/mix#sass
// @link https://laravel.com/docs/5.6/mix#postcss
// @link https://laravel.com/docs/5.6/mix#url-processing
config.files.styles.forEach(file => {
	mix.standaloneSass(`${config.source.styles}/${file}`, config.dist.styles, config.sassSettings);
});

mix.options({
	postCss: [
		require('postcss-preset-env')(),
		require('postcss-pxtorem')({
			rootValue: 18,
			unitPrecision: 5,
			propList: ['*'],
			replace: true,
			mediaQuery: false,
			minPixelValue: 0
		})
	],
	processCssUrls: false
});

// Builds sources maps for assets.
//
// @link https://laravel.com/docs/5.6/mix#css-source-maps
mix.sourceMaps();

// Versioning and cache busting. Append a unique hash for production assets.
//
// @link https://laravel.com/docs/5.6/mix#versioning-and-cache-busting
if (mix.inProduction()) {
  mix.version();
}

// Add custom Webpack configuration.
//
// Laravel Mix doesn't currently have a built-in method for minimizing images,
// so we're going to use the `CopyWebpackPlugin` instead of `.copy()` for
// processing and copying our images over to their distribution folder.
//
// @link https://laravel.com/docs/5.6/mix#custom-webpack-configuration
mix.webpackConfig({
  // Set sourcemaps on development only.
  devtool: mix.inProduction() ? false : 'source-map',
  // Prevent certain dependencies being included in bundles.
  // @link https://webpack.js.org/configuration/externals/#externals
  externals: config.externals,
  plugins: [
    // @link https://github.com/webpack-contrib/copy-webpack-plugin
    new CopyWebpackPlugin([
      {
        from: config.source.images,
        to: config.dist.images,
      },
      {
        from: config.source.svg,
        to: config.dist.svg,
      },
      {
        from: config.source.fonts,
        to: config.dist.fonts,
      },
	]),

    // @link https://github.com/Klathmon/imagemin-webpack-plugin
    new ImageminPlugin({
      test: /\.(jpe?g|png|gif|svg)$/i,
      disable: process.env.NODE_ENV !== 'production',
      optipng: {
        optimizationLevel: 3,
      },
      gifsicle: {
        optimizationLevel: 3,
      },
      pngquant: {
        quality: '65-90',
        speed: 4,
      },
      svgo: {
        plugins: [
          { removeUnknownsAndDefaults: false },
          { cleanupIDs: false },
          { removeViewBox: false },
        ],
      },
      // @link https://github.com/imagemin/imagemin-mozjpeg
      plugins: [imageminMozjpeg({ quality: 75 })],
    }),
  ],
});

// monitor files for changes and inject your changes into the browser.
mix.browserSync({
  proxy: config.browserSyncUrl,
  files: config.watchFiles,
});
