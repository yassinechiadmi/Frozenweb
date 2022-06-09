import { Tile } from "./tile.js";
export class Sheet {
    container;
    tiles = new Array();
    tileSize;
    tileIndex = 0;
    constructor(container, tileSize) {
        this.container = container;
        this.tileSize = tileSize;
    }
    registerClickEvent() {
        this.container.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            console.log(e.target);
            this.tiles.forEach((tile, index) => {
                tile.image.parentElement?.classList.remove('selected');
                if (tile.image.isSameNode(e.target)) {
                    this.tileIndex = index;
                }
            });
            const img = e.target;
            img.parentElement?.classList.add('selected');
            console.log(this.tileIndex);
        });
    }
    addTile(imgSrc, index) {
        const li = document.createElement('li');
        const img = document.createElement('img');
        img.src = imgSrc;
        this.tiles.push(new Tile(img, index));
        li.appendChild(img);
        this.container.appendChild(li);
    }
}
