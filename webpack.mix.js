const { mix } = require('laravel-mix');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

// Set path to our generated assets.
mix.setPublicPath('public');

// Compile assets.
mix.js('resources/scripts/app.js', 'public/scripts').sourceMaps();
mix.sass('resources/styles/screen.scss', 'public/styles').sourceMaps();

// Generate a manifest file for cache busting.
// Append a unique hash for production only assets.
if(mix.inProduction()) {
	mix.version();
}

// Add our own Webpack config options.
// Here we are using CopyWebpackPlugin rather than the `.copy` mix method
// as we want to minimize images too, and mix doesn't currently have a
// built in method to handle this.
mix.webpackConfig({
  stats: 'minimal',
  performance: {
    hints: false
  },
  plugins: [
    // Copy our static assets to the public directory.
    new CopyWebpackPlugin([
      {
        from: 'resources/img',
        to: 'img',
      },
      {
        from: 'resources/svg',
        to: 'svg',
      },
      {
        from: 'resources/fonts',
        to: 'fonts',
      }
    ]),
    // Minify and clean up our image assets.
    new ImageminPlugin({
      test: /\.(jpe?g|png|gif|svg)$/i,
      disable: process.env.NODE_ENV !== 'production',
      optipng: {
        optimizationLevel: 3
      },
      gifsicle: {
        optimizationLevel: 3
      },
      pngquant: {
        quality: '65-90',
        speed: 4
      },
      svgo: {
        plugins: [
          { removeUnknownsAndDefaults: false },
          { cleanupIDs: false },
          { removeViewBox: false }
        ]
      },
      plugins: [imageminMozjpeg({ quality: 75 })]
    })
  ]
});

// monitor files for changes and inject your changes into the browser.
mix.browserSync({
  proxy: 'theme-development.localhost',
  files: [
    "public/**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}",
    "resources/views/**/*.php",
    "app/**/*.php"
  ]
});

// Disable processing asset URLs in Sass files.
mix.options({ processCssUrls: false });
