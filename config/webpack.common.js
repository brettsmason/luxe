const path = require( 'path' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
const FriendlyErrorsWebpackPlugin = require( 'friendly-errors-webpack-plugin' );
const ManifestPlugin = require( 'webpack-manifest-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const WebpackBar = require( 'webpackbar' );

const isProduction = process.env.NODE_ENV === 'production';

// Build settings.
const settings = require( './webpack.settings.js' );

module.exports = {
	entry: settings.entries,

	output: {
		path: path.resolve( process.cwd(), settings.paths.public ),
		filename: settings.outputs.javascript,
	},

	// Console stats output.
	stats: settings.stats,

	// External objects.
	externals: settings.externals,

	// custom modules resolving.
	resolve: settings.resolve,

	// Performance settings.
	performance: {
		hints: false,
		maxAssetSize: 100000,
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
							cacheDirectory: true,
							sourceMap: ! isProduction,
						},
					},
				],
			},

			// Styles.
			{
				test: /\.s[ac]ss$/,
				include: path.resolve( process.cwd(), settings.paths.sass ),
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							sourceMap: ! isProduction,
							url: false,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: ! isProduction,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							implementation: require( 'sass' ),
							sourceMap: ! isProduction,
							sassOptions: {
								fiber: require( 'fibers' ),
								outputStyle: 'expanded',
							},
						},
					},
				],
			},
		],
	},

	plugins: [

		// Friendlier errors.
		new FriendlyErrorsWebpackPlugin(),

		// Remove the extra JS files Webpack creates for Sass entries.
		// This should be fixed in Webpack 5.
		new FixStyleOnlyEntriesPlugin( {
			silent: true,
		} ),

		// Clean the `public` folder on build.
		new CleanWebpackPlugin( {
			cleanStaleWebpackAssets: true,
			verbose: false,
		} ),

		// Create our cache busting asset manifest.
		new ManifestPlugin( {

			// Filter using only .js and .css files.
			filter: ( { name } ) => name.endsWith( '.js' ) || name.endsWith( '.css' ),
			map: ( file ) => {
				// Add hash details on production for cache busting.
				return {
					name: file.path,
					path: isProduction ? `${ file.path }?id=${ file.chunk.hash }` : file.path,
				};
			},
		} ),

		// Extract CSS into individual files.
		new MiniCssExtractPlugin( {
			filename: settings.outputs.css,
			chunkFilename: '[id].css',
		} ),

		// Copy static assets to the `public` folder.
		new CopyWebpackPlugin(
			[ {
				from: '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
				to: '[path][name].[ext]',
				context: path.resolve( process.cwd(), settings.paths.assets ),
			} ],
			{
				copyUnmodified: true,
			}
		),

		// Fancy WebpackBar.
		new WebpackBar(),
	],
};
