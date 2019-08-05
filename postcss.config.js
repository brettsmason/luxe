const purgecss = require( './config/purgecss' );

module.exports = ( { env } ) => ( {
	plugins: {
		'postcss-import': {},
		'postcss-simple-vars': {},
		'postcss-preset-env': {
			stage: 0,
			autoprefixer: {
				grid: true,
			},
		},
		tailwindcss: {},
		'postcss-nested': {},
		cssnano: 'production' === env ? {
			preset: [
				'default', {
					autoprefixer: true,
					calc: {
						precision: 8,
					},
					convertValues: true,
					discardComments: {
						removeAll: true,
					},
					mergeLonghand: false,
					zindex: false,
				},
			],
		} : false,
		'@fullhuman/postcss-purgecss': 'production' === env ? {
			content: [ './resources/views/**/*.php' ],
			defaultExtractor: ( content ) => content.match( /[A-Za-z0-9-_:/]+/g ) || [],
			whitelist: purgecss.whitelist,
			whitelistPatterns: purgecss.whitelistPatterns,
		} : false,
	},
} );
