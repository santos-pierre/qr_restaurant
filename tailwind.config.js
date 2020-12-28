const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

module.exports = {
    darkMode: 'media', // or 'media' or 'class'
    theme: {
        borderWidth: {
            default: '1px',
            '0.25': '0.25px',
            '0.5': '0.5px',
            '1.5': '1.5px',
            '2': '2px'
        },
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                blueGray: colors.blueGray,
                coolGray: colors.coolGray,
                teal: colors.teal,
                overlayDark: 'rgba(15, 23, 42, 0.50)'
            },
            height: {
                '25': '6.55rem',
                '26': '6.60rem',
                '27': '6.75rem'
            }
        }
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
            ringWidth: ['active'],
            ringColor: ['hover', 'active']
        }
    },
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
            './resources/**/*.twig'
        ],
        options: {
            defaultExtractor: content =>
                content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/]
        }
    },
    plugins: [require('@tailwindcss/forms')]
};
