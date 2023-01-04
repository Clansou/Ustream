/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.css",
    ],
  theme: {
    extend: {
      colors: {
        'yellow': '#e7b100',
        'grey': '#3b3e46',
        'lightGrey': 'darkgrey',
      },
    },
  },
  plugins: [],
}
