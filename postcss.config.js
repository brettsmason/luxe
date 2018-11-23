/**
 * Exports the PostCSS configuration.
 */
module.exports = ({ file, options, env }) => ({
	plugins: {
		'postcss-preset-env': {
			stage: 0
		},
		'postcss-pxtorem': {
			rootValue: 18,
			unitPrecision: 5,
			propList: ['*'],
			replace: true,
			mediaQuery: false,
			minPixelValue: 0
		},
		autoprefixer: 'production' === env ? { grid: true } : false,
		cssnano: 'production' === env ?
		{
			'preset': [
				'default',
				{ 'discardComments': { 'removeAll': true } }
			]
		} : false
	}
});
