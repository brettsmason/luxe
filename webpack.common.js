const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const Fiber = require('fibers');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const HardSourceWebpackPlugin = require('hard-source-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isProduction = process.env.NODE_ENV === 'production';

const config = require('./config/build');

module.exports = {
	entry: config.entries,

	output: {
		path: path.resolve(__dirname, config.paths.public),
		filename: config.outputs.javascript
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: 'minimal',

	// External objects.
	externals: config.externals,

	// custom modules resolving.
	resolve: config.resolve,

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
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: ['@babel/preset-env'],
							cacheDirectory: true,
							sourceMap: ! isProduction
						}
					}
				]
			},

			// Styles.
			{
				test: /\.s[ac]ss$/,
				// include: path.resolve(__dirname, 'resources/scss'),
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							sourceMap: ! isProduction,
							url: false
						}
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction
						}
					},
					{
						loader: 'sass-loader',
						options: {
							implementation: require('sass'),
							fiber: Fiber,
							sourceMap: ! isProduction,
							outputStyle: 'expanded'
						}
					}
				]
			}
		]
	},

	plugins: [

		// Friendlier errors.
		new FriendlyErrorsWebpackPlugin(),

		// Remove the extra JS files Webpack creates for Sass entries.
		// This should be fixed in Webpack 5.
		new FixStyleOnlyEntriesPlugin({
			silent: true
		}),

		// Clean the `public` folder on build.
		new CleanWebpackPlugin(path.resolve(__dirname, config.paths.public), {
			verbose: false
		}),

		// Create our cache busting asset manifest.
		new ManifestPlugin({

			// Filter using only .js and .css files.
			filter: ({name}) => name.endsWith( '.js' ) || name.endsWith( '.css' ),
			map: (file) => {

				// Add hash details on production for cache busting.
				return {
					name: file.path,
					path: isProduction ? `${file.path}?id=${file.chunk.hash}` : file.path
				};
			}
		}),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin({
			filename: config.outputs.css,
			chunkFilename: '[id].css'
		}),

		// Copy static assets to the `public` folder.
		new CopyWebpackPlugin([
			{
				from: '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
				to: '[path][name].[ext]',
				context: path.resolve(__dirname, config.paths.assets)
			}
		]),

		// Cache for improved concurrent builds.
		new HardSourceWebpackPlugin({
			info: {
				level: 'warn'
			}
		})
	]
};
