const theme = require('../theme.json');

const fontSizes          = theme.settings.typography.fontSizes ?? {};
const colors             = theme.settings.color.palette ?? {};
const fontSizesObject    = {};
const colorsObject       = {};

fontSizes.forEach( ( element ) => {
	fontSizesObject[ element.slug ] = `var(--wp--preset--font-size--${element.slug})`;
});

colors.forEach( ( element ) => {
	colorsObject[ element.slug ] = `var(--wp--preset--color--${element.slug})`;
});

module.exports = {
	fontSizes: fontSizesObject,
	colors: colorsObject,
}
