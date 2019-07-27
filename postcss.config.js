/**
 * Exports the PostCSS configuration.
 *
 * @return {string} PostCSS options.
 */
module.exports = ( { file, options, env } ) => ( { /* eslint-disable-line */
	plugins: {
		'postcss-preset-env': {
			stage: 0,
			autoprefixer: {
				grid: true
			}
		},
		// Minify style on production using cssano.
		cssnano: 'production' === env ?
			{
				preset: [
					'default', {
						autoprefixer: true,
						calc: {
							precision: 8
						},
						convertValues: true,
						discardComments: {
							removeAll: true
						},
						mergeLonghand: false,
						zindex: false,
					},
				],
			} : false,
	},
} );
