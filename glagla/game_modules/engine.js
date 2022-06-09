export class Engine {
    constructor(time_step, render, update) {
        this.accumulatedTime = 0;
        this.animation_frame_request;
        this.time;
        this.timeStep = time_step;

        this.updated = false;

        this.update = update;
        this.render = render;

        this.running = false;
    }
    run(time_stamp) {
        this.accumulatedTime += time_stamp - this.time;
        this.time = time_stamp;

        if (this.accumulatedTime >= this.timeStep * 3) {
            this.accumulatedTime = this.timeStep;
        }

        while (this.accumulatedTime >= this.timeStep) {
            this.accumulatedTime -= this.timeStep;
            this.update();
            this.updated = true;
        }

        if (this.updated) {
            this.updated = false;
            this.render();
        }

        if (this.running) {
            this.animation_frame_request = window.requestAnimationFrame(
                (time_step) => this.run(time_step)
            );
        }
    }

    start() {
        this.running = true;
        this.accumulated_time = this.time_step;
        this.time = window.performance.now();
        this.animation_frame_request = window.requestAnimationFrame(
            (time_step) => this.run(time_step)
        );
    }

    stop() {
        this.running = false;
        window.cancelAnimationFrame(this.animation_frame_request);
    }
}
