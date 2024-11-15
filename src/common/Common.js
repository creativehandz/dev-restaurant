import gsap from "gsap/all";

export default class Common {
  constructor() {
    this.setNavElements();
    this.setHeaderElements();

    this.setLogoAnimations();
    this.setNavAnimations();
    this.setButtonAnimations();
    this.setImages();

    this.addEventListeners();
  }

  setNavElements() {
    this.nav = document.querySelector("#nav");

    this.nav.innerHTML = `
      <ul
      class="cardo-regular flex w-full flex-wrap items-center justify-center gap-4 p-4 py-4 pt-12 text-2xl text-white lg:py-3 xl:py-6 2xl:py-16"
      >
        <li class="nav-item">
          <a href="/" id="HomeLink" class="josefin-sans nav-link">Home</a>
        </li>

        <li class="nav-separator"></li>

        <li class="nav-item">
          <a
            href="/our-journey/"
            id="OurJourneyLink"
            class="josefin-sans nav-link"
            >Our Journey</a
          >
        </li>

        <li class="nav-separator"></li>

        <li class="nav-item">
          <a href="/menu/" id="MenuLink" class="josefin-sans nav-link">Menu</a>
        </li>

        <li class="nav-separator"></li>

        <li class="nav-item">
          <a
            href="/reservation/"
            id="ReservationLink"
            class="josefin-sans nav-link"
            >Reservation</a
          >
        </li>

        <li class="nav-separator"></li>

        <li class="nav-item">
          <a href="/reservation/" id="ContactLink" class="josefin-sans nav-link">Contact</a>
        </li>
      </ul>

      <button
        class="nav-button absolute right-4 top-4 aspect-square h-8 cursor-pointer transition hover:scale-105 md:h-10 lg:right-16 lg:top-1/2 lg:-translate-y-1/2"
      >
        <img src="/close.svg" class="h-full" />
      </button>    
    `;
  }

  setHeaderElements() {
    this.header = document.querySelector("#header");

    this.header.innerHTML = `
      <div
        class="container mx-auto flex items-center justify-between p-4 md:p-6 lg:pt-6 xl:pt-4 2xl:pt-6"
      >
        <!-- Logo -->
        <a
          href="/"
          class="logo block h-9 w-fit md:h-10 lg:h-[38px] xl:h-[41px] 2xl:h-[51px]"
        >
          <img src="/main-logo.png" class="h-full" />
        </a>

        <!-- Menu button -->
        <div
          class="menu-button flex aspect-square h-8 cursor-pointer flex-col items-end justify-center gap-y-2"
        >
          <div class="el-1"></div>
          <div class="el-1"></div>
          <div class="el-1"></div>
        </div>
      </div>    
    `;
  }

  setLogoAnimations() {
    let tl = gsap.timeline().reverse().pause();
    this.logoTl = tl;

    tl.to("#header .logo", {
      clipPath:
        "polygon(0% 0%, 0% 100%, 99% 100%, 99% 54%, 100% 54%, 100% 100%, 100% 0%)",
    });
  }

  setNavAnimations() {
    let tl = gsap.timeline().reverse().pause();
    let mm = gsap.matchMedia();
    this.navTl = tl;

    tl.to("#nav", {
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
        "#main",
        {
          rotateX: 37 - window.innerHeight * 0.007,
          translateY: -24,
        },
        "<",
      );

      tl.to(
        "#back",
        {
          rotateX: 37 - window.innerHeight * 0.005,
          translateY: 0,
        },
        "<",
      );
    });

    mm.add("(min-width: 1024px)", () => {
      tl.to(
        "#main",
        {
          rotateX: 24,
          translateY: -48,
        },
        "<",
      );

      tl.to(
        "#back",
        {
          rotateX: 24,
          translateY: 0,
        },
        "<",
      );
    });
  }

  setButtonAnimations() {
    let tl = gsap.timeline().reverse().pause();
    this.buttonTl = tl;

    tl.to(".menu-button .el-1", {
      width: 48,
      backgroundColor: "#c69b36",
      stagger: 0.1,
    });
  }

  setImages() {
    this.responsiveImages = [];
    let imgs = document.querySelectorAll("img");

    imgs.forEach((img) => {
      if (img.dataset.mobileSrc) {
        this.responsiveImages.push({
          el: img,
          desktopUrl: img.src,
          mobileUrl: img.dataset.mobileSrc,
        });
      }
    });

    this.updateImages(window.innerWidth);
  }

  updateImages(screenWidth) {
    if (screenWidth < 1024) {
      this.responsiveImages.forEach((img) => {
        img.el.src = img.mobileUrl;
      });
    } else {
      this.responsiveImages.forEach((img) => {
        img.el.src = img.desktopUrl;
      });
    }
  }

  addEventListeners() {
    let logo = this.header.querySelector(".logo");

    logo.addEventListener("mouseenter", () => {
      this.logoTl.play();
    });

    logo.addEventListener("mouseleave", () => {
      this.logoTl.reverse();
    });

    let button = this.header.querySelector(".menu-button");
    let navButton = this.nav.querySelector(".nav-button");

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

    window.addEventListener("resize", () => {
      this.updateImages(window.innerWidth); // not working
    });
  }

  resetNav() {
    this.navTl.reverse();
  }
}
