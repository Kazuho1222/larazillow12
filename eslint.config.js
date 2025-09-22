import js from "@eslint/js";

export default [
    js.configs.recommended,
    {
        files: ["**/*.js"],
        languageOptions: {
            ecmaVersion: 2020,
            sourceType: "module",
            globals: {
                // AMD
                define: "readonly",
                require: "readonly",
                // Browser
                window: "readonly",
                document: "readonly",
                console: "readonly",
                // ES6
                Promise: "readonly",
                Set: "readonly",
                Map: "readonly",
                Symbol: "readonly",
                Proxy: "readonly",
                Reflect: "readonly",
            },
        },
        rules: {
            indent: ["error", 2],
            quotes: ["warn", "single"],
            semi: ["warn", "never"],
            "object-curly-spacing": ["error", "always"],
            "no-unused-vars": [
                "error",
                { vars: "all", args: "after-used", ignoreRestSiblings: true },
            ],
            "comma-dangle": ["warn", "always-multiline"],
        },
    },
];
