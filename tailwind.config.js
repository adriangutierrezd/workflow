const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {

    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/**/*.blade.php',
        './resources/views/**/**/**/*.blade.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                blueGray: colors.blueGray,
                red: colors.red,
                emerald: colors.emerald,
                blue: colors.blue, 
                rose: colors.rose,
            },
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
            }
        },


    plugins: [
        require('@tailwindcss/forms'), require('@tailwindcss/typography'),
    ],
};

