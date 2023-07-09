/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: 'jit',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#ff8243',
                    btn: '#ff6a00',
                    50: '#ffe1d2',
                    100: '#ffc7b0',
                    200: '#ffa88a',
                    300: '#ff895f',
                    400: '#ff703b',
                    500: '#ff5920',
                    600: '#f4501d',
                    700: '#c1431c',
                    800: '#91381a',
                    900: '#6d2f17',
                },
                secondary: "#091353",
                softPrimary: "rgba(255, 137, 105, 0.25)",
            },
            boxShadow: {
                btn: "0 0.125rem 0.25rem 0 rgba(255, 137, 105, 0.4)",
            },
            backgroundImage: {
                'select': `url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%2867, 89, 113, 0.6%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e")`,
            },
            backgroundColor: {
                primary: {
                    DEFAULT: '#ff8243',
                    50: '#ffe1d2',
                    100: '#ffc7b0',
                    200: '#ffa88a',
                    300: '#ff895f',
                    400: '#ff703b',
                    500: '#ff5920',
                    600: '#f4501d',
                    700: '#c1431c',
                    800: '#91381a',
                    900: '#6d2f17',
                },
                secondary: '#091353',
            },
            fontFamily: {
                sans: ['Public Sans', 'sans-serif'],
            },
        },
        screens: {
            xs: "480px",
            ss: "620px",
            sm: "768px",
            md: "1060px",
            lg: "1200px",
            xl: "1700px",
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}

