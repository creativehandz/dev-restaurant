/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
  "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
	"./resources/**/*.vue",
	 "./index.html",
    "./our-journey/index.html",
    "./menu/index.html",
    "./reservation/index.html",
    "./contact/index.html",
    "./src/**/*.{html,js,ts,jsx,tsx}",
  ],
  theme: {
   
		extend: {
      screens: {
        xs: { min: "360px", max: "639px" },
      },
      backgroundImage: theme => ({
        'tomahawk': "url('public/images/tomahawk.png')",
        'oprib':"url('public/images/OPrib.png')",
        'wagyu':"url('public/images/wagyu.png')",
      })
    },
	
  },
  plugins: [],
}

