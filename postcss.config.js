/**
 * Exports the PostCSS configuration.
 */
module.exports = ({ file, options, env }) => ({
	plugins: {
		'postcss-preset-env': {},
		autoprefixer: env === 'production',
		cssnano: env === 'production'
	}
});
