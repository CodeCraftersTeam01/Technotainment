import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        "bg-blue-500",
        "bg-yellow-500",
        "bg-red-500",
        "bg-green-500",
        "bg-purple-500",
        "bg-yellow-100",
        "hover:bg-green-100",
        "hover:bg-purple-100",
        "hover:bg-yellow-100",
    ],
    theme: {
        extend: {
            colors: {
                "purple-primary": "#7c5cff",
                "purple-secondary": "#6a4aff",
                "blue-primary": "#072d44",
                "blue-secondary": "#064469",
                "blue-tertiary": "#5790ab",
                "blue-quaternary": "#9ccddb",
                "blue-quinary": "#d0d7e1",
                primary: "#072d44",
                secondary: "#064469",
                tertiary: "#5790ab",
                quaternary: "#9ccddb",
                quinary: "#d0d7e1",
            },
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                float: "float 6s ease-in-out infinite",
                "float-delay": "float 6s ease-in-out 3s infinite",
                "spin-slow": "spin 8s linear infinite",
                "spin-slow-reverse": "spin 8s linear infinite reverse",
                "pulse-slow": "pulse 4s ease-in-out infinite",
            },
            keyframes: {
                float: {
                    "0%, 100%": { transform: "translateY(0)" },
                    "50%": { transform: "translateY(-20px)" },
                },
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        strong: {
                            color: theme("colors.quaternary"),
                            fontWeight: "800",
                        },
                        p: {
                            color: theme("colors.quaternary"),
                        },
                        h1: {
                            color: "white",
                        },
                        ul: {
                            color: theme("colors.quaternary"),
                            'li::marker': {
                                color: theme("colors.quaternary"),
                            },
                        },
                        ol: {
                            color: theme("colors.quaternary"),
                            'li::marker': {
                                color: theme("colors.quaternary"),
                            },
                        }
                    }
                }
            }),
        },
    },
    plugins: [require("@tailwindcss/typography")],
};
