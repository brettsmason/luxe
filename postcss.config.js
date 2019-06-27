/**
 * Exports the PostCSS configuration.
 */
module.exports = ({ file, options, env }) => ({
	plugins: {
		'postcss-preset-env': {
			stage: 0
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
