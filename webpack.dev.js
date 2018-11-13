const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = merge(common, {
	mode: 'development',
	devtool: 'inline-cheap-module-source-map',
	plugins: [
		// Run BrowserSync.
		new BrowserSyncPlugin(
			{
				host: 'localhost',
				port: 3000,
				proxy: 'theme-development.localhost',
				open: false,
				files: [
					'*.php',
					'app/**/*.php',
					'resources/views/**/*.php',
					'resources/js/**/*.js',
					'resources/scss/**/*.{sass,scss}',
					'resources/img/**/*.{jpg,jpeg,png,gif}',
					'resources/svg/**/*.svg',
					'resources/fonts/**/*.{eot,ttf,woff,woff2,svg}'
				]
			},
			{
				injectCss: true
			}
		)
	]
});
