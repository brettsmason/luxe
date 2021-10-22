module.exports = {
	mode: 'jit',
	purge: {
		content: [
			'./app/**/*.php',
			'./resources/views/**/*.php',
			'./resources/css/**/*.css',
			'./resources/js/*.js',
			'./safelist.txt'
		],
},
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography')],
}
