/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        // "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"

    ],
    theme: {
        extend: {
            colors:{
                color_1:"#331F52",
                color_2:"#309561",
                color_3:"#473563",
                color_4:"#3D2A5B",
                color_5:"#B1AABD"
            }
        },
    },

  plugins: [
      require('flowbite/plugin')
  ],
}
