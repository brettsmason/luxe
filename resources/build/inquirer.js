const inquirer = require('inquirer');

module.exports = {
	themeQuestions: () => {
		const questions = [
			{
				type: 'input',
				name: 'theme_name',
				message: 'What shall we name this theme:',
				validate: function(value) {
					if (value.length) {
						return true;
					} else {
						return 'Please enter a theme name.';
					}
				}
			},
			{
				type: 'input',
				name: 'text_domain',
				message: 'What should be the text-domain:',
				validate: function(value) {
					if (value.length) {
						return true;
					} else {
						return 'Please enter a text-domain.';
					}
				}
			},
			{
				type: 'input',
				name: 'theme_author',
				message: 'Theme Author:',
				validate: function(value) {
					if (value.length) {
						return true;
					} else {
						return 'Please enter the author.';
					}
				}
			},
			{
				type: 'input',
				name: 'theme_uri',
				message: 'Theme URI:',
				validate: function(value) {
					if (value.length) {
						return true;
					} else {
						return 'Please enter a theme URI.';
					}
				}
			}
		];
		return inquirer.prompt(questions);
	}
};
