'use strict';

import path from 'path';

const config = {
	"dev_dir": "_dev",
	"build_dir": "_resources",
	"styles": {
		"src": "scss/styles.scss",
		"dest": "css",
		"watch": "scss/**/*.scss",
		"sass": {
			"outputStyle": "compact"
		},
		"autoprefixer": {
			"browsers": "last 2 versions",
			"cascade": false
		}
	},
	"fonts": {
		"src": "fonts/**/*",
		"dest": "fonts"
	},
	"todolist": {
		"src": "**/*.!(eot|svg|png|jpg|jpeg|gif|ttf|woff|woff2|otf|md)",
		"todo": {
			"fileName": "todo.md",
			"reporter": "markdown",
			"verbose": true,
			"customTags": [],
			"skipUnsupported": true
		}
	}
};

const onChange = (file) => {
	console.log(`File modified: "${path.basename(file.path)}"`);
};

export {config, onChange};
