import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                label: ['IBM Plex Mono', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                paper: '#f7f9fc',
                'paper-sunk': '#e8eef5',
                ink: '#16243a',
                'ink-soft': '#2f425d',
                'ink-muted': '#52647c',
                'ink-faint': '#93a1b4',
                rule: '#d4dde8',
                'rule-strong': '#a9b7c8',
                'accent-teal': '#42c8b7',
                'accent-sky': '#8cc8ff',
                'accent-gold': '#f3c969',
                'accent-coral': '#f28f79',
                'accent-indigo': '#7887d7',
            },
            fontSize: {
                'label-s': ['12px', '100%'],
                'label-m': ['14px', '100%'],
                'body-s': ['16px', '150%'],
                'body-l': ['18px', '150%'],
                'heading-m': ['20px', '120%'],
                'heading-l': ['24px', '120%'],
                'heading-2xl': ['clamp(44px, 5.5vw, 54px)', '110%'],
            },
        },
    },

    plugins: [forms],
};
