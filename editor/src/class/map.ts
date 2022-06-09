import { Vec2 } from "./vec2.js";

export class Map {

    data: number[];
    width: number;
    height: number;
    start: Vec2 = new Vec2();
    end: Vec2 = new Vec2();

    constructor(map: any) {
        this.width = map.width as number;
        this.height = map.height as number;
        this.data = map.data as number[];
        this.start = map.start as Vec2;
        this.end = map.end as Vec2;
    }
}