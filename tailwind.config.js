/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  daisyui: {
    themes: [
        {
            pptheme: {
                "primary" : "#ff8243",
                "secondary": "#091353",
                "base-100": "#F4F6F9",
                "info": "#66C6FF",
                "success": "#87D039",
                "warning": "#E2D562",
                "error": "#FF6F6F"
            }
        }
    ],
  },
  theme: {
    fontFamily: {
        'sans': ['Nunito', 'sans-serif']
    },
    extend: {},
  },
  plugins: [require("daisyui")],
}
