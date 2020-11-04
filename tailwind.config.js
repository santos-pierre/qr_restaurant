const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        borderWidth: {
            default: '1px',
            '0.25': '0.25px',
            '0.5': '0.5px',
            '1.5': '1.5px',
            '2' : '2px'
        },
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                light: { raw: "(prefers-color-scheme: light)" },
                dark: { raw: "(prefers-color-scheme: dark)" }
            },
            colors: {
                'light-gray' : '#718096',
                'text-dark' : '#EDF2F7',
                'text-light': '#2D3748'
            }
        },
    },
    variants: {},
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        function({ addBase, config }) {
            addBase({
                body: {
                    color: config("theme.colors.black"),
                    backgroundColor: config("theme.colors.white")
                },
                "@screen dark": {
                    body: {
                        color: config("theme.colors.white"),
                        backgroundColor: config("theme.colors.black")
                    }
                }
            });
        },
        require('@tailwindcss/ui'),
        require('@tailwindcss/typography'),
    ],
};
