import Effect from "./Effect.js";
import Common from "../common/Common.js";
import gsap from "../../node_modules/gsap/all.js";
import ScrollTrigger from "gsap/ScrollTrigger";
import Canvas from "./Canvas.js";
gsap.registerPlugin(ScrollTrigger);

export default class OurJourney {
  constructor() {
    this.common = new Common();

    this.setSlides();
    this.setCanvas();

    this.setFunctions(); // Moving from html file

    this.setPopups();

    this.setAnimations();
    this.addEventListeners();
  }

  setSlides() {
    let sliderContainer = document.querySelector("#journey-slides");

    let slides = [
      {
        imageUrl: "/journey2.jpg",
        mobileUrl: "/journey2-mobile.jpg",
        title: "Fresh from <br /> the Farm",
        cta: "Our Farm Story",
        id: "farm",
      },
      {
        imageUrl: "/journey3.jpg",
        mobileUrl: "/journey3-mobile.jpg",
        title: "Organically <br /> Grown",
        cta: "Our Garden Story",
        id: "garden",
      },
      {
        imageUrl: "/journey4.jpg",
        mobileUrl: "/journey4-mobile.jpg",
        title: "Specially for <br /> You",
        cta: "Our Kitchen’s Treat",
        id: "kitchen",
      },
      {
        imageUrl: "/journey5.jpg",
        mobileUrl: "/journey5-mobile.jpg",
        title: "Get your <br /> Table",
        cta: "Reserve Now",
        id: "reserve",
      },
    ];

    slides.forEach((slide) => {
      sliderContainer.innerHTML += this.createSlide(slide);
    });

    this.sliderState = {
      slideCount: slides.length + 1,
      current: 0,
      progress: 0.5,
      transformX: 0,
      total: 0.5,
      animating: false,
      titles: [],
      timelines: [],
      container: sliderContainer,
    };

    document.querySelectorAll(".slide-title").forEach((title) => {
      this.sliderState.titles.push(this.getTitleInfo(title));
    });

    this.journeyTl = gsap.timeline();
    this.sliderTl = gsap.timeline();

    this.setTimelines();
  }

  createSlide({ imageUrl, mobileUrl, title, cta, id }) {
    return `
      <!-- Journey slide -->
      <div class="journey-slide">
        <!-- Background -->
        <div class="bg absolute inset-0">
          <img
            src="${imageUrl}"
            class="h-full w-full object-cover"
            data-mobile-src="${mobileUrl}"
          />
        </div>

        <!-- Info -->
        <div class="container mx-auto flex items-center justify-between p-4 md:p-6 lg:pt-6 xl:pt-4 2xl:pt-6 z-50">
          <div
            class="flex w-full flex-col items-center gap-y-4 lg:w-1/2 lg:items-start xl:w-3/5"
          >
            <!-- Title -->
            <h1
              class="slide-title w-full text-center text-[3.5rem] leading-[1.2] text-[#E5D6B3] md:text-[5rem] lg:text-left lg:text-[6rem] xl:text-[6.5rem] xl:tracking-wide 2xl:text-[8rem]"
            >
              ${title}
            </h1>
            <a
              href="${id == "reserve" ? "/reservation/" : "#"}"
              id= "${id}"
              class="sub-1 relative w-fit cursor-pointer text-lg text-[#FF1F00] transition hover:scale-105 lg:pl-2 lg:text-3xl xl:text-3xl 2xl:text-4xl"
            >
              ${cta}
              <img src="/click-me-cta.png" class="click-icon absolute top-full left-full w-32" />
            </a>
          </div>
        </div>
      </div>
    `;
  }

  setTimelines() {
    let slides = document.querySelectorAll(".journey-slide");
    let canvas = document.querySelector("#text-canvas");
    slides.forEach((slide, index) => {
      let tl = gsap.timeline().pause();

      // tl.to(slides, { duration: 1 });

      tl.fromTo(
        slide.querySelector(".bg"),
        { opacity: 0 },
        {
          opacity: 1,
          duration: 1,
        },
      );

      let particles = {
        progress: 0,
      };

      tl.to(
        particles,
        {
          progress: 1,
          duration: 1,
          onUpdate: () => {
            this.canvas.drawParticles(index, particles.progress);
            // canvas.style.opacity = particles.progress;
          },
        },
        "<",
      );

      tl.to(
        canvas,
        {
          opacity: 1,
          duration: 1,
        },
        "<",
      );

      tl.fromTo(
        slide.querySelector(".sub-1"),
        { opacity: 0 },
        {
          duration: 1,
          opacity: 1,
        },
      );

      if (index > 0) {
        tl.fromTo(
          slide.querySelector(".click-icon"),
          {
            clipPath: "inset(0 100% 0 0)",
          },
          {
            clipPath: "inset(0 1% 0 0)",
          },
          "<",
        );
      }

      // tl.to(slides, {});

      // Second half

      tl.to(slide.querySelector(".sub-1"), {
        opacity: 0,
        duration: 1,
      });

      if (index > 0) {
        tl.to(
          slide.querySelector(".click-icon"),
          {
            clipPath: "inset(0 100% 0 0)",
          },
          "<",
        );
      }

      tl.to(particles, {
        progress: 0,
        duration: 1,
        onUpdate: () => {
          this.canvas.drawParticles(index, particles.progress);
          // canvas.style.opacity = particles.progress;
        },
      });

      tl.to(
        canvas,
        {
          opacity: 0,
          duration: 1,
        },
        "<",
      );

      tl.to(slide.querySelector(".bg"), { opacity: 0, duration: 1 });

      this.sliderState.timelines.push(tl);
    });
  }

