const purgecss = require('@fullhuman/postcss-purgecss')({

  // Specify the paths to all of the template files in your project
  content: [
    './resources/views/**/*.php',
  ],

  // Include any special characters you're using in this regular expression
  defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
});

module.exports = ( { env } ) => ( {
	plugins: {
		'postcss-import': {},
		'postcss-simple-vars': {},
		'postcss-nested': {},
		'postcss-preset-env': {
			stage: 0,
			autoprefixer: {
				grid: true,
			},
		},
		tailwindcss: {},
		cssnano: 'production' === env ?
			{
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
	},
} );
