import { Camera } from "./camera.js";
import { Map } from "./map.js";
import { Sheet } from "./sheet.js";
import { Vec2 } from "./vec2.js";

export class Display {

    context: CanvasRenderingContext2D;
    buffer: CanvasRenderingContext2D;
    camera: Camera = new Camera();
    ratio: Vec2 = new Vec2();
    tileIndex: Vec2 = new Vec2();

    constructor(canvasElem: HTMLCanvasElement) {
        this.context = canvasElem.getContext("2d") as CanvasRenderingContext2D;
        this.context.imageSmoothingEnabled = false;
        this.buffer = document.createElement("canvas").getContext("2d") as CanvasRenderingContext2D;
    }

    fill(where: CANVAS, color: string | CanvasGradient | CanvasPattern) {
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
    clear(where: CANVAS) {
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

    drawRectangle(x: number, y: number, width: number, height: number, color: string | CanvasGradient | CanvasPattern) {
        this.buffer.fillStyle = color;
        this.buffer.fillRect(Math.round(x), Math.round(y), width, height);
    }

    drawGrid(width: number, height: number, tileSize) {
        this.context.fillStyle = 'rgba(0, 0, 0, 0.6)';
        for (let x = 0; x <= width; x++) {
            const posX = (x * tileSize - this.camera.pos1.x) / (this.camera.pos2.x / this.context.canvas.width)
            this.context.fillRect(posX - 1, 0, 2, this.context.canvas.height);
        }
        for (let y = 0; y <= height; y++) {
            const posY = (y * tileSize - this.camera.pos1.y) / (this.camera.pos2.y / this.context.canvas.height)
            this.context.fillRect(0, posY - 1, this.context.canvas.width, 2);
        }
    }

    drawMap(tileSheet: Sheet, map: Map) {
        map.data.forEach((value, index) => {
            const tile = tileSheet.tiles.filter((tile) => tile.index == value);
            if (!tile) return;
            const destination_x = (index % map.width) * tileSheet.tileSize;
            const destination_y =
                Math.floor(index / map.width) * tileSheet.tileSize;
            // console.log(tileSheet.tiles[value + 3]);

            this.buffer.drawImage(
                tile[0].image,
                0,
                0,
                tileSheet.tileSize,
                tileSheet.tileSize,
                destination_x,
                destination_y,
                tileSheet.tileSize,
                tileSheet.tileSize
            );
        })
    }

    drawTile(image: HTMLImageElement, tileIndex: Vec2, tileSize: number) {
        this.buffer.drawImage(
            image,
            0,
            0,
            tileSize,
            tileSize,
            tileIndex.x * tileSize,
            tileIndex.y * tileSize,
            tileSize,
            tileSize
        );
    }


    // drawLayer(layer: number[], width: number, sheet: Sheet) {
    //     layer.forEach((value, index) => {
    //         if (value < 0) {
    //             return;
    //         }
    //         const source_x =
    //             (value % sheet.columns) * sheet.tileSize;
    //         const source_y =
    //             Math.floor(value / sheet.columns) *
    //             sheet.tileSize;
    //         const destination_x = (index % width) * sheet.tileSize;
    //         const destination_y =
    //             Math.floor(index / width) * sheet.tileSize;

    //         this.buffer.drawImage(
    //             sheet.imageElem,
    //             source_x,
    //             source_y,
    //             sheet.tileSize,
    //             sheet.tileSize,
    //             destination_x,
    //             destination_y,
    //             sheet.tileSize,
    //             sheet.tileSize
    //         );
    //     });
    // }


    // drawGrid(tileSize: number, color: string | CanvasGradient | CanvasPattern) {
    //     this.buffer.fillStyle = color;
    //     for (let column = 0; column < this.context; column++) {
    //         const element = array[column];

    //     }
    //     for (let columns = 0; columns < this.; columns++) {
    //         this.buffer.fillRect(
    //             (columns + 1) * this.tileSheet.tileSize - 1,
    //             0,
    //             2,
    //             worldRows * this.tileSheet.tileSize
    //         );
    //     }
    //     for (let rows = 0; rows < worldRows; rows++) {
    //         this.buffer.fillRect(
    //             0,
    //             (rows + 1) * this.tileSheet.tileSize - 1,
    //             worldColumns * this.tileSheet.tileSize,
    //             2
    //         );
    //     }
    // }

    render() {
        // this.clear('CONTEXT');
        this.fill('CONTEXT', 'white')
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

    updateRatio() {
        this.ratio.set(this.context.canvas.width / this.buffer.canvas.width, this.context.canvas.height / this.buffer.canvas.height);
    }

    resizeBuffer(mapWidth: number, mapHeight: number, tileSize: number) {
        this.buffer.canvas.width = mapWidth * tileSize;
        this.buffer.canvas.height = mapHeight * tileSize;
        this.updateRatio();
    }

    resizeContext(width: number, height: number) {
        this.context.canvas.width = width;
        this.context.canvas.height = height;
        this.context.imageSmoothingEnabled = false;
        this.camera.update(width, height)
        this.updateRatio();
    }



}

type CANVAS = "CONTEXT" | "BUFFER"