import { Vec2 } from "./utils.js";

const events = new Array();

export class Game {
    constructor(level) {
        this.level = JSON.parse(level);
        this.world = new World(this.level);
        this.win = false;
    }

    update() {
        this.world.update();
    }

    reset() {
        this.world = new World(this.level);
        events
            .filter((e) => e.type == "onReset")
            .forEach((e) => {
                e.callback(this.level);
            });
    }

    registerEvent(type, callback) {
        events.push(new Event(type, callback));
    }
}

class World {
    constructor(level) {
        this.level = new Level(level);
        this.player = new Player(level.start);
    }

    update() {
        this.level.update();
        this.player.update();

        if (
            this.player.pos.isSup(
                new Vec2(this.level.width - 1, this.level.height - 1)
            ) ||
            new Vec2(0, 0).isSup(this.player.pos)
        ) {
            this.player.pos.sub(this.player.direction);
            this.player.direction.reset();
        }

        switch (this.level.getdata(this.player.pos)) {
            case -3:
                {
                    this.player.direction.reset();
                }
                break;
            case 5: {
                const dis = Vec2.sub(this.player.displayPos, this.player.pos);
                if (Math.abs(dis.x) > 0.3 || Math.abs(dis.y) > 0.3) break;
                this.level.setdata(this.player.pos, 6);
            }

            case -1:
                {
                    this.player.pos.add(this.player.direction);
                }
                break;
            case -2:
            case 0:
                {
                    this.player.pos.sub(this.player.direction);
                    this.player.direction.reset();
                }
                break;
            case 1:
            case 2:
            case 3:
            case 4:
                {
                    if (!this.player.moving) {
                        switch (this.level.getdata(this.player.pos)) {
                            case 1:
                                this.player.direction.set(0, -1);
                                break;
                            case 2:
                                this.player.direction.set(1, 0);
                                break;
                            case 3:
                                this.player.direction.set(0, 1);
                                break;
                            case 4:
                                this.player.direction.set(-1, 0);
                                break;
                            default:
                                break;
                        }
                        this.player.move(this.player.direction);
                    }
                }
                break;
            case 6:
                {
                    this.player.freeze = true;
                }
                break;
            default:
                break;
        }
    }

    distanceOfEnd() {
        return Vec2.sub(this.player.displayPos, this.level.end).modulus();
    }
}

///////////
// Level //
///////////

class Level {
    constructor(level) {
        this.height = level.height;
        this.width = level.width;
        this.data = level.data;
        this.end = level.end;
        this.start = level.start;
    }

    getdata(vec2) {
        return this.data[vec2.y * this.width + vec2.x];
    }

    setdata(vec2, value) {
        this.data[vec2.y * this.width + vec2.x] = value;
    }

    update() {}
}

////////////
// Player //
////////////

class Player {
    constructor(start) {
        this.pos = new Vec2(start.x, start.y);
        this.oldPos = new Vec2();
        this.oldPos.copy(this.pos);
        this.oldDisplayPos = new Vec2();
        this.oldDisplayPos.copy(this.pos);
        this.displayPos = new Vec2();
        this.displayPos.copy(this.pos);
        this.motion = new Vec2();
        this.acceleration = new Vec2();
        this.moving = false;
        this.freeze = false;
        this.direction = new Vec2();
        this.lastDir = new Vec2(0, 1);
        this.moveCount = 0;
        this.animation = new Animation();
        this.animation.addAnim("idle", 4, 200);
        this.animation.addAnim("walk", 4, 100);
    }

    update() {
        this.animation.update();
        this.updateOldDisplay();
        if (this.direction.x != 0 || this.direction.y != 0) {
            this.lastDir.copy(this.direction);
        }
        if (this.moving) {
            this.animation.currentAnim = "walk";
        } else {
            this.animation.currentAnim = "idle";
        }

        if (this.displayPos.x < this.pos.x) this.acceleration.x += 0.006;
        if (this.displayPos.x > this.pos.x) this.acceleration.x -= 0.006;
        if (this.displayPos.y < this.pos.y) this.acceleration.y += 0.006;
        if (this.displayPos.y > this.pos.y) this.acceleration.y -= 0.006;

        this.motion.add(this.acceleration);
        this.displayPos.add(this.motion);

        this.motion.multiply_by_cste(0.9);
        this.acceleration.multiply_by_cste(0.9);

        if (
            (this.displayPos.x > this.pos.x &&
                this.oldDisplayPos.x < this.displayPos.x) ||
            (this.displayPos.x < this.pos.x &&
                this.oldDisplayPos.x > this.displayPos.x)
        ) {
            this.acceleration.x = 0;
            this.motion.x = 0;
        }

        if (
            (this.displayPos.y > this.pos.y &&
                this.oldDisplayPos.y < this.displayPos.y) ||
            (this.displayPos.y < this.pos.y &&
                this.oldDisplayPos.y > this.displayPos.y)
        ) {
            this.acceleration.y = 0;
            this.motion.y = 0;
        }

        const dis = this.distancePosDisplay();
        if (
            dis.x < 0.2 &&
            dis.y < 0.2
            // this.pos.x == Math.round(this.displayPos.x) &&
            // this.pos.y == Math.round(this.displayPos.y)
        ) {
            this.moving = false;
        }
        // if (
        //     (this.displayPos.isSup(this.pos) &&
        //         this.displayPos.isSup(this.oldDisplayPos)) ||
        //     (this.pos.isSup(this.displayPos) &&
        //         this.oldDisplayPos.isSup(this.displayPos))
        // ) {
        //     console.log(this);
        //     this.moving = false;
        //     this.acceleration.reset();
        //     this.motion.reset();
        // }
    }

    move(direction) {
        if (!this.freeze) {
            this.updateOld();
            this.moving = true;
            this.direction.copy(direction);
            this.pos.add(direction);
            this.moveCount++;
            events
                .filter((e) => e.type == "onPlayerMove")
                .forEach((e) => {
                    e.callback(this);
                });
        }
    }

    updateOld() {
        this.oldPos.copy(this.pos);
    }

    updateOldDisplay() {
        this.oldDisplayPos.copy(this.displayPos);
    }

    distancePosDisplay() {
        const dis = Vec2.sub(this.displayPos, this.pos);
        return { x: Math.abs(dis.x), y: Math.abs(dis.y) };
    }
}

class Event {
    type;
    callback;
    constructor(type, callback) {
        this.type = type;
        this.callback = callback;
    }
}

class Animation {
    constructor() {
        this.lastTime = 0;
        this.anims = {};
        this.currentAnim = "idle";
        this.currentFrame = 0;
    }

    update(time) {
        if (time > this.lastTime + this.anims[this.currentAnim].speed) {
            this.lastTime = time;
            this.currentFrame =
                (this.currentFrame + 1) % this.anims[this.currentAnim].nbFrame;
        }
    }

    addAnim(name, nbFrame, speed) {
        this.anims[name] = new Anim(speed, nbFrame);
    }
}

class Anim {
    constructor(speed, nbFrame) {
        this.speed = speed;
        this.nbFrame = nbFrame;
    }
}
