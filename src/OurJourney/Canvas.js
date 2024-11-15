import gsap from "gsap/all";
import Particle from "./Particle.js";

export default class Canvas {
  constructor(titles) {
    this.domElement = document.getElementById("text-canvas");
    this.context = this.domElement.getContext("2d", {
      willReadFrequently: true,
    });

    this.sizes = {};
    this.width = window.innerWidth;
    this.height = window.innerHeight;

    this.titles = titles;
    this.particles = {};

    this.previousId = 0;
    this.currentId = 0;
    this.gap = 4;

    this.setTitles();
  }

  setTitles() {
    this.titles.forEach((title, index) => {
      this.createParticles(index);
    });
  }

  createParticles(id, recalculateNeeded = false) {
    let title = { ...this.titles[id] };

    this.updateCanvas();

    // Check if particles already created to improve performance
    if (this.particles[id] && !recalculateNeeded) {
      return;
    }

    // Draw text based on current text properties
    this.drawText(id);

    // Convert text pixels to particles
    let particles = [];

    for (let y = 0; y < this.sizes.height; y += this.gap) {
      for (let x = 0; x < this.sizes.width; x += this.gap) {
        let pixel = this.context.getImageData(x, y, 1, 1);

        if (pixel.data[3] > 0) {
          let color = `rgb(${229 + (Math.random() - 0.5) * 40}, 214, 179)`;

          let size = Math.floor(Math.random() * 4);
          particles.push(new Particle(this, x, y, color, size));
        }
      }
    }

    this.particles[id] = particles;
    this.clear();
  }

  updateCanvas() {
    // Canvas props
    this.sizes = {
      left: 0,
      top: 0,
      width: window.innerWidth,
      height: window.innerHeight,
    };

    this.domElement.style.left = this.sizes.left + "px";
    this.domElement.style.top = this.sizes.top + "px";
    this.domElement.style.width = this.sizes.width + "px";
    this.domElement.style.height = this.sizes.height + "px";

    this.domElement.width = this.sizes.width;
    this.domElement.height = this.sizes.height;
  }

  drawText(id, clear = true, color) {
    let title = { ...this.titles[id] };

    this.context.fillStyle = color || title.color;
    this.context.font = `${title.fontSize}px Cardo`;
    this.context.textAlign = title.textAlign;
    this.context.textBaseline = "middle";
    this.context.letterSpacing = "2px";

    if (clear) {
      this.clear();
    }

    // Text
    let textHeight = title.lines.length * title.lineHeight;

    title.lines.forEach((line, index) => {
      this.context.fillText(
        line,
        title.textX,
        title.y +
          index * title.lineHeight +
          textHeight * 0.25 +
          (1 - index) * 6,
      );
    });
  }

  drawParticles(id, progress) {
    this.clear();

    if (progress > 0.99) {
      let textColor = `rgba(229, 214, 179, ${Math.pow(progress, 6.0) * 0.9})`;
      this.drawText(id, true, textColor);
      return;
    }

    this.particles[id].forEach((particle) => {
      particle.draw(progress);
    });
  }

  clear() {
    this.context.clearRect(0, 0, this.sizes.width, this.sizes.height);
  }
}
