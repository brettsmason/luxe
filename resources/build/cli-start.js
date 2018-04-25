const chalk = require("chalk");
const clear = require("clear");
const figlet = require("figlet");
const prompt = require("./prompt");

( () => {
	clear();
	console.log(
		chalk.whiteBright.bgHex("#3d627d")(
			figlet.textSync("Theme\nHybrid", { horizontalLayout: "fitted" })
		)
	);
	prompt.nameReplace();
})();
