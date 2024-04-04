/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      sans: ["Poppins", "sans-serif"],
    },
    extend: {

      colors: {
        primary: '#E52228'
      },
      backgroundImage: {
        'gradient-primary': 'linear-gradient(to bottom, #E74348 100%, #E74348 0%)'
      },
    },
  },
  plugins: [],
}

