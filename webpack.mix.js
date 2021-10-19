const mix = require('laravel-mix');

// Plugins.
require('laravel-mix-clean');
require('laravel-mix-copy-watched');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */

mix
  .setPublicPath('./public')
  .browserSync(
    {
      host: 'localhost',
      port: 3000,
      proxy: 'https://themedev.test',
			https: true,
      open: false,
			files: [
				'*.php',
				'app/**/*.php',
				'resources/views/**/*.twig',
				'public/js/**/*.js',
				'public/css/**/*.css',
				'public/svg/**/*.svg',
				'public/img/**/*.{jpg,jpeg,png,gif}',
				'public/fonts/**/*.{eot,ttf,woff,woff2,svg}',
			]
    },
    {
      injectChanges: true,
      reload: false,
    }
  );

mix
  .postCss('resources/css/screen.css', 'css')
  .postCss('resources/css/editor.css', 'css')
  .options({
    processCssUrls: false,
  });

mix
  .js('resources/js/app.js', 'js')
  .autoload({
      jquery: [
        '$',
        'window.jQuery'
      ]
  });

mix
  .copyDirectoryWatched('resources/img', 'public/img')
  .copyDirectoryWatched('resources/svg', 'public/svg')
  .copyDirectoryWatched('resources/fonts', 'public/fonts');

mix
  .sourceMaps()
  .version()
  .clean();
