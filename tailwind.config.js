const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    height: {
     '0': '0',
     '1/4': '25vh',
     '1/2': '50vh',
     '3/4': '75vh',
     '4/5': '80vh',
     'full': '100vh',
    },

    plugins: [require('@tailwindcss/ui')],
};
