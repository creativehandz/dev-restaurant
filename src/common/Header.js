import gsap from "../node_modules/gsap/all.js";

export default class Header {
  constructor() {
    this.container = document.querySelector("#header");

    this.setDomElements();
    this.setLogoAnimations();
    this.setButtonAnimations();
    this.setNavAnimations();
    this.addEventListeners();
  }

  setDomElements() {}

  setLogoAnimations() {
    let tl = gsap.timeline().reverse().pause();
    this.logoTl = tl;

    tl.to("#header .logo", {
      clipPath:
        "polygon(0% 0%, 0% 100%, 99% 100%, 99% 54%, 100% 54%, 100% 100%, 100% 0%)",
    });
  }

  setButtonAnimations(color) {
    let tl = gsap.timeline().reverse().pause();
    this.buttonTl = tl;

    tl.to(".menu-button .el-1", {
      width: 48,
      backgroundColor: color,
      stagger: 0.1,
    });
    // tl.play();
  }

  setNavAnimations() {
    let tl = gsap.timeline().reverse().pause();
    let mm = gsap.matchMedia();
    this.navTl = tl;

    tl.to(".nav", {
      y: 0,
      onStart: () => {
        document.body.style.perspective = "900px";
      },
      onReverseComplete: () => {
        document.body.style.perspective = "0px";
      },
    });

    mm.add("(max-width: 1023px)", () => {
      tl.to(
        ".main",
        {
          rotateX: 37 - window.innerHeight * 0.007,
          translateY: -24,
        },
        "<",
      );

      tl.to(
        ".back",
        {
          rotateX: 37 - window.innerHeight * 0.005,
          translateY: 0,
        },
        "<",
      );
    });

    mm.add("(min-width: 1024px)", () => {
      tl.to(
        ".main",
        {
          rotateX: 24,
          translateY: -48,
        },
        "<",
      );

      tl.to(
        ".back",
        {
          rotateX: 24,
          translateY: 0,
        },
        "<",
      );
    });

    // tl.play();
  }

  addEventListeners() {
    let logo = this.container.querySelector(".logo");
    logo.addEventListener("mouseenter", () => {
      this.logoTl.play();
    });

    logo.addEventListener("mouseleave", () => {
      this.logoTl.reverse();
    });

    let button = this.container.querySelector(".menu-button");
    let navButton = document.querySelector(".nav-button");

    button.addEventListener("mouseenter", () => {
      this.buttonTl.play();
    });

    button.addEventListener("mouseleave", () => {
      if (this.navTl.reversed()) {
        this.buttonTl.reverse();
      }
    });

    [button, navButton].forEach((btn) => {
      btn.addEventListener("click", () => {
        if (this.navTl.reversed()) {
          this.navTl.play();
          this.buttonTl.play();
        } else {
          this.navTl.reverse();
          this.buttonTl.reverse();
        }
      });
    });
  }

  returnToNormal() {
    this.navTl.reverse();
  }
}
