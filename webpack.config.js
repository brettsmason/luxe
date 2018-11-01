// Import configuration.
const config = require('./config/build.json');

// Import modules.
const path = require('path');
const webpack = require('webpack');

// Import plugins.
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const imageminMozjpeg = require('imagemin-mozjpeg');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

/**
 * Export our module for Webpack.
 *
 * @since  1.0.0
 * @access public
 * @return function
 */
module.exports = env => {
	return {
		// Set the mode based on whether we're in production or dev.
		mode: env.production ? 'production' : 'development',

		// Only generate source maps if we're in a dev environment.
		devtool: env.production ? undefined : 'source-maps',

		watch: true,

		entry: {
			app: './resources/js/app.js',
			screen: './resources/scss/screen.scss',
			editor: './resources/scss/editor.scss',
			woocommerce: './resources/scss/woocommerce.scss'
		},

		output: {
			path: path.resolve(__dirname, './public'),
			filename: 'js/[name].js'
		},

		// Console stats output.
		// @link https://webpack.js.org/configuration/stats/#stats
		stats: 'minimal',

		// External objects.
		externals: {
			jquery: 'jQuery'
		},

		// // Resolve settings.
		// resolve: config.resolve,

		// Performance settings.
		performance: {
			hints: false
		},

		// Build rules to handle asset files.
		module: {
			rules: [
				// Scripts.
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: ['@babel/preset-env']
						}
					}
				},

				// Styles.
				{
					test: /\.s[ac]ss$/,
					include:  path.resolve(__dirname, './resources/scss'),
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							options: {
								sourceMap: !env.production
							}
						},
						{
							loader: 'postcss-loader',
							options: {
								sourceMap: !env.production,
								config: {
									path: './postcss.config.js'
								}
							}
						},
						{
							loader: 'sass-loader',
							options: {
								sourceMap: !env.production,
								outputStyle: 'expanded'
							}
						}
					]
				},

				// // Fonts.
				// {
				// 	test: /\.(eot|ttf|woff|woff2|svg)(\?\S*)?$/,
				// 	include: path.resolve(__dirname, './resources/fonts'),
				// 	loader: 'file-loader',
				// 	options: {
				// 		publicPath: '../',
				// 		name: 'fonts/[path][name].[ext]'
				// 	}
				// },

				// // Images.
				// {
				// 	test: /\.(png|jpe?g|gif|svg)$/,
				// 	include: path.resolve(__dirname, './resources/img'),
				// 	loader: 'file-loader',
				// 	options: {
				// 		context: path.resolve(__dirname, './resources/img'),
				// 		publicPath: '../',
				// 		name: 'img/[path][name].[ext]',
				// 		emitFile: false
				// 	}
				// }
			]
		},

		// Plugins.
		plugins: [
			// Friendlier errors.
			new FriendlyErrorsWebpackPlugin(),

			// Remove the extra JS files Webpack creates for Sass entries.
			// This should be fixed in Webpack 5.
			new FixStyleOnlyEntriesPlugin({ silent: true }),

			// Clean the `public` folder on build.
			new CleanWebpackPlugin( path.resolve(__dirname, 'public'), { verbose: false } ),

			// Extract CSS into individual files.
			new MiniCssExtractPlugin({
				filename: 'css/[name].css',
				chunkFilename: '[id].css'
			}),

			// Copy static assets to the `public` folder.
			new CopyWebpackPlugin([
				{
					from: '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
					to: '[path][name].[ext]',
					context: path.resolve(__dirname, './resources')
				}
			]),

			// Minify and optimize image/SVG files.
			new ImageminPlugin({
				test: /\.(jpe?g|png|gif|svg)$/i,
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
				plugins: [imageminMozjpeg({ quality: 75 })],
				disable: !env.production
			}),

			// Run BrowserSync.
			new BrowserSyncPlugin({
				host: 'localhost',
				port: 3000,
				proxy: 'http://theme-development.localhost',
				open: false,
				// reloadDelay: 500,
				files: [
					'*.php',
					'app/**/*.php',
					'resources/views/**/*.php',
					'resources/scripts/**/*.js',
					'resources/styles/**/*.{sass,scss}',
					'resources/img/**/*.{jpg,jpeg,png,gif}',
					'resources/svg/**/*.svg',
					'resources/fonts/**/*.{eot,ttf,woff,woff2,svg}'
				]
			},
			{
				// Prevent BrowserSync from reloading the page
				// and let Webpack Dev Server take care of this.
				reload: false
			})
		]
	};
};
