const merge = require( 'webpack-merge' );
const common = require( './webpack.common.js' );
const ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;
const imageminMozjpeg = require( 'imagemin-mozjpeg' );
const TerserPlugin = require( 'terser-webpack-plugin' );

module.exports = merge(common, {
	mode: 'production',
	plugins: [

		// Minify and optimize image/SVG files.
		new ImageminPlugin({
			test: /\.(jpe?g|png|gif|svg)$/i,
			optipng: {
				optimizationLevel: 7
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
					{ cleanupIDs: false },
					{ mergePaths: false },
					{ removeUnknownsAndDefaults: false },
					{ removeViewBox: false },
				]
			},
			plugins: [imageminMozjpeg({ quality: 75 })]
		})
	],

	optimization: {
		minimizer: [
			new TerserPlugin({
				cache: true,
				parallel: true,
				sourceMap: false,
				terserOptions: {
					parse: {
						// We want terser to parse ecma 8 code. However, we don't want it
						// to apply any minfication steps that turns valid ecma 5 code
						// into invalid ecma 5 code. This is why the 'compress' and 'output'
						// sections only apply transformations that are ecma 5 safe
						// https://github.com/facebook/create-react-app/pull/4234
						ecma: 8
					},
					compress: {
						ecma: 5,
						warnings: false,
						// Disabled because of an issue with Uglify breaking seemingly valid code:
						// https://github.com/facebook/create-react-app/issues/2376
						// Pending further investigation:
						// https://github.com/mishoo/UglifyJS2/issues/2011
						comparisons: false,
						// Disabled because of an issue with Terser breaking valid code:
						// https://github.com/facebook/create-react-app/issues/5250
						// Pending futher investigation:
						// https://github.com/terser-js/terser/issues/120
						inline: 2
					},
					output: {
						ecma: 5,
						comments: false
					},
					ie8: false
				}
			})
		]
	}
});
