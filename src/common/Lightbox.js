import gsap from "../../node_modules/gsap/all.js";

export default class Lightbox{

  constructor(){
    this.setLightbox();
  }

  setLightbox() {
    let button = document.querySelector("#lb-button");
    let lb = document.querySelector(".lb");
    let lbBg = document.querySelector(".lb-bg");
    let closeButton=document.getElementById('closeButton');

    let tl = gsap.timeline().pause();

    tl.fromTo(
      ".lb",
      {
        scale: 0.1,
        opacity: 0,
        display: "none",
        pointerEvents: "none",
      },
      {
        scale: 1,
        opacity: 1,
        display: "flex",
        pointerEvents: "auto",
        ease: "back.out(1.7)",
      },
    );

    tl.fromTo(
      ".lb-bg",
      {
        opacity: 0,
        display: "none",
      },
      {
        opacity: 0.8,
        display: "block",
      },
      "<",
    );

    button.addEventListener("click", () => {
      tl.play();

      document.body.style.overflow = "hidden";
    });

    lbBg.addEventListener("click", () => {
      tl.reverse();

      document.body.style.overflow = "unset";
      document.body.style.overflowX = "hidden";
    });

    closeButton.addEventListener("click",()=>{
      tl.reverse();

      document.body.style.overflow = "unset";
      document.body.style.overflowX = "hidden";
    })
  }

}
