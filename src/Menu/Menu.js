import Common from "../common/Common.js";
import gsap from "../../node_modules/gsap/all.js";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

export default class Menu {
  constructor() {
    this.common = new Common();

    this.setScrollAnimations();
    this.setAnimations();
    this.addEventListeners();

    setTimeout(() => {
      document.querySelector("#main").classList.add("scroll");
    }, 100);
  }

  setScrollAnimations(tabId = "starters") {
    gsap.globalTimeline.clear();

    let st = {
      // scroller: "#main",
      start: "top bottom",
      toggleActions: "play none none reverse",
      // markers: true,
    };

    let from = {
      opacity: 0,
      y: 72,
    };

    let to = {
      y: 0,
      opacity: 1,
      duration: 0.5,
    };

    let toAnimate = [
      ...document.querySelectorAll(`#${tabId} h5`),
      ...document.querySelectorAll(`#${tabId} h6`),
      ...document.querySelectorAll(`#${tabId} .accordion-btn`),
      ...document.querySelectorAll(".s-2"),
    ];

    toAnimate.forEach((el) => {
      gsap.fromTo(el, from, {
        scrollTrigger: {
          trigger: el,
          scroller: document.querySelector("#main"),
          ...st,
        },
        ...to,
      });
    });

    gsap.fromTo(".s-1 button", from, {
      scrollTrigger: {
        scroller: document.querySelector("#main"),
        trigger: ".s-1",
        ...st,
      },
      ...to,
    });
  }

  setAnimations() {
    let tl = gsap.timeline().pause();
    this.tl = tl;

    tl.fromTo(
      ".a-1",
      {
        opacity: 0,
        y: 144,
      },
      {
        opacity: 1,
        y: 0,
        stagger: 0.2,
        duration: 0.8,
        delay: 0.2,
      },
    );
  }

  addEventListeners() {
    document.addEventListener("DOMContentLoaded", () => {
      const tabButtons = document.querySelectorAll(".tab-btn");
      const tabContents = document.querySelectorAll(".tab-pane");

      tabButtons.forEach((button) => {
        button.addEventListener("click", () => {
          const targetId = button.getAttribute("data-target");

          tabContents.forEach((content) => {
            if (content.id === targetId) {
              content.classList.add("active");
            } else {
              content.classList.remove("active");
            }
          });

          tabButtons.forEach((btn) => {
            if (btn === button) {
              btn.classList.add("active");
            } else {
              btn.classList.remove("active");
            }
          });

          this.setScrollAnimations(targetId);
        });
      });
    });

    document.addEventListener("DOMContentLoaded", function () {
      const accordionBtns = document.querySelectorAll(".accordion-btn");

      accordionBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
          const content = btn.nextElementSibling;
          const activeContents = document.querySelectorAll(
            ".accordion-content.active",
          );

          activeContents.forEach((activeContent) => {
            if (activeContent !== content) {
              activeContent.classList.remove("active");
            }
          });

          content.classList.toggle("active");
        });
      });
    });

    document.addEventListener("DOMContentLoaded", () => {
      this.tl.play();
    });
  }
}
