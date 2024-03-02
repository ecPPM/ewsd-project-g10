import forms from "@tailwindcss/forms";

/** @type {import("tailwindcss").Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    daisyui: {
        themes: [
            {
                winter: {
                    ...require("daisyui/src/theming/themes")["winter"],
                    // Default colors for winter theme from here -> node_modules/daisyui/src/theming/themes.js
                    // Can change these colors to our liking
                    // primary: "#0069FF",
                    // secondary: "#463AA2",
                    // accent: "#C148AC",
                    // neutral: "#021431",
                    // "base-100": "#FFFFFF",
                },
            },
        ],
    },
    // Note: Not sure about commenting out the original theme object
    // theme: {
    //     extend: {
    //         fontFamily: {
    //             sans: ["Figtree", ...defaultTheme.fontFamily.sans],
    //         },
    //     },
    // },
    plugins: [forms, require("daisyui")],
};
