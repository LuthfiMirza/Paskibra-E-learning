import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Segoe UI', ...defaultTheme.fontFamily.sans],
                display: ['Montserrat', 'Arial Black', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // PASKIBRA Brand Colors
                paskibra: {
                    navy: '#1B365D',
                    'navy-light': '#2563EB',
                    'navy-dark': '#0F172A',
                    red: '#DC2626',
                    'red-light': '#EF4444',
                    'red-dark': '#991B1B',
                    gold: '#F59E0B',
                    'gold-light': '#FCD34D',
                    'gold-dark': '#D97706',
                },
                // Semantic Colors
                success: {
                    50: '#ECFDF5',
                    100: '#D1FAE5',
                    500: '#10B981',
                    600: '#059669',
                    700: '#047857',
                },
                warning: {
                    50: '#FFFBEB',
                    100: '#FEF3C7',
                    500: '#F59E0B',
                    600: '#D97706',
                    700: '#B45309',
                },
                danger: {
                    50: '#FEF2F2',
                    100: '#FEE2E2',
                    500: '#EF4444',
                    600: '#DC2626',
                    700: '#B91C1C',
                },
                info: {
                    50: '#EFF6FF',
                    100: '#DBEAFE',
                    500: '#3B82F6',
                    600: '#2563EB',
                    700: '#1D4ED8',
                },
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
            },
            borderRadius: {
                'xl': '0.75rem',
                '2xl': '1rem',
                '3xl': '1.5rem',
            },
            boxShadow: {
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 2px 10px -2px rgba(0, 0, 0, 0.05)',
                'paskibra': '0 4px 20px -2px rgba(27, 54, 93, 0.25)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [
        forms,
        function({ addUtilities }) {
            const newUtilities = {
                '.text-shadow': {
                    textShadow: '0 2px 4px rgba(0,0,0,0.10)',
                },
                '.text-shadow-lg': {
                    textShadow: '0 4px 8px rgba(0,0,0,0.12), 0 2px 4px rgba(0,0,0,0.08)',
                },
                '.backdrop-blur-xs': {
                    backdropFilter: 'blur(2px)',
                },
            }
            addUtilities(newUtilities)
        }
    ],
};
