const fs = require("fs-extra");
const path = require("path");
const chalk = require("chalk");
const inquirer = require("./inquirer");
const conf = require("./conf.json");
const replace = require("replace-in-file");
const clear = require("clear");
const figlet = require("figlet");

const themePrompt = async () => {
	const themedata = await inquirer.themeQuestions();
	conf["themeName"] = themedata.theme_name;
	conf["textDomain"] = themedata.text_domain;
	conf["themeAuthor"] = themedata.theme_author;
	conf["themeUri"] = themedata.theme_uri;
	fs.writeJson("./resources/build/conf.json", conf, { spaces: 2 });
};

const themeData = async () => {
	const options = {
		files: "style.css",
		from: ["https://github.com/brettsmason/luxe", "Brett Mason"],
		to: [conf.themeUri, conf.themeAuthor]
	};

	try {
		const changes = await replace(options);
		console.log(
			chalk.bold("Theme data updated in:\n"),
			chalk.yellow(changes.join(",\n"))
		);
	} catch (error) {
		console.error("Error occurred:", error);
	}
};

const nameReplace = async () => {
	await themePrompt();
	await themeData();
	const options = {
		files: [
			"resources/views/**/*.php",
			"functions.php",
			"style.css",
			"readme.md"
		],
		from: [/Luxe/g, /luxe-/g, /luxe_/g, /luxe/g],
		to: [
			conf.themeName,
			`${conf.textDomain}-`,
			`${conf.textDomain}_`,
			conf.textDomain
		]
	};

	try {
		const changes = await replace(options);
		console.log(
			chalk.bold("New theme name added to the following:\n"),
			chalk.yellow(changes.join(",\n"))
		);
	} catch (error) {
		console.error("Error occurred:", error);
	}
};

module.exports = {
	nameReplace
};
