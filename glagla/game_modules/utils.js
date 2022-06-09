export class Vec2 {
    constructor(x, y) {
        this.x = x ? x : 0;
        this.y = y ? y : 0;
    }

    static sub(vec2A, vec2B) {
        return new Vec2(vec2A.x - vec2B.x, vec2A.y - vec2B.y);
    }

    copy(vec2) {
        this.x = vec2.x;
        this.y = vec2.y;
    }

    add(vec2) {
        this.x += vec2.x;
        this.y += vec2.y;
    }

    sub(vec2) {
        this.x -= vec2.x;
        this.y -= vec2.y;
    }

    multiply_by_cste(cste) {
        this.x *= cste;
        this.y *= cste;
    }

    isSup(vec2) {
        return this.x > vec2.x || this.y > vec2.y;
    }

    isSup_of_cste(cste) {
        return this.x > cste || this.y > cste;
    }

    reset() {
        this.x = 0;
        this.y = 0;
    }

    set(x, y) {
        this.x = x;
        this.y = y;
    }

    modulus() {
        return Math.sqrt(this.x * this.x + this.y * this.y);
    }
}