  animateSlides(to) {
    if (this.sliderState.animating) {
      return;
    }

    this.sliderState.animating = true;

    let duration = 1.2;

    this.journeyTl.to("#journey-slides", {
      // x: `-${to * 100}%`,
      opacity: 0,
      duration,
    });

    let particleFirst = {
      progress: 1,
    };

    this.journeyTl.to(
      particleFirst,
      {
        progress: 0,
        duration,
        onUpdate: () => {
          document.querySelector("#text-canvas").style.opacity =
            particleFirst.progress;
          this.canvas.drawParticles(
            this.sliderState.current,
            particleFirst.progress,
          );
        },
      },
      "<",
    );

    this.journeyTl.to("#journey-slides", {
      x: `-${to * 100}%`,
      duration: 0.01,
      ease: "linear",
    });

    this.journeyTl.to("#journey-slides", {
      opacity: 1,
      duration,
      onComplete: () => {
        this.sliderState.current = to;
        this.sliderState.animating = false;
        this.common.resetNav();
      },
    });

    let particleSecond = {
      progress: 0,
    };

    this.journeyTl.to(
      particleSecond,
      {
        progress: 1,
        duration,
        onUpdate: () => {
          document.querySelector("#text-canvas").style.opacity =
            particleSecond.progress;
          this.canvas.drawParticles(to, particleSecond.progress);
        },
      },
      "<",
    );
  }

  animateSlides1(to, instant = false) {
    if (this.sliderState.animating) {
      return;
    }

    if (!this.loaded) {
      return;
    }

    this.sliderState.animating = true;
    let duration = instant ? 0.001 : 0.8;

    this.sliderTl.to(this.sliderState, {
      total: to,
      duration,
      ease: "power1.inOut",
      onUpdate: () => {
        let current = Math.floor(this.sliderState.total);
        let progress = this.sliderState.total % 1;

        if (current == 5) {
          return;
        }

        this.sliderState.container.style.transform = `translateX(-${current * 100}%)`;

        this.sliderState.timelines[current].progress(progress);
      },
      onComplete: () => {
        this.sliderState.animating = false;
      },
    });
  }

  setFunctions() {
    window.toggleDropdown = function () {
      var dropdownMenu = document.getElementById("dropdownMenu");
      dropdownMenu.classList.toggle("hidden");
    };

    window.selectOption = function (option) {
      var selectedOption = document.getElementById("selectedOption");
      selectedOption.textContent = option;
      toggleDropdown();
    };
  }

  setPopups() {
    this.setPopup1();
    this.setPopup2();
    this.setPopup3();
  }

