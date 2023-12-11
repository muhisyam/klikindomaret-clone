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
        'grey': '#ccc',
        'light-grey': '#eee',
        'danger': '#c33',
      },
    },
  },
  plugins: [],
}

