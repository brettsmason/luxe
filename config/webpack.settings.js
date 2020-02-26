module.exports = {

	/**
	 * Collection of application front-end assets to be compiled.
	 */
	entries: {
		app: './resources/js/app.js',
		customizer: './resources/js/customizer.js',
		screen: './resources/scss/screen.scss',
		editor: './resources/scss/editor.scss',
		woocommerce: './resources/scss/woocommerce.scss',
	},

	/**
	 * BrowserSync settings.
	 */
	browserSync: {
		host: 'localhost',
		port: 3000,
		proxy: 'http://theme.test',
		open: false,
		files: [
			'*.php',
			'app/**/*.php',
			'resources/views/**/*.php',
			'public/js/**/*.js',
			'public/css/**/*.css',
			'public/svg/**/*.svg',
			'public/img/**/*.{jpg,jpeg,png,gif}',
			'public/fonts/**/*.{eot,ttf,woff,woff2,svg}',
		],
	},

	/**
	 * List of libraries which will be provided
	 * within application scripts as external.
	 */
	externals: {
		jquery: 'jQuery',
	},

	/**
	 * List of custom modules resolving.
	 */
	resolve: {
		alias: {},
	},

	/**
	 * Project paths.
	 */
	paths: {
		public: './public',
		assets: './resources',
		css: './resources/css',
		javascript: './resources/js',
	},

	/**
	 * List of filename schemas for different
	 * application assets.
	 */
	outputs: {
		css: 'css/[name].css',
		javascript: 'js/[name].js',
		assets: '[path][name].[ext]',
	},

	stats: {
		all: false,
		errors: true,
		maxModules: 0,
		modules: true,
		warnings: true,
		assets: true,
		errorDetails: true,
		excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2)$/i,
		moduleTrace: true,
		performance: true,
	},
};