  setPopup1() {
    // Particles
    let p = document.querySelector("#popup-1 .popup-slides");
    let c1 = document.querySelector("#popup-1 .c-1");
    c1.width = p.getBoundingClientRect().width;
    c1.height = p.getBoundingClientRect().height;

    let effect1 = new Effect(
      "#popup-1 .c-1",
      "/tomahawk_p.png",
      "/wooden-background.png",
    );
    let effect2 = new Effect(
      "#popup-1 .c-2",
      "/OPrib_p.png",
      "/wooden-background.png",
    );
    let effect3 = new Effect(
      "#popup-1 .c-3",
      "/wagyu_p.png",
      "/wooden-background.png",
    );

    // Scroll animations
    this.popupHeight = p.getBoundingClientRect().height;

    let mm = gsap.matchMedia();

    // Slide 1
    let tl1 = gsap.timeline();

    mm.add("(max-width: 1023px)", () => {
      tl1.to(p.querySelectorAll(".s-1 .el-1"), {
        height: "50%",
      });

      tl1.from(
        p.querySelectorAll(".s-1 .el-2"),
        {
          y: 72,
          opacity: 0,
          stagger: 0.05,
        },
        "<",
      );
    });

    mm.add("(min-width: 1024px)", () => {
      tl1.to(p.querySelectorAll(".s-1 .el-1"), {
        width: "50%",
      });

      tl1.from(p.querySelectorAll(".s-1 .el-2"), {
        y: 72,
        opacity: 0,
        stagger: 0.05,
      });
    });

    tl1.to(p.querySelectorAll(".s-1"), {});

    tl1.to(p.querySelectorAll(".s-1"), {
      opacity: 0,
    });

    let st1 = ScrollTrigger.create({
      animation: tl1,
      scroller: "#popup-1 .popup-slides",
      trigger: "#popup-1 .s-1",
      start: "top top",
      end: "+=200%",
      pin: true,
      scrub: 0.8,
      onLeave: () => {
        p.scroll(0, this.popupHeight * 3);
      },
    });

    // Slide 2
    let tl2 = gsap.timeline();
    let from2 = { y: 256, opacity: 0, delay: 0.1 };
    let to2 = { y: -256, opacity: 0, delay: 0.1 };

    mm.add("(max-width: 1023px)", () => {
      tl2.from(p.querySelectorAll(".s-2 .rel-1"), { ...from2, stagger: 0.1 });

      tl2.from(p.querySelectorAll(".s-2 .rel-2"), { ...from2, stagger: 0.1 });
      tl2.from(p.querySelectorAll(".s-2 .rel-3"), { ...from2, stagger: 0.1 });
      tl2.to(p.querySelectorAll(".s-2 .rel-c"), { y: -160 });
      tl2.to(p.querySelectorAll(".s-2 .rel-2"), { opacity: 0 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .rel-4"), { ...from2, stagger: 0.1 });
      tl2.to(p.querySelectorAll(".s-2 .rel-c"), { y: -320 });
      tl2.to(p.querySelectorAll(".s-2 .rel-3"), { opacity: 0 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .rel-5"), { ...from2, stagger: 0.1 });
      // tl2.to(".s-2 .rel-2", { ...to2, stagger: 0.1 });
      // tl2.to(".s-2 .rel-3", { ...to2, stagger: 0.1 }, "<");

      tl2.to(p.querySelectorAll(".s-2"), {});

      tl2.to(p.querySelectorAll(".s-2"), {
        opacity: 0,
      });
    });

    mm.add("(min-width: 1024px)", () => {
      tl2.from(p.querySelectorAll(".s-2 .el-1"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .el-2"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .img-1"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-3"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .img-3"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-4"), { ...from2 });
      tl2.to(p.querySelectorAll(".s-2 .img-1"), { top: "-10%" }, "<");
      tl2.from(p.querySelectorAll(".s-2 .img-2"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-5"), { ...from2 });
      tl2.to(p.querySelectorAll(".s-2 .img-3"), { top: "-10%" }, "<");
      tl2.from(p.querySelectorAll(".s-2 .img-4"), { ...from2 }, "<");
      // tl2.from(".s-2 .el-6", { ...from2 }, "<");
      tl2.to(p.querySelectorAll(".s-2"), {});
      tl2.to(p.querySelectorAll(".s-2"), { opacity: 0 });
      tl2.to(p.querySelectorAll(".s-2 .img-1"), { top: "-40%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-2"), { top: "-20%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-3"), { top: "-40%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-4"), { top: "-20%" }, "<");
    });

    let st2 = ScrollTrigger.create({
      animation: tl2,
      scroller: "#popup-1 .popup-slides",
      trigger: "#popup-1 .s-2",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 2);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 8);
      },
    });

    // Slide 3
    let tl3 = gsap.timeline();

    tl3.from(p.querySelectorAll(".s-3"), {
      opacity: 0,
      delay: 0.2,
    });

    tl3.from(p.querySelectorAll(".s-3 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    tl3.to(p.querySelectorAll(".s-3"), {});
    tl3.to(p.querySelectorAll(".s-3"), {});

    tl3.to(p.querySelectorAll(".s-3"), {
      opacity: 0,
    });

    let st3 = ScrollTrigger.create({
      animation: tl3,
      scroller: "#popup-1 .popup-slides",
      trigger: "#popup-1 .s-3",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 1.2,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 7);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 13);
      },
      onUpdate: (self) => {
        effect1.render(self.progress);
      },
    });

    // Slide 4
    let tl4 = gsap.timeline();

    tl4.from(p.querySelectorAll(".s-4"), {
      opacity: 0,
    });

    tl4.from(p.querySelectorAll(".s-4 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    tl4.to(p.querySelectorAll(".s-4"), {});

    tl4.to(p.querySelectorAll(".s-4"), {
      opacity: 0,
    });

    let st4 = ScrollTrigger.create({
      animation: tl4,
      scroller: "#popup-1 .popup-slides",
      trigger: "#popup-1 .s-4",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 12);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 18);
      },
      onUpdate: (self) => {
        effect2.render(self.progress);
      },
    });

    // Slide 5
    let tl5 = gsap.timeline();

    tl5.from(p.querySelectorAll(".s-5"), {
      opacity: 0,
    });

    tl5.from(p.querySelectorAll(".s-5 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    tl5.to(p.querySelectorAll(".s-5"), {});

    tl5.to(p.querySelectorAll(".s-5"), {
      opacity: 0,
    });

    let st5 = ScrollTrigger.create({
      animation: tl5,
      scroller: "#popup-1 .popup-slides",
      trigger: "#popup-1 .s-5",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 17);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 23);
      },
      onUpdate: (self) => {
        effect3.render(self.progress);
      },
    });

    // Slide 6
    let tl6 = gsap.timeline();

    tl6.from(p.querySelectorAll(".s-6 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    let st6 = ScrollTrigger.create({
      animation: tl6,
      scroller: "#popup-1 .popup-slides",
      trigger: "#popup-1 .s-6",
      start: "top top",
      end: "+=250%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 22);
      },
    });

    // Progress bar
    let stage = 0;
    let animating = false;

    let stage1Tl = gsap.timeline().pause();

    stage1Tl.to("#popup-1 #stage-1", {
      opacity: 0,
      pointerEvents: "none",
      onStart: () => {
        animating = true;
      },
    });

    stage1Tl.to(
      "#popup-1 #progress-line",
      {
        width: "50%",
      },
      "<",
    );

    stage1Tl.to("#popup-1 #p-1", {
      backgroundColor: "#f6c859",
    });

    stage1Tl.to("#popup-1 #stage-2", {
      opacity: 1,
      pointerEvents: "auto",
      onComplete: () => {
        animating = false;
      },
    });

    let stage2Tl = gsap.timeline().pause();

    stage2Tl.to("#popup-1 #stage-2", {
      opacity: 0,
      pointerEvents: "none",
      onStart: () => {
        animating = true;
      },
    });

    stage2Tl.to(
      "#popup-1 .form-button",
      {
        opacity: 0,
        pointerEvents: "none",
      },
      "<",
    );

    stage2Tl.to(
      "#popup-1 #previous-button",
      {
        opacity: 0,
        pointerEvents: "none",
      },
      "<",
    );

    stage2Tl.to(
      "#popup-1 #progress-line",
      {
        width: "100%",
      },
      "<",
    );

    stage2Tl.to("#popup-1 #p-2", {
      backgroundColor: "#f6c859",
    });

    stage2Tl.to("#popup-1 #stage-3", {
      opacity: 1,
      pointerEvents: "auto",
      onComplete: () => {
        animating = false;
      },
    });

    // let stage3Tl = gsap.timeline().pause();

    // stage3Tl.to("#popup-1 #stage-3", {
    //   opacity: 0,
    //   pointerEvents: "none",
    //   onStart: () => {
    //     animating = true;
    //   },
    // });

    // stage3Tl.to(
    //   "#popup-1 .form-button",
    //   {
    //     opacity: 0,
    //     pointerEvents: "none",
    //   },
    //   "<",
    // );

    // stage3Tl.to(
    //   "#popup-1 #progress-line",
    //   {
    //     width: "100%",
    //   },
    //   "<",
    // );

    // stage3Tl.to("#popup-1 #p-3", {
    //   backgroundColor: "#f6c859",
    // });

    // stage3Tl.to(
    //   "#popup-1 #stage-4",
    //   {
    //     opacity: 1,
    //     pointerEvents: "auto",
    //     onComplete: () => {
    //       animating = false;
    //     },
    //   },
    //   "<",
    // );

    let button = document.querySelector("#popup-1 .form-button");
    button.addEventListener("click", (e) => {
      e.preventDefault();

      if (animating) {
        return;
      }

      stage++;
      if (stage == 1) {
        stage1Tl.play();
      } else if (stage == 2) {
        stage2Tl.play();
      } else if (stage == 3) {
        stage3Tl.play();
      }
    });

    let stagebutton2 = document.querySelector("#popup-1 #stage-2-button");
    stagebutton2.addEventListener("click", (e) => {
      e.preventDefault();
      stage2Tl.play();
    });

    let previousbutton = document.querySelector("#popup-1 #previous-button");
    previousbutton.addEventListener("click", (e) => {
      e.preventDefault();
      stage1Tl.reverse();
    });
  }

  setPopup2() {
    // Particles
    let p = document.querySelector("#popup-2 .popup-slides");
    let c1 = document.querySelector("#popup-2 .c-1");
    c1.width = p.getBoundingClientRect().width;
    c1.height = p.getBoundingClientRect().height;

    let effect1 = new Effect(
      "#popup-2 .c-1",
      "/lasanga-v4.png",
      "/Lasanga-plate.png",
    );

    let mm = gsap.matchMedia();

    // Slide 1
    let tl1 = gsap.timeline();

    mm.add("(max-width: 1023px)", () => {
      tl1.to(p.querySelectorAll(".s-1 .el-1"), {
        height: "50%",
      });

      tl1.from(
        p.querySelectorAll(".s-1 .el-2"),
        {
          y: 72,
          opacity: 0,
          stagger: 0.05,
        },
        "<",
      );
    });

    mm.add("(min-width: 1024px)", () => {
      tl1.to(p.querySelectorAll(".s-1 .el-1"), {
        width: "50%",
      });

      tl1.from(p.querySelectorAll(".s-1 .el-2"), {
        y: 72,
        opacity: 0,
        stagger: 0.05,
      });
    });

    tl1.to(p.querySelectorAll(".s-1"), {});

    tl1.to(p.querySelectorAll(".s-1"), {
      opacity: 0,
    });

    let st1 = ScrollTrigger.create({
      animation: tl1,
      scroller: "#popup-2 .popup-slides",
      trigger: "#popup-2 .s-1",
      start: "top top",
      end: "+=200%",
      pin: true,
      scrub: 0.8,
      onLeave: () => {
        p.scroll(0, this.popupHeight * 3);
      },
    });

    // Slide 2
    let tl2 = gsap.timeline();
    let from2 = { y: 256, opacity: 0, delay: 0.1 };
    let to2 = { y: -256, opacity: 0, delay: 0.1 };

    mm.add("(max-width: 1023px)", () => {
      tl2.from(p.querySelectorAll(".s-2 .rel-1"), { ...from2, stagger: 0.1 });

      tl2.from(p.querySelectorAll(".s-2 .rel-2"), { ...from2, stagger: 0.1 });
      tl2.from(p.querySelectorAll(".s-2 .rel-3"), { ...from2, stagger: 0.1 });
      tl2.to(p.querySelectorAll(".s-2 .rel-c"), { y: -160 });
      tl2.to(p.querySelectorAll(".s-2 .rel-2"), { opacity: 0 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .rel-4"), { ...from2, stagger: 0.1 });
      tl2.to(p.querySelectorAll(".s-2 .rel-c"), { y: -320 });
      tl2.to(p.querySelectorAll(".s-2 .rel-3"), { opacity: 0 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .rel-5"), { ...from2, stagger: 0.1 });
      // tl2.to(".s-2 .rel-2", { ...to2, stagger: 0.1 });
      // tl2.to(".s-2 .rel-3", { ...to2, stagger: 0.1 }, "<");

      tl2.to(p.querySelectorAll(".s-2"), {});

      tl2.to(p.querySelectorAll(".s-2"), {
        opacity: 0,
      });
    });

    mm.add("(min-width: 1024px)", () => {
      tl2.from(p.querySelectorAll(".s-2 .el-1"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .el-2"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .img-1"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-3"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .img-3"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-4"), { ...from2 });
      tl2.to(p.querySelectorAll(".s-2 .img-1"), { top: "-10%" }, "<");
      tl2.from(p.querySelectorAll(".s-2 .img-2"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-5"), { ...from2 });
      tl2.to(p.querySelectorAll(".s-2 .img-3"), { top: "-10%" }, "<");
      tl2.from(p.querySelectorAll(".s-2 .img-4"), { ...from2 }, "<");
      // tl2.from(".s-2 .el-6", { ...from2 }, "<");
      tl2.to(p.querySelectorAll(".s-2"), {});
      tl2.to(p.querySelectorAll(".s-2"), { opacity: 0 });
      tl2.to(p.querySelectorAll(".s-2 .img-1"), { top: "-40%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-2"), { top: "-20%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-3"), { top: "-40%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-4"), { top: "-20%" }, "<");
    });

    let st2 = ScrollTrigger.create({
      animation: tl2,
      scroller: "#popup-2 .popup-slides",
      trigger: "#popup-2 .s-2",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 2);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 8);
      },
    });

    // Slide 3
    let tl3 = gsap.timeline();

    tl3.from(p.querySelectorAll(".s-3"), {
      opacity: 0,
      delay: 0.2,
    });

    tl3.from(p.querySelectorAll(".s-3 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    tl3.to(p.querySelectorAll(".s-3"), {});
    tl3.to(p.querySelectorAll(".s-3"), {});

    tl3.to(p.querySelectorAll(".s-3"), {
      opacity: 0,
    });

    let st3 = ScrollTrigger.create({
      animation: tl3,
      scroller: "#popup-2 .popup-slides",
      trigger: "#popup-2 .s-3",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 1.2,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 7);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 13);
      },
      onUpdate: (self) => {
        effect1.render(self.progress);
      },
    });

    // Slide 4
    let tl4 = gsap.timeline();

    tl4.from(p.querySelectorAll(".s-4 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    let st4 = ScrollTrigger.create({
      animation: tl4,
      scroller: "#popup-2 .popup-slides",
      trigger: "#popup-2 .s-4",
      start: "top top",
      end: "+=250%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 12);
      },
    });

    // Progress bar
    let stage = 0;
    let animating = false;

    let stage1Tl = gsap.timeline().pause();

    stage1Tl.to("#popup-2 #stage-1", {
      opacity: 0,
      pointerEvents: "none",
      onStart: () => {
        animating = true;
      },
    });

    stage1Tl.to(
      "#popup-2 #progress-line",
      {
        width: "50%",
      },
      "<",
    );

    stage1Tl.to("#popup-2 #p-1", {
      backgroundColor: "#f6c859",
    });

    stage1Tl.to("#popup-2 #stage-2", {
      opacity: 1,
      pointerEvents: "auto",
      onComplete: () => {
        animating = false;
      },
    });

    let stage2Tl = gsap.timeline().pause();

    stage2Tl.to("#popup-2 #stage-2", {
      opacity: 0,
      pointerEvents: "none",
      onStart: () => {
        animating = true;
      },
    });

    stage2Tl.to(
      "#popup-2 #progress-line",
      {
        width: "100%",
      },
      "<",
    );

    stage2Tl.to("#popup-2 #p-2", {
      backgroundColor: "#f6c859",
    });

    stage2Tl.to("#popup-2 #stage-3", {
      opacity: 1,
      pointerEvents: "auto",
      onComplete: () => {
        animating = false;
      },
    });

    // let stage3Tl = gsap.timeline().pause();

    // stage3Tl.to("#popup-2 #stage-3", {
    //   opacity: 0,
    //   pointerEvents: "none",
    //   onStart: () => {
    //     animating = true;
    //   },
    // });

    // stage3Tl.to(
    //   "#popup-2 .form-button",
    //   {
    //     opacity: 0,
    //     pointerEvents: "none",
    //   },
    //   "<",
    // );

    // stage3Tl.to(
    //   "#popup-2 #progress-line",
    //   {
    //     width: "100%",
    //   },
    //   "<",
    // );

    // stage3Tl.to("#popup-2 #p-3", {
    //   backgroundColor: "#f6c859",
    // });

    // stage3Tl.to(
    //   "#popup-2 #stage-4",
    //   {
    //     opacity: 1,
    //     pointerEvents: "auto",
    //     onComplete: () => {
    //       animating = false;
    //     },
    //   },
    //   "<",
    // );

    let button = document.querySelector("#popup-2 .form-button");
    button.addEventListener("click", (e) => {
      e.preventDefault();

      if (animating) {
        return;
      }

      stage++;
      if (stage == 1) {
        stage1Tl.play();
      } else if (stage == 2) {
        stage2Tl.play();
      } else if (stage == 3) {
        stage3Tl.play();
      }
    });

    let stagebutton2 = document.querySelector("#popup-2 #stage-2-button");
    stagebutton2.addEventListener("click", (e) => {
      e.preventDefault();
      stage2Tl.play();
    });

    let previousbutton = document.querySelector("#popup-2 #previous-button");
    previousbutton.addEventListener("click", (e) => {
      e.preventDefault();
      stage1Tl.reverse();
    });
  }

  setPopup3() {
    // Particles
    let p = document.querySelector("#popup-3 .popup-slides");
    let c1 = document.querySelector("#popup-3 .c-1");
    c1.width = p.getBoundingClientRect().width;
    c1.height = p.getBoundingClientRect().height;

    let effect1 = new Effect(
      "#popup-3 .c-1",
      "/cream-brulee.png",
      "/cream-brulee-bg.jpg",
    );
    // let effect2 = new Effect(
    //   "#popup-3 .c-2",
    //   "/OPrib_p.png",
    //   "/wooden-background.png",
    // );
    // let effect3 = new Effect(
    //   "#popup-3 .c-3",
    //   "/wagyu_p.png",
    //   "/wooden-background.png",
    // );

    // Scroll animations
    this.popupHeight = p.getBoundingClientRect().height;

    let mm = gsap.matchMedia();

    // Slide 1
    let tl1 = gsap.timeline();

    mm.add("(max-width: 1023px)", () => {
      tl1.to(p.querySelectorAll(".s-1 .el-1"), {
        height: "50%",
      });

      tl1.from(
        p.querySelectorAll(".s-1 .el-2"),
        {
          y: 72,
          opacity: 0,
          stagger: 0.05,
        },
        "<",
      );
    });

    mm.add("(min-width: 1024px)", () => {
      tl1.to(p.querySelectorAll(".s-1 .el-1"), {
        width: "50%",
      });

      tl1.from(p.querySelectorAll(".s-1 .el-2"), {
        y: 72,
        opacity: 0,
        stagger: 0.05,
      });
    });

    tl1.to(p.querySelectorAll(".s-1"), {});

    tl1.to(p.querySelectorAll(".s-1"), {
      opacity: 0,
    });

    let st1 = ScrollTrigger.create({
      animation: tl1,
      scroller: "#popup-3 .popup-slides",
      trigger: "#popup-3 .s-1",
      start: "top top",
      end: "+=200%",
      pin: true,
      scrub: 0.8,
      onLeave: () => {
        p.scroll(0, this.popupHeight * 3);
      },
    });

    // Slide 2
    let tl2 = gsap.timeline();
    let from2 = { y: 256, opacity: 0, delay: 0.1 };
    let to2 = { y: -256, opacity: 0, delay: 0.1 };

    mm.add("(max-width: 1023px)", () => {
      tl2.from(p.querySelectorAll(".s-2 .rel-1"), { ...from2, stagger: 0.1 });

      tl2.from(p.querySelectorAll(".s-2 .rel-2"), { ...from2, stagger: 0.1 });
      tl2.from(p.querySelectorAll(".s-2 .rel-3"), { ...from2, stagger: 0.1 });
      tl2.to(p.querySelectorAll(".s-2 .rel-c"), { y: -160 });
      tl2.to(p.querySelectorAll(".s-2 .rel-2"), { opacity: 0 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .rel-4"), { ...from2, stagger: 0.1 });
      tl2.to(p.querySelectorAll(".s-2 .rel-c"), { y: -320 });
      tl2.to(p.querySelectorAll(".s-2 .rel-3"), { opacity: 0 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .rel-5"), { ...from2, stagger: 0.1 });
      // tl2.to(".s-2 .rel-2", { ...to2, stagger: 0.1 });
      // tl2.to(".s-2 .rel-3", { ...to2, stagger: 0.1 }, "<");

      tl2.to(p.querySelectorAll(".s-2"), {});

      tl2.to(p.querySelectorAll(".s-2"), {
        opacity: 0,
      });
    });

    mm.add("(min-width: 1024px)", () => {
      tl2.from(p.querySelectorAll(".s-2 .el-1"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .el-2"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .img-1"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-3"), { ...from2 });
      tl2.from(p.querySelectorAll(".s-2 .img-3"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-4"), { ...from2 });
      tl2.to(p.querySelectorAll(".s-2 .img-1"), { top: "-10%" }, "<");
      tl2.from(p.querySelectorAll(".s-2 .img-2"), { ...from2 }, "<");
      tl2.from(p.querySelectorAll(".s-2 .el-5"), { ...from2 });
      tl2.to(p.querySelectorAll(".s-2 .img-3"), { top: "-10%" }, "<");
      tl2.from(p.querySelectorAll(".s-2 .img-4"), { ...from2 }, "<");
      // tl2.from(".s-2 .el-6", { ...from2 }, "<");
      tl2.to(p.querySelectorAll(".s-2"), {});
      tl2.to(p.querySelectorAll(".s-2"), { opacity: 0 });
      tl2.to(p.querySelectorAll(".s-2 .img-1"), { top: "-40%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-2"), { top: "-20%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-3"), { top: "-40%" }, "<");
      tl2.to(p.querySelectorAll(".s-2 .img-4"), { top: "-20%" }, "<");
    });

    let st2 = ScrollTrigger.create({
      animation: tl2,
      scroller: "#popup-3 .popup-slides",
      trigger: "#popup-3 .s-2",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 2);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 8);
      },
    });

    // Slide 3
    let tl3 = gsap.timeline();

    tl3.from(p.querySelectorAll(".s-3"), {
      opacity: 0,
      delay: 0.2,
    });

    tl3.from(p.querySelectorAll(".s-3 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    tl3.to(p.querySelectorAll(".s-3"), {});
    tl3.to(p.querySelectorAll(".s-3"), {});

    tl3.to(p.querySelectorAll(".s-3"), {
      opacity: 0,
    });

    let st3 = ScrollTrigger.create({
      animation: tl3,
      scroller: "#popup-3 .popup-slides",
      trigger: "#popup-3 .s-3",
      start: "top top",
      end: "+=400%",
      pin: true,
      scrub: 1.2,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 7);
      },
      onLeave: () => {
        p.scroll(0, this.popupHeight * 13);
      },
      onUpdate: (self) => {
        effect1.render(self.progress);
      },
    });

    // Slide 4
    let tl4 = gsap.timeline();

    // tl4.from(p.querySelectorAll(".s-4"), {
    //   opacity: 0,
    // });

    tl4.from(p.querySelectorAll(".s-4 .el-1"), {
      y: 72,
      opacity: 0,
      stagger: 0.1,
    });

    // tl4.to(p.querySelectorAll(".s-4"), {});

    // tl4.to(p.querySelectorAll(".s-4"), {
    //   opacity: 0,
    // });

    let st4 = ScrollTrigger.create({
      animation: tl4,
      scroller: "#popup-3 .popup-slides",
      trigger: "#popup-3 .s-4",
      start: "top top",
      end: "+=250%",
      pin: true,
      scrub: 0.8,
      onLeaveBack: () => {
        p.scroll(0, this.popupHeight * 12);
      },
      // onLeave: () => {
      //   p.scroll(0, this.popupHeight * 18);
      // },
      // onUpdate: (self) => {
      //   effect2.render(self.progress);
      // },
    });

    // Slide 5
    // let tl5 = gsap.timeline();

    // tl5.from(p.querySelectorAll(".s-5"), {
    //   opacity: 0,
    // });

    // tl5.from(p.querySelectorAll(".s-5 .el-1"), {
    //   y: 72,
    //   opacity: 0,
    //   stagger: 0.1,
    // });

    // tl5.to(p.querySelectorAll(".s-5"), {});

    // tl5.to(p.querySelectorAll(".s-5"), {
    //   opacity: 0,
    // });

    // let st5 = ScrollTrigger.create({
    //   animation: tl5,
    //   scroller: "#popup-3 .popup-slides",
    //   trigger: "#popup-3 .s-5",
    //   start: "top top",
    //   end: "+=400%",
    //   pin: true,
    //   scrub: 0.8,
    //   onLeaveBack: () => {
    //     p.scroll(0, this.popupHeight * 17);
    //   },
    //   onLeave: () => {
    //     p.scroll(0, this.popupHeight * 23);
    //   },
    //   onUpdate: (self) => {
    //     effect3.render(self.progress);
    //   },
    // });

    // Slide 6
    // let tl6 = gsap.timeline();

    // tl6.from(p.querySelectorAll(".s-6 .el-1"), {
    //   y: 72,
    //   opacity: 0,
    //   stagger: 0.1,
    // });

    // let st6 = ScrollTrigger.create({
    //   animation: tl6,
    //   scroller: "#popup-3 .popup-slides",
    //   trigger: "#popup-3 .s-6",
    //   start: "top top",
    //   end: "+=250%",
    //   pin: true,
    //   scrub: 0.8,
    //   onLeaveBack: () => {
    //     p.scroll(0, this.popupHeight * 22);
    //   },
    // });

    // Progress bar
    let stage = 0;
    let animating = false;

    let stage1Tl = gsap.timeline().pause();

    stage1Tl.to("#popup-3 #stage-1", {
      opacity: 0,
      pointerEvents: "none",
      onStart: () => {
        animating = true;
      },
    });

    stage1Tl.to(
      "#popup-3 #progress-line",
      {
        width: "50%",
      },
      "<",
    );

    stage1Tl.to("#popup-3 #p-1", {
      backgroundColor: "#f6c859",
    });

    stage1Tl.to("#popup-3 #stage-2", {
      opacity: 1,
      pointerEvents: "auto",
      onComplete: () => {
        animating = false;
      },
    });

    let stage2Tl = gsap.timeline().pause();

    stage2Tl.to("#popup-3 #stage-2", {
      opacity: 0,
      pointerEvents: "none",
      onStart: () => {
        animating = true;
      },
    });

    stage2Tl.to(
      "#popup-3 #progress-line",
      {
        width: "100%",
      },
      "<",
    );

    stage2Tl.to("#popup-3 #p-2", {
      backgroundColor: "#f6c859",
    });

    stage2Tl.to("#popup-3 #stage-3", {
      opacity: 1,
      pointerEvents: "auto",
      onComplete: () => {
        animating = false;
      },
    });

    // let stage3Tl = gsap.timeline().pause();

    // stage3Tl.to("#popup-3 #stage-3", {
    //   opacity: 0,
    //   pointerEvents: "none",
    //   onStart: () => {
    //     animating = true;
    //   },
    // });

    // stage3Tl.to(
    //   "#popup-3 .form-button",
    //   {
    //     opacity: 0,
    //     pointerEvents: "none",
    //   },
    //   "<",
    // );

    // stage3Tl.to(
    //   "#popup-3 #progress-line",
    //   {
    //     width: "100%",
    //   },
    //   "<",
    // );

    // stage3Tl.to("#popup-3 #p-3", {
    //   backgroundColor: "#f6c859",
    // });

    // stage3Tl.to(
    //   "#popup-3 #stage-4",
    //   {
    //     opacity: 1,
    //     pointerEvents: "auto",
    //     onComplete: () => {
    //       animating = false;
    //     },
    //   },
    //   "<",
    // );

    let button = document.querySelector("#popup-3 .form-button");
    button.addEventListener("click", (e) => {
      e.preventDefault();

      if (animating) {
        return;
      }

      stage++;
      if (stage == 1) {
        stage1Tl.play();
      } else if (stage == 2) {
        stage2Tl.play();
      } else if (stage == 3) {
        stage3Tl.play();
      }
    });

    let stagebutton2 = document.querySelector("#popup-3 #stage-2-button");
    stagebutton2.addEventListener("click", (e) => {
      e.preventDefault();
      stage2Tl.play();
    });

    let previousbutton = document.querySelector("#popup-3 #previous-button");
    previousbutton.addEventListener("click", (e) => {
      e.preventDefault();
      stage1Tl.reverse();
    });
  }

  animatePopup(popup, reverse = false) {
    if (this.popupAnimating) {
      return;
    }
    this.popupAnimating = true;
    let icon = document.querySelector("#scroll-icon");

    if (!reverse) {
      gsap.fromTo(
        popup,
        {
          pointerEvents: "none",
          translateY: "-100%",
          rotateX: 90,
          opacity: 0,
        },
        {
          pointerEvents: "auto",
          translateY: 0,
          rotateX: 0,
          opacity: 1,
          duration: 2,
          ease: "power3.out",
          onStart: () => {
            icon.style.opacity = 0;
          },
          onComplete: () => {
            this.popupState = 1;
            this.popupAnimating = false;
          },
        },
      );
    } else {
      gsap.to(popup, {
        pointerEvents: "auto",
        translateY: "100%",
        rotateX: -90,
        opacity: 0,
        duration: 1.5,
        ease: "power3.in",
        onStart: () => {},
        onComplete: () => {
          document.querySelector(popup).style.transform =
            "translateY(-100%) rotateX(90)";
          this.popupState = 0;
          this.popupAnimating = false;
          var header = document.querySelector("#header");
          header.classList.remove("header-hidden");
          const blur = document.querySelector("#main");
          blur.classList.remove("active");
          icon.style.opacity = 1;
        },
      });
    }
  }

  setAnimations() {
    let tl = gsap.timeline().pause();
    this.tl = tl;
    this.loaded = false;

    tl.fromTo(
      ".page .a-1",
      {
        opacity: 0,
        y: 144,
      },
      {
        opacity: 1,
        y: 0,
        stagger: 0.2,
        duration: 0.8,
        delay: 1,
      },
    );

    tl.fromTo(
      ".page .a-2",
      {
        opacity: 0,
        y: 144,
      },
      {
        opacity: 1,
        y: 0,
        stagger: 0.2,
        duration: 0.8,
      },
      "<",
    );

    tl.fromTo(
      ".bg-1",
      {
        opacity: 0,
      },
      {
        opacity: 1,
        duration: 0.8,
      },
      "<",
    );

    tl.fromTo(
      "#text-canvas",
      {
        opacity: 0,
        y: 144,
      },
      {
        opacity: 1,
        y: 0,
        stagger: 0.2,
        duration: 0.8,
        onComplete: () => {
          this.loaded = true;
        },
      },
      "<",
    );
  }

  getTitleInfo(title) {
    let rect = title.getBoundingClientRect();
    let x = rect.x % window.innerWidth;
    let y = rect.y;
    let width = rect.width;
    let height = rect.height;
    let text = title.innerText;

    let lines = [];
    let inner = title.innerHTML;
    inner = inner.replace("\n", "").trim();
    inner = inner.split("<br>");
    inner.forEach((line) => {
      lines.push(line.replace("\n", "").trim());
    });

    let styles = getComputedStyle(title);
    let fontSize = parseFloat(styles["font-size"].slice(0, -2));
    let lineHeight = fontSize * 1.3;
    let textAlign = styles["text-align"];

    let logo = document.querySelector("#header .logo");
    let logoRect = logo.getBoundingClientRect();
    let offsetX = textAlign == "left" ? logoRect.left : 0;

    let textX = textAlign == "center" ? x + width * 0.5 : x;
    let textY = height * 0.5;
    let maxWidth = width;

    return {
      dom: title,
      x,
      y,
      width,
      height,
      text,
      lines,
      fontSize,
      lineHeight,
      textAlign,
      particles: [],
      offsetX,
      color: styles.color,
      textX,
      textY,
      maxWidth,
    };
  }

  setCanvas() {
    this.canvas = new Canvas(this.sliderState.titles);
    this.canvas.drawParticles(0, 1);
    this.animateSlides1(0.5);
  }

  addEventListeners() {
    // Popup on farm slide
    this.popupAnimating = false;
    this.popupState = 0;

    let currentPopup;

    document.querySelector("#farm").addEventListener("click", () => {
      if (this.popupState == 0) {
        this.popupState = 1;
        currentPopup = "#popup-1";
        var header = document.querySelector("#header");
        header.classList.toggle("header-hidden");
        const blur = document.querySelector("#main");
        blur.classList.toggle("active");
        this.animatePopup("#popup-1");
      }
    });

    document
      .querySelector("#popup-1 .popup-close-button")
      .addEventListener("click", () => {
        if (this.popupState == 1) {
          this.animatePopup("#popup-1", true);
        }
      });

    document.querySelector("#stage-1-button").addEventListener("click", (e) => {
      e.preventDefault();
      this.stage1Tl.play();
    });

    document.querySelector("#stage-2-button").addEventListener("click", (e) => {
      e.preventDefault();
      this.stage2Tl.play();
    });

    // popup2
    document.querySelector("#garden").addEventListener("click", () => {
      if (this.popupState == 0) {
        this.popupState = 1;
        currentPopup = "#popup-2";
        var header = document.querySelector("#header");
        header.classList.toggle("header-hidden");
        const blur = document.querySelector("#main");
        blur.classList.toggle("active");
        this.animatePopup("#popup-2");
      }
    });

    document
      .querySelector("#popup-2 .popup-close-button")
      .addEventListener("click", () => {
        if (this.popupState == 1) {
          this.animatePopup("#popup-2", true);
        }
      });

    // popup3
    document.querySelector("#kitchen").addEventListener("click", () => {
      if (this.popupState == 0) {
        this.popupState = 1;
        currentPopup = "#popup-3";
        var header = document.querySelector("#header");
        header.classList.toggle("header-hidden");
        const blur = document.querySelector("#main");
        blur.classList.toggle("active");
        this.animatePopup("#popup-3");
      }
    });

    document
      .querySelector("#popup-3 .popup-close-button")
      .addEventListener("click", () => {
        if (this.popupState == 1) {
          this.animatePopup("#popup-3", true);
        }
      });

    // outside click
    let popup1 = document.querySelector("#popup-1");
    let popup2 = document.querySelector("#popup-2");
    let popup3 = document.querySelector("#popup-3");

    document.addEventListener("click", (e) => {
      if (currentPopup == "#popup-1") {
        if (!popup1.contains(e.target) && e.target.id != "farm") {
          if (this.popupState == 1) {
            this.animatePopup("#popup-1", true);
          }
        }
      }

      if (currentPopup == "#popup-2") {
        if (!popup2.contains(e.target) && e.target.id != "garden") {
          if (this.popupState == 1) {
            this.animatePopup("#popup-2", true);
          }
        }
      }

      if (currentPopup == "#popup-3") {
        if (!popup3.contains(e.target) && e.target.id != "kitchen") {
          if (this.popupState == 1) {
            this.animatePopup("#popup-3", true);
          }
        }
      }
    });

    // Journey page scroll animations
    document.querySelector("#main").addEventListener("wheel", (e) => {
      if (this.sliderState.animating || this.popupState == 1) {
        return;
      }

      let delta = Math.sign(e.deltaY) * 0.1;
      let test = this.sliderState.total + delta;

      if (test > 5.0) {
        test = 0;
        this.animateSlides1(test, true);
      } else if (test < 0) {
        test = 5;
        this.animateSlides1(test, true);
      } else {
        this.animateSlides1(test);
      }

    });

    // Touch events
    let dragCheck = false;
    let dir = 1;
    let initialTouchY = 0;
    let currentTouchY = 0;

    document.querySelector("#main").addEventListener("touchstart", (e) => {
      dragCheck = false;
      initialTouchY = e.touches[0].clientY;
    });

    document.querySelector("#main").addEventListener("touchmove", (e) => {
      dragCheck = true;
      currentTouchY = e.touches[0].clientY;
    });

    document.querySelector("#main").addEventListener("touchend", (e) => {
      if (!dragCheck) {
        initialTouchY = 0;
        currentTouchY = 0;
        return;
      }

      let sign = currentTouchY < initialTouchY ? 1 : -1;

      let delta = sign * 0.1;
      let test = this.sliderState.total + delta;

      if (test > 5.0) {
        test = 0;
        this.animateSlides1(test, true);
      } else if (test < 0) {
        test = 5;
        this.animateSlides1(test, true);
      } else {
        this.animateSlides1(test);
      }

      this.animateSlides1(test);
    });

    document.addEventListener("DOMContentLoaded", () => {
      this.tl.play();
    });

    document.body.addEventListener("mousemove", (e) => {

      let icon = document.querySelector("#scroll-icon");
      if (this.popupState == 0) {
        icon.style.opacity = 1;
      }
      icon.style.top = e.clientY + "px";
      icon.style.left =e.clientX + "px";

      
    })
  }
}
