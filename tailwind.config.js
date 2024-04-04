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
        'gradient-red': 'linear-gradient(to bottom, #E74348 100%, #E74348 0%)',
        'gradient-blue': 'linear-gradient(to bottom, #4099FF 100%, #4099FF 0%)',
        'gradient-green': 'linear-gradient(to bottom, #64E743 100%, #64E743 0%)'
      },
    },
  },
  plugins: [],
}

