import Common from "../common/Common.js";
import gsap from "../../node_modules/gsap/all.js";

export default class Home {
  constructor() {
    this.common = new Common();

    this.setAnimations();
    this.addEventListeners();
  }

  setAnimations() {
    let tl = gsap.timeline().pause();
    this.tl = tl;

    tl.to("body", {
      opacity: 1,
      duration: 0.4,
    });

    tl.fromTo(
      ".page .el-1",
      {
        opacity: 0,
        y: 144,
      },
      {
        opacity: 1,
        y: 0,
        stagger: 0.2,
        duration: 0.6,
        delay: 0.2,
      },
    );
  }

  addEventListeners() {
    document.addEventListener("DOMContentLoaded", () => {
      this.tl.play();
    });
  }
}
