/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      animation: {
        moving: 'moving 2s linear infinite',
      },
      keyframes: {
        moving: {
          '0%': { left: '0px' },
          '100%': { left: '100%' },
        },
      },
    },
  },
  plugins: [
    function ({ addComponents }) {
      addComponents({
        'input[type="search"]': {
          '-webkit-appearance': 'textfield',
          'outline-offset': '-2px',
        }
      });
    }
  ],
}