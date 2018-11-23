const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const imageminMozjpeg = require('imagemin-mozjpeg');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

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
			new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: false,
				uglifyOptions: {
					ie8: false,
					ecma: 5,
					output: {
						comments: false,
						beautify: false
					},
					warnings: false
				}
			})
		]
	}
});
