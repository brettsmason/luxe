const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const imageminMozjpeg = require('imagemin-mozjpeg');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = merge(common, {
	mode: 'production',
	plugins: [

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
			plugins: [imageminMozjpeg({ quality: 75 })]
		})
	],

	optimization: {
		minimizer: [
			new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: false
			}),
			new OptimizeCSSAssetsPlugin({
				cssProcessorPluginOptions: {
					preset: ['default', { discardComments: { removeAll: true } }]
				},
				canPrint: false
			})
		]
	}
});
