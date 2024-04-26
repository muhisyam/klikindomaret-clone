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
      colors: {
        'primary': '#f9c828',
        'primary-50': '#fbf0d0',
        'primary-100': '#fae7d4',
        'primary-600': '#f28418',
        'secondary': '#0079c2',
        'secondary-50': '#e1eeff',
        'tertiary': '#fbde7e',
        'accent': '#fbf0d0',
        'light-gray-50': '#f5f5f5',
        'light-gray-100': '#eee',
        'light-gray-200': '#ccc',
        'light-gray-300': '#95989a',
        'light-gray-400': '#999',
        'danger': '#c33',
        'dark-primary': '#e1b526',
        'black': '#131313',
      },
      minHeight: {
        'auth': '350px',
        'auth-header': '160px',
      },
      boxShadow: {
        'input': '0 1px 4px rgba(0,121,194,.4)',
        'card': '0px 2px 6px rgba(0, 0, 0, 0.16)',
      },
      transitionProperty: {
        'width': 'width',
      },
    },
  },
  plugins: [],
}

