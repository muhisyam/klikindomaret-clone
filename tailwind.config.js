/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./public/**/*.js",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        'primary': '#f9c828',
        'secondary': '#0079c2',
        'tertiary': '#fbde7e',
        'accent': '#fbf0d0',
        'light-gray-100': '#eee',
        'light-gray-200': '#ccc',
        'light-gray-300': '#95989a',
        'danger': '#c33',
        'dark-primary': '#e1b526',
      },
      minHeight:{
        'auth': '350px',
        'auth-header': '160px',
      }
    },
  },
  plugins: [],
}

