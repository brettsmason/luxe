const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const config = require('./config/build');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = merge(common, {
	mode: 'development',
	devtool: 'inline-cheap-module-source-map',
	plugins: [
		new BrowserSyncPlugin(
			{
				host: config.browserSync.host,
				port: config.browserSync.port,
				proxy: config.browserSync.proxy,
				open: config.browserSync.open,
				files: config.browserSync.files
			},
			{
				injectCss: true,
				reload: false
			}
		)
	]
});
