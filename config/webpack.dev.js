const merge = require( 'webpack-merge' );
const common = require( './webpack.common.js' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );

// Build settings.
const settings = require( './webpack.settings.js' );

module.exports = merge( common, {
	mode: 'development',
	devtool: 'inline-cheap-module-source-map',
	plugins: [
		new BrowserSyncPlugin(
			{
				host: settings.browserSync.host,
				port: settings.browserSync.port,
				proxy: settings.browserSync.proxy,
				open: settings.browserSync.open,
				files: settings.browserSync.files,
			},
			{
				injectCss: true,
				reload: false,
			},
		),
	],
} );
