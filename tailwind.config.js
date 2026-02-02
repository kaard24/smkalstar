/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/View/Components/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#0EA5E9',
                    50: '#F0F9FF',
                    100: '#E0F2FE',
                    200: '#BAE6FD',
                    300: '#7DD3FC',
                    400: '#38BDF8',
                    500: '#0EA5E9',
                    600: '#0284C7',
                    700: '#0369A1',
                    800: '#075985',
                    900: '#0C4A6E',
                },
                secondary: '#F97316',
                navy: '#1E3A5F',
                accent: '#F97316',
                ice: '#F0F9FF',
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                heading: ['Outfit', 'sans-serif'],
            },
            fontSize: {
                '2xs': '0.625rem',
            },
            animation: {
                'fade-in-up': 'fade-in-up 0.8s ease-out forwards',
                'float': 'float 6s ease-in-out infinite',
                'gradient': 'gradient-shift 8s ease infinite',
                'shimmer': 'shimmer 2s infinite',
                'scale-in': 'scale-in 0.5s ease-out forwards',
                'slide-in-right': 'slide-in-right 0.6s ease-out forwards',
            },
            keyframes: {
                'fade-in-up': {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'float': {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                'gradient-shift': {
                    '0%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                    '100%': { backgroundPosition: '0% 50%' },
                },
                'shimmer': {
                    '0%': { backgroundPosition: '-1000px 0' },
                    '100%': { backgroundPosition: '1000px 0' },
                },
                'scale-in': {
                    '0%': { opacity: '0', transform: 'scale(0.9)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                'slide-in-right': {
                    '0%': { opacity: '0', transform: 'translateX(30px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
            },
            boxShadow: {
                'glow': '0 0 30px rgba(14, 165, 233, 0.4)',
                'glow-lg': '0 0 50px rgba(14, 165, 233, 0.5)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
        require('@tailwindcss/typography'),
    ],
    safelist: [
        'bg-yellow-100',
        'text-yellow-700',
        'bg-blue-100',
        'text-blue-700',
        'bg-purple-100',
        'text-purple-700',
        'bg-cyan-100',
        'text-cyan-700',
        'bg-red-50',
        'text-red-700',
        'bg-emerald-50',
        'border-emerald-100',
        'bg-violet-50',
        'border-violet-100',
        'bg-rose-50',
        'border-rose-100',
        'bg-amber-50',
        'border-amber-100',
        'bg-fuchsia-50',
        'border-fuchsia-100',
        'bg-orange-50',
        'border-orange-100',
    ],
}
