/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        screens: {
            'xs': {'min': '200px', 'max': '640px'},

            'sm': {'min': '640px', 'max': '768px'},
            // => @media (min-width: 640px and max-width: 767px) { ... }

            'md': {'min': '769px', 'max': '1023px'},
            // => @media (min-width: 768px and max-width: 1023px) { ... }

            'lg': {'min': '1024px', 'max': '1285px'},
            // => @media (min-width: 1024px and max-width: 1279px) { ... }

            'xl': {'min': '1285px', 'max': '1535px'},
            // => @media (min-width: 1280px and max-width: 1535px) { ... }

            '2xl': {'min': '1536px'},
            // => @media (min-width: 1536px) { ... }
        }
    },
    plugins: [],
}

