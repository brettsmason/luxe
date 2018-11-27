const path = require('path');

module.exports = {

	/**
	 * Project paths.
	 */
	paths: {
		public: './public',
		assets: './resources',
		sass: './resources/scss',
		javascript: './resources/js',
	},

	/**
	 * Collection of application front-end assets to be compiled.
	 */
	entries: {
		'app': './resources/js/app.js',
		'customize-preview': './resources/js/customize-preview.js',
		'screen': './resources/scss/screen.scss',
		'editor': './resources/scss/editor.scss',
		'woocommerce': './resources/scss/woocommerce.scss'
	},

	/**
	 * List of filename schemas for different
	 * application assets.
	 */
	outputs: {
		css: 'css/[name].css',
		javascript: 'js/[name].js',
		assets: '[path][name].[ext]'
	},

	/**
	 * List of libraries which will be provided
	 * within application scripts as external.
	 */
	externals: {
		jquery: 'jQuery'
	},

	/**
	 * List of custom modules resolving.
	 */
	resolve: {
		alias: {}
	},

	/**
	 * BrowserSync settings.
	 */
	browserSync: {
		host: 'localhost',
		port: 3000,
		proxy: 'http://theme-development.localhost/',
		open: false,
		files: [
			'*.php',
			'app/**/*.php',
			'resources/views/**/*.php',
			'public/js/**/*.js',
			'public/css/**/*.css',
			'public/svg/**/*.svg',
			'public/img/**/*.{jpg,jpeg,png,gif}',
			'public/fonts/**/*.{eot,ttf,woff,woff2,svg}'
		]
	}
};
