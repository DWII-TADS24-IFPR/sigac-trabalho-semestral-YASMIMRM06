import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Modo escuro via classe HTML

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Cores institucionais (IFPR/SIGAC)
                'ifpr': {
                    50: '#E8F5E9',    // Verde claro (fundo)
                    100: '#C8E6C9',
                    200: '#A5D6A7',
                    300: '#81C784',
                    400: '#66BB6A',
                    500: '#4CAF50',   // Verde principal (DEFAULT)
                    600: '#43A047',
                    700: '#388E3C',   // Verde escuro
                    800: '#2E7D32',
                    900: '#1B5E20',   // Verde quase preto (modo escuro)
                },
                // Cores de estado (compatíveis com Bootstrap)
                primary: '#4CAF50',    // Verde IFPR
                secondary: '#FFC107',  // Amarelo/Laranja
                success: '#16a34a',    // Verde (sucesso)
                danger: '#dc2626',     // Vermelho (erro)
                warning: '#f59e0b',    // Laranja (alerta)
                info: '#0284c7',       // Azul (informação)
            },
        },
    },

    plugins: [forms],
};