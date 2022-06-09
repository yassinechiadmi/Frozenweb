import { Vec2 } from "./utils.js";

export class Display {
    constructor(canvas) {
        this.buffer = document.createElement("canvas").getContext("2d");
        this.context = canvas.getContext("2d");
        this.tileSheet = new TileSheet(16, 5);
        this.player = new Sprite(16);
        this.camera = new Camera();
    }

    fill(context, color) {
        context.fillStyle = color;
        context.fillRect(0, 0, context.canvas.width, context.canvas.height);
    }
    clear(context) {
        context.clearRect(0, 0, context.canvas.width, context.canvas.height);
    }
    drawRectangle(x, y, width, height, color) {
        this.buffer.fillStyle = color;
        this.buffer.fillRect(Math.round(x), Math.round(y), width, height);
    }
    drawText(text, x, y, color) {
        this.context.fillStyle = color;
        this.context.fillText(text, x, y);
    }

    drawGrid(worldColumns, worldRows, color) {
        this.buffer.fillStyle = color;
        for (let columns = 0; columns < worldColumns; columns++) {
            this.buffer.fillRect(
                (columns + 1) * this.tileSheet.tileSize - 1,
                0,
                2,
                worldRows * this.tileSheet.tileSize
            );
        }
        for (let rows = 0; rows < worldRows; rows++) {
            this.buffer.fillRect(
                0,
                (rows + 1) * this.tileSheet.tileSize - 1,
                worldColumns * this.tileSheet.tileSize,
                2
            );
        }
    }

    drawTile(pos, sheetIndex) {
        const sheetX =
            (sheetIndex % this.tileSheet.columns) * this.tileSheet.tileSize;
        const sheetY =
            Math.floor(sheetIndex / this.tileSheet.columns) *
            this.tileSheet.tileSize;
        const canvasX = pos.x * this.tileSheet.tileSize;
        const canvasY = pos.y * this.tileSheet.tileSize;
        this.buffer.drawImage(
            this.tileSheet.image,
            sheetX,
            sheetY,
            this.tileSheet.tileSize,
            this.tileSheet.tileSize,
            canvasX,
            canvasY,
            this.tileSheet.tileSize,
            this.tileSheet.tileSize
        );
    }

    drawFloor(data, mapWidth, index, pos) {
        if (
            data[index - 1] >= -1 &&
            data[index + 1] >= -1 &&
            data[index - mapWidth] >= -1 &&
            data[index + mapWidth] >= -1
        ) {
            this.drawTile(pos, 5);
        } else {
            this.drawTile(pos, 0);
        }
    }

