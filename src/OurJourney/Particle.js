export default class Particle {
  constructor(effect, x, y, color, size) {
    this.effect = effect;
    this.x = x;
    this.y = y;

    this.color = color;
    this.size = size;

    this.initialX = (Math.random() * 1.4 - 0.2) * this.effect.width;
    this.initialY = (Math.random() * 1.4 - 0.2) * this.effect.height;

    this.currentX = this.initialX;
    this.currentY = this.initialY;
  }

  draw(progress = 1) {
    let ctx = this.effect.context;
    ctx.fillStyle = this.color;

    this.currentX = this.interpolate(this.initialX, this.x, progress);
    this.currentY = this.interpolate(this.initialY, this.y, progress);

    ctx.beginPath();
    ctx.arc(
      this.currentX,
      this.currentY,
      this.size * (progress * 0.5 + 0.5),
      0,
      2 * Math.PI,
    );
    ctx.fill();
  }

  interpolate(v0, v1, t) {
    return v0 + (v1 - v0) * t;
  }
}
