module.exports = {
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
    defaultLineHeights: true,
    standardFontWeights: true
  },
  purge: [
		'./resources/views/**/*.php',
		'./*.php'
	],
  theme: {
    extend: {}
  },
  variants: {},
  plugins: []
}
