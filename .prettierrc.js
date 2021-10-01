module.exports = {
	...require('@wordpress/prettier-config'),
	plugins: ['./node_modules/prettier-plugin-twig-melody'],
	twigMelodyPlugins: ['node_modules/prettier-plugin-twig-enhancements'],
};
