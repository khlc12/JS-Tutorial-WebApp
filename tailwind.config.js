import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#2F4F4F',
                'secondary': '#28A745',
                'secondary-dark': '#218838',
                'mint': '#D0F0C0',
                'pale-green': '#98FB98',
            },
            fontFamily: {
                'poppins': ['Poppins', ...defaultTheme.fontFamily.sans],
                'roboto': ['Roboto', ...defaultTheme.fontFamily.sans],
                'oswald': ['Oswald', ...defaultTheme.fontFamily.sans],
                'montserrat': ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
