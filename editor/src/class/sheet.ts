import { Tile } from "./tile.js";

export class Sheet {

    container: HTMLOListElement;
    tiles: Tile[] = new Array<Tile>();
    tileSize: number;
    tileIndex: number = 0;

    constructor(container: HTMLOListElement, tileSize: number) {
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
                if (tile.image.isSameNode(e.target as Node)) {
                    this.tileIndex = index;
                }
            })
            const img = e.target as Node;
            img.parentElement?.classList.add('selected');
            console.log(this.tileIndex);
        })
    }

    addTile(imgSrc: string, index: number) {
        const li = document.createElement('li');
        const img = document.createElement('img');
        img.src = imgSrc;
        this.tiles.push(new Tile(img, index));
        li.appendChild(img);
        this.container.appendChild(li);
    }
}