import { Camera } from "./camera.js";
import { Vec2 } from "./vec2.js";
export class Display {
    context;
    buffer;
    camera = new Camera();
    ratio = new Vec2();
    tileIndex = new Vec2();
    constructor(canvasElem) {
        this.context = canvasElem.getContext("2d");
        this.context.imageSmoothingEnabled = false;
        this.buffer = document.createElement("canvas").getContext("2d");
    }
    fill(where, color) {
        switch (where) {
            case 'CONTEXT':
                this.context.fillStyle = color;
                this.context.fillRect(0, 0, this.context.canvas.width, this.context.canvas.height);
                break;
            case 'BUFFER':
                this.buffer.fillStyle = color;
                this.buffer.fillRect(0, 0, this.buffer.canvas.width, this.buffer.canvas.height);
                break;
            default:
                break;
        }
    }
    clear(where) {
        switch (where) {
            case 'CONTEXT':
                this.context.clearRect(0, 0, this.context.canvas.width, this.context.canvas.height);
                break;
            case 'BUFFER':
                this.buffer.clearRect(0, 0, this.buffer.canvas.width, this.buffer.canvas.height);
                break;
            default:
                break;
        }
    }
    drawRectangle(x, y, width, height, color) {
        this.buffer.fillStyle = color;
        this.buffer.fillRect(Math.round(x), Math.round(y), width, height);
    }
    drawGrid(width, height, tileSize) {
        this.context.fillStyle = 'rgba(0, 0, 0, 0.6)';
        for (let x = 0; x <= width; x++) {
            const posX = (x * tileSize - this.camera.pos1.x) / (this.camera.pos2.x / this.context.canvas.width);
            this.context.fillRect(posX - 1, 0, 2, this.context.canvas.height);
        }
        for (let y = 0; y <= height; y++) {
            const posY = (y * tileSize - this.camera.pos1.y) / (this.camera.pos2.y / this.context.canvas.height);
            this.context.fillRect(0, posY - 1, this.context.canvas.width, 2);
        }
    }
    drawMap(tileSheet, map) {
        map.data.forEach((value, index) => {
            const tile = tileSheet.tiles.filter((tile) => tile.index == value);
            if (!tile)
                return;
            const destination_x = (index % map.width) * tileSheet.tileSize;
            const destination_y = Math.floor(index / map.width) * tileSheet.tileSize;
            this.buffer.drawImage(tile[0].image, 0, 0, tileSheet.tileSize, tileSheet.tileSize, destination_x, destination_y, tileSheet.tileSize, tileSheet.tileSize);
        });
    }
    drawTile(image, tileIndex, tileSize) {
        this.buffer.drawImage(image, 0, 0, tileSize, tileSize, tileIndex.x * tileSize, tileIndex.y * tileSize, tileSize, tileSize);
    }
    render() {
        this.fill('CONTEXT', 'white');
        this.context.drawImage(this.buffer.canvas, this.camera.pos1.x, this.camera.pos1.y, this.camera.pos2.x, this.camera.pos2.y, 0, 0, this.context.canvas.width, this.context.canvas.height);
    }
    updateRatio() {
        this.ratio.set(this.context.canvas.width / this.buffer.canvas.width, this.context.canvas.height / this.buffer.canvas.height);
    }
    resizeBuffer(mapWidth, mapHeight, tileSize) {
        this.buffer.canvas.width = mapWidth * tileSize;
        this.buffer.canvas.height = mapHeight * tileSize;
        this.updateRatio();
    }
    resizeContext(width, height) {
        this.context.canvas.width = width;
        this.context.canvas.height = height;
        this.context.imageSmoothingEnabled = false;
        this.camera.update(width, height);
        this.updateRatio();
    }
}
