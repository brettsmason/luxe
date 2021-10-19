const { fontSizes, colors } = require('./config/theme.js');

module.exports = {
	mode: 'jit',
	purge: {
		content: [
			'app/**/*.php',
			'resources/views/**/*.twig',
			'resources/js/**/*.js',
			'resources/css/**/*.css',
			'resources/svg/**/*.svg',
			'./safelist.txt',
		],
	},
	darkMode: false, // or 'media' or 'class'
	theme: {
		container: {
			center: true,
			padding: '1.5rem',
		},
		colors: colors,
		fontSize: fontSizes,
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [require('@tailwindcss/typography')],
	plugins: [require('@tailwindcss/forms')],
};
