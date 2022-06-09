import { Vec2 } from "./vec2.js";
export class Map {
    data;
    width;
    height;
    start = new Vec2();
    end = new Vec2();
    constructor(map) {
        this.width = map.width;
        this.height = map.height;
        this.data = map.data;
        this.start = map.start;
        this.end = map.end;
    }
}