    drawMap(data, mapWidth) {
        data.forEach((value, index) => {
            const pos = new Vec2(
                (index % mapWidth) + 1,
                Math.floor(index / mapWidth) + 1
            );
            switch (value) {
                case -3: // floor
                    {
                        this.drawFloor(data, mapWidth, index, pos);
                    }
                    break;
                case -2: // wall
                    {
                        this.drawTile(pos, 2);
                    }
                    break;
                case -1: //ice
                    {
                        this.drawTile(pos, 1);
                    }
                    break;
                case 0: //rock
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 20);
                    }
                    break;
                case 1: //up
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 17);
                    }
                    break;
                case 2: // left
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 16);
                    }
                    break;
                case 3: // down
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 22);
                    }
                    break;
                case 4: // right
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 21);
                    }
                    break;
                case 5: // breaking
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 23);
                    }
                    break;
                case 6: // breaked
                    {
                        this.drawTile(pos, 1);
                        this.drawTile(pos, 24);
                    }
                    break;
                default:
                    break;
            }
        });
    }

    drawWall(mapWidth, mapHeight) {
        for (let x = 1; x <= mapWidth; x++) {
            this.drawTile(new Vec2(x, 0), 2);
            this.drawTile(new Vec2(x, mapHeight + 1), 7);
        }
        for (let y = 1; y <= mapHeight; y++) {
            this.drawTile(new Vec2(0, y), 8);
            this.drawTile(new Vec2(mapWidth + 1, y), 9);
        }
        this.drawTile(new Vec2(0, 0), 3);
        this.drawTile(new Vec2(mapWidth + 1, 0), 4);
        this.drawTile(new Vec2(0, mapHeight + 1), 13);
        this.drawTile(new Vec2(mapWidth + 1, mapHeight + 1), 14);
    }

    drawPath(path, mapWidth) {
        path.forEach((index) => {
            this.drawRectangle(
                (Math.floor(index / mapWidth) + 1) * this.tileSheet.tileSize,
                ((index % mapWidth) + 1) * this.tileSheet.tileSize,
                this.tileSheet.tileSize,
                this.tileSheet.tileSize,
                "rgba(0,0,0,0.5)"
            );
            // this.drawRectangle(
            //     ((index % mapWidth) + 1) * this.tileSheet.tileSize,
            //     (Math.floor(index / mapWidth) + 1) * this.tileSheet.tileSize,
            //     this.tileSheet.tileSize,
            //     this.tileSheet.tileSize,
            //     "rgba(0,0,0,0.5)"
            // );
        });
    }

    drawPlayer(pos, dir, anim, frame) {
        let direction;
        if (dir.x > 0) {
            direction = 0;
        } else if (dir.x < 0) {
            direction = 2;
        } else if (dir.y > 0) {
            direction = 3;
        } else if (dir.y < 0) {
            direction = 1;
        }

        let start;
        switch (anim) {
            case "idle":
                start = 0;
                break;
            case "walk":
                start = 4;
                break;
            default:
                start = 0;
                break;
        }

        this.buffer.drawImage(
            this.player.image,
            (start + frame) * this.player.tileSize,
            direction * this.player.tileSize,
            this.player.tileSize,
            this.player.tileSize,
            Math.round((pos.x + 1) * this.tileSheet.tileSize) +
                (this.tileSheet.tileSize - this.player.tileSize),
            Math.round((pos.y + 1) * this.tileSheet.tileSize) +
                (this.tileSheet.tileSize - this.player.tileSize) -
                4,
            this.player.tileSize,
            this.player.tileSize
        );
    }
    drawBackground() {
        const background = this.buffer.createPattern(
            this.background.image,
            "repeat"
        );
        this.buffer.fillStyle = background;
        this.buffer.fillRect(
            0,
            0,
            this.buffer.canvas.width,
            this.buffer.canvas.height
        );
        /*for (let rows = 0; rows < worldRows; rows++) {
            for (let columns = 0; columns < worldColumns; columns++) {
                this.buffer.drawImage(
                    this.background.image,
                    0,
                    0,
                    this.background.tileSize,
                    this.background.tileSize,
                    columns * this.background.tileSize,
                    rows * this.background.tileSize,
                    this.background.tileSize,
                    this.background.tileSize
                );
            }
        }*/
    }

    render() {
        // this.fill(this.context, "black");
        this.clear(this.context);
        this.context.drawImage(
            this.buffer.canvas,
            this.camera.pos1.x,
            this.camera.pos1.y,
            this.camera.pos2.x,
            this.camera.pos2.y,
            0,
            0,
            this.context.canvas.width,
            this.context.canvas.height
        );
    }

    resize(width, height, height_width_ratio) {
        if (this.camera.mode == "PLAYER") height_width_ratio = height / width;
        if (height / width > height_width_ratio) {
            this.context.canvas.height = width * height_width_ratio;
            this.context.canvas.width = width;
        } else {
            this.context.canvas.height = height;
            this.context.canvas.width = height / height_width_ratio;
        }

        this.context.imageSmoothingEnabled = false;
        this.render();
    }

    updateCamera() {
        switch (this.camera.mode) {
            case "ALL":
                {
                    this.camera.pos1.reset();
                    this.camera.pos2.set(
                        this.buffer.canvas.width,
                        this.buffer.canvas.height
                    );
                }
                break;
            case "PLAYER":
                {
                    const zoom = this.camera.zoom;
                    const ratio =
                        this.context.canvas.width / this.context.canvas.height;
                    const x = this.camera.posC.x * this.tileSheet.tileSize;
                    const y = this.camera.posC.y * this.tileSheet.tileSize;
                    this.camera.pos1.set(
                        x + this.tileSheet.tileSize / 2 - zoom * ratio,
                        y + this.tileSheet.tileSize / 2 - zoom
                    );
                    this.camera.pos2.set(zoom * 2 * ratio, zoom * 2);
                }
                break;

            default:
                break;
        }
    }
    toggleCameraMode(width, height, height_width_ratio) {
        switch (this.camera.mode) {
            case "ALL":
                this.camera.mode = "PLAYER";
                break;
            case "PLAYER":
                this.camera.mode = "ALL";
                break;
            default:
                break;
        }
        this.resize(width, height, height_width_ratio);
    }
}

class TileSheet {
    constructor(tile_size, columns) {
        this.image = new Image();
        this.tileSize = tile_size;
        this.columns = columns;
    }
}
class Sprite {
    constructor(tile_size) {
        this.image = new Image();
        this.tileSize = tile_size;
    }
}

class Camera {
    constructor() {
        this.mode = "ALL";
        this.zoom = 60;
        this.pos1 = new Vec2();
        this.pos2 = new Vec2();
        this.posC = new Vec2();
    }
}
