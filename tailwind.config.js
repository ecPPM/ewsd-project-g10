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
                appTheme: {
                    ...require("daisyui/src/theming/themes")["winter"],
                    // See default theme colors -> node_modules/daisyui/src/theming/themes.js
                    // Custom theme colors here
                    // primary: "",
                    // secondary: "",
                    // accent: "",
                    // neutral: "",
                    // "base-100": "",
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
