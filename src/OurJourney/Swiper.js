//Initialize swiper
// var swiper = new Swiper(".mySwiper", {
//   direction: "vertical",
//   slidesPerView: 1,
//   spaceBetween: 30,
//   mousewheel: true,
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
// });

//toggle popup on our farm story
function toggle() {
  var header = document.querySelector("#header");
  header.classList.toggle("header-hidden");
  var blur = document.querySelector("#main");
  blur.classList.toggle("active");
  // var popup = document.getElementById("popup");
  // popup.classList.toggle("active");
}

//slide only text content inside slide when mouse pointer is on text content
document.addEventListener("DOMContentLoaded", function () {
  const paragraph = document.querySelector(".scrollbar1");

  // Add event listener to the paragraph for scroll
  paragraph.addEventListener("wheel", function (event) {
    // Prevent default scroll behavior to stop the swiper slide from scrolling
    event.preventDefault();
    // Stop the scroll event from reaching the swiper slide
    event.stopPropagation();
    // Manually scroll the paragraph
    paragraph.scrollTop += event.deltaY;
  });
});

//close popup when click outside of popup
document.addEventListener("click", function (event) {
  const popup = document.querySelector("#popup");
  var blur = document.querySelector("#main");
  var header = document.querySelector("#header");

  if (!popup.contains(event.target) && event.target.id !== "farm") {
    if (popup.classList.contains("active")) {
      header.classList.remove("header-hidden");
      blur.classList.remove("active");
      // popup.classList.remove("active");
    }
  }
});
