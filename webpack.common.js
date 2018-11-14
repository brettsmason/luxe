const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
	entry: {
		app: './resources/js/app.js',
		screen: './resources/scss/screen.scss',
		editor: './resources/scss/editor.scss',
		woocommerce: './resources/scss/woocommerce.scss'
	},
	output: {
		path: path.resolve(__dirname, 'public'),
		filename: 'js/[name].js'
	},

	// Console stats output.
	// @link https://webpack.js.org/configuration/stats/#stats
	stats: 'minimal',

	// External objects.
	externals: {
		jquery: 'jQuery'
	},

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
						presets: ['@babel/preset-env'],
						cacheDirectory: true
					}
				}
			},

			// Styles.
			{
				test: /\.s[ac]ss$/,
				include: path.resolve(__dirname, 'resources/scss'),
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							sourceMap: ! isProduction
						}
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction,
							config: {
								path: 'postcss.config.js'
							}
						}
					},
					{
						loader: 'sass-loader',
						options: {
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
		new CleanWebpackPlugin(path.resolve(__dirname, 'public'), {
			verbose: false
		}),

		// Create our cache busting asset manifest.
		new ManifestPlugin({
			map: (file) => {
				const extension = path.extname(file.name).slice(1);

				// Add hash details on production for cache busting.
				return {
					...file,
					name: file.path,
					path: ['css', 'js'].includes(extension) && isProduction ?
					`${file.path}?id=${file.chunk.hash}` :
					file.path
				}
			}
		}),

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
		])
	]
};
