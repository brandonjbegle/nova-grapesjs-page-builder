const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {    
    extend: {
      colors: {
        teal: colors.teal,
        sky: colors.sky,
      },
    },
  },
  plugins: [],
}