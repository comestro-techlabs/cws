import withMT from "@material-tailwind/html/utils/withMT";


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"

    ],
    theme: {
        extend: {
            colors: {
                primary: "#662d91",
                secondary: "#0071bc"
            }
        }
    },
    plugins: [
        require('flowbite/plugin')

    ],
};
