import { Vec2 } from "./vec2.js";
export class Camera {
    zoom;
    pos1 = new Vec2();
    pos2 = new Vec2();
    posC = new Vec2();
    constructor() {
        this.zoom = 50;
        this.pos2;
        this.posC;
        this.pos1;
    }
    update(clientWidth, clientHeight) {
        const zoom = this.zoom;
        const ratio = clientWidth / clientHeight;
        const x = this.posC.x;
        const y = this.posC.y;
        this.pos1.set(x / 2 - zoom * ratio, y / 2 - zoom);
        this.pos2.set(zoom * 2 * ratio, zoom * 2);
    }
}
