import Particle from "./Particle.js";

export default class Effect {
  constructor(selector, imgSrc, bgImageSrc) {
    this.selector = selector;
    this.imgSrc = imgSrc;
    this.bgImgSrc = bgImageSrc;

    this.canvas = document.querySelector(this.selector);

    this.width = this.canvas.offsetWidth;
    this.height = this.canvas.offsetHeight;

    this.canvas.width = this.width;
    this.canvas.height = this.height;

    this.context = this.canvas.getContext("2d", { willReadFrequently: true });

    this.gap = 6;
    this.particles = [];

    this.loadImages();
  }

  loadImages() {
    let toLoad = 2;
    let loaded = 0;
    this.img = new Image();
    this.img.src = this.imgSrc;
    this.bgImg = new Image();
    this.bgImg.src = this.bgImgSrc;

    let check = () => {
      if (toLoad == loaded) {
        this.drawImage(this.img);
        this.createParticles();
      }
    };

    this.img.addEventListener("load", () => {
      loaded++;
      check();
    });

    this.bgImg.addEventListener("load", () => {
      loaded++;
      check();
    });
  }

  drawImage(img, clear = true) {
    let ctx = this.context;
    let cnv = this.canvas;

    if (clear) {
      ctx.clearRect(0, 0, this.width, this.height);
    }

    let imgAspect = img.naturalWidth / img.naturalHeight;
    let canvasAspect = cnv.width / cnv.height;

    let drawSizes = [];

    if (imgAspect > canvasAspect) {
      drawSizes.push(cnv.height * imgAspect, cnv.height);
    } else {
      drawSizes.push(cnv.width, cnv.width / imgAspect);
    }

    ctx.drawImage(img, 0, 0, ...drawSizes);
  }

  createParticles() {
    let particles = [];

    for (let y = 0; y < this.height; y += this.gap) {
      for (let x = 0; x < this.width; x += this.gap) {
        let pixel = this.context.getImageData(x, y, 1, 1);

        if (pixel.data[3] > 0) {
          let color = `rgb(${pixel.data[0]},${pixel.data[1]},${pixel.data[2]})`;
          let size = Math.floor(Math.random() * 4);
          particles.push(new Particle(this, x, y, color, size));
        }
      }
    }

    this.particles = particles;
  }

  render(progress) {
    let p = Math.abs(Math.sin(progress * Math.PI)); //0 -> 1 -> 0

    this.context.clearRect(0, 0, this.width, this.height);
    this.drawImage(this.bgImg);

    if (p > 0.98) {
      this.drawImage(this.img, false);
    } else {
      this.particles.forEach((particle) => {
        particle.draw(p);
      });
    }
  }
}
