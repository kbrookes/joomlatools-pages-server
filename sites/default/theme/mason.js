const mason = require("@joomlatools/mason-tools-v1");
const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");
const markers = require("@radishio/tailwindcss-marker");

async function css() {
  await mason.css.process("scss", "css", {
	tailwind: {
	  purge: {
		enabled: true,
		content: ["../**/*.html.php"],
		options: {
		  safelist: {
			standard: [/^opacity/, /^btn/, /^hamburger/],
		  },
		},
	  },
	  theme: {
		opacity: {
		  0: "0",
		  5: ".05",
		  10: ".1",
		  20: ".2",
		  30: ".3",
		  40: ".4",
		  50: ".5",
		  60: ".6",
		  70: ".7",
		  80: ".8",
		  90: ".9",
		  95: ".95",
		  100: "1",
		},
		extend: {
		  maxHeight: {
			0: "0",
			"1/4": "25%",
			"1/2": "50%",
			"3/4": "75%",
			full: "100%",
		  },
		},
		extend: {
		  fontFamily: {
			sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
			body: ["Montserrat", ...defaultTheme.fontFamily.sans],
		  },
		  fontSize: {
			"4xl": ["2.25rem", "1.35"],
			"5xl": ["3rem", "1.35"],
			"6xl": ["4rem", "1.35"],
			"7xl": ["5rem", "1.35"],
		  },
		  colors: {
			primary: "#008fd2",
			secondary: "#2f6690",
			dark: "#445c6d",
			light: "#f2f4f5",
			lime: colors.lime,
			emerald: colors.emerald,
			teal: colors.teal,
			cyan: colors.cyan,
			blueGray: colors.blueGray,
		  },
		  outline: {
			white: ["5px solid #ffffff", "-50px"],
		  },
		  typography: {
			primary: {
			  css: {
				color: "#7dc622",
			  },
			},
			secondary: {
			  css: {
				color: "#2f6690",
			  },
			},
			dark: {
			  css: {
				color: "#445c6d",
			  },
			},
			light: {
			  css: {
				color: "#f2f4f5",
			  },
			},
			DEFAULT: {
			  css: {
				h1: null,
				h2: null,
				h3: null,
				h4: null,
				h5: null,
				h6: null,
			  },
			},
		  },
		},
	  },
	  plugins: [
		require("@tailwindcss/typography"),
		require("@tailwindcss/forms"),
		require("@tailwindcss/aspect-ratio"),
		require("@tailwindcss/line-clamp"),
	  ],
	},
	sass: true,
	postcssPresetEnv: {
	  stage: 3,
	  features: {
		"nesting-rules": true,
	  },
	  autoprefixer: { cascade: true, grid: true },
	},
	cssnano: {
	  preset: ["default", { discardComments: { removeAll: true } }],
	},
  });
}

module.exports = {
  version: "1.0",
  tasks: {
	css,
	watch: {
	  path: ["."],
	  callback: async (path) => {
		if (path.endsWith(".scss")) {
		  await css();
		}
	  },
	},
  },
};
