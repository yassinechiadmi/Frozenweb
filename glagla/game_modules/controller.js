export class Controller {
    constructor() {}
    keyDownUp(type, code) {
        let down = type == "keydown" ? true : false;

        Object.keys(this).forEach((key, index) => {
            if (this[key].keyCode.includes(code)) this[key].setState(down);
        });
    }

    register(name, key, callback, slow = false) {
        this[name] = new ButtonInput(key, callback, slow);
    }
}

class ButtonInput {
    constructor(keyCode, callback, slow) {
        this.down = false;
        this.active = false;
        this.keyCode = keyCode;
        this.callback = callback;
        this.slow = slow;
    }
    setState(down) {
        if (this.down != down) this.active = down;
        this.down = down;
    }
}
