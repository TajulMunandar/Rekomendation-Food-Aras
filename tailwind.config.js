/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'primary': {
          '100': '#f8b804',
          '200': '#dc9c04',
        },
        'secondary': '#f7f7f7',
      },
      fontFamily: {
        'body': ['Nunito']
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

