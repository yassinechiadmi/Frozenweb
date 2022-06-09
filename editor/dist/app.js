import { Display } from "./class/display.js";
import { Map } from "./class/map.js";
import { Sheet } from "./class/sheet.js";
import { Vec2 } from "./class/vec2.js";
import baseLevel from "./map.js";
let lvl = JSON.stringify(baseLevel);
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has("map-data")) {
    lvl = decodeURI(urlParams.get("map-data"));
}
else if (localStorage.getItem("map-edit") != null) {
    lvl = localStorage.getItem("map-edit");
}
const tilesheetElem = document.getElementById('tilesheet');
const canvasElem = document.getElementById('editor');
const newMapForm = document.getElementById('newMap');
const downloadElem = document.getElementById('download');
const publishElem = document.getElementById('publish');
const testElem = document.getElementById('test');
const tileSheet = new Sheet(tilesheetElem, 16);
const map = new Map(JSON.parse(lvl));
const editor = new Display(canvasElem);
tileSheet.addTile('./assets/path.png', -3);
tileSheet.addTile('./assets/ice.png', -1);
tileSheet.addTile('./assets/wall.png', -2);
tileSheet.addTile('./assets/rock.png', 0);
tileSheet.addTile('./assets/point_up.png', 1);
tileSheet.addTile('./assets/point_right.png', 2);
tileSheet.addTile('./assets/point_down.png', 3);
tileSheet.addTile('./assets/point_left.png', 4);
tileSheet.addTile('./assets/breaking.png', 5);
tileSheet.addTile('./assets/breaked.png', 6);
tileSheet.addTile('./assets/start.png', -20);
tileSheet.addTile('./assets/end.png', -21);
function render() {
    editor.fill('BUFFER', 'pink');
    editor.drawMap(tileSheet, map);
    editor.drawTile(tileSheet.tiles.find((tile) => tile.index == -20)?.image, map.start, tileSheet.tileSize);
    editor.drawTile(tileSheet.tiles.find((tile) => tile.index == -21)?.image, map.end, tileSheet.tileSize);
    editor.drawRectangle(editor.tileIndex.x * tileSheet.tileSize, editor.tileIndex.y * tileSheet.tileSize, tileSheet.tileSize, tileSheet.tileSize, "rgba(0, 0, 0, 0.6)");
    editor.resizeContext(document.documentElement.clientWidth, document.documentElement.clientHeight);
    editor.camera.update(editor.context.canvas.width, editor.context.canvas.height);
    editor.render();
    editor.drawGrid(map.width, map.height, tileSheet.tileSize);
}
tileSheet.registerClickEvent();
newMapForm.lastElementChild?.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    console.log(newMapForm.children.namedItem('width')?.value);
    map.width = Number(newMapForm.children.namedItem('width')?.value);
    map.height = Number(newMapForm.children.namedItem('height')?.value);
    map.data.length = map.width * map.height;
    editor.resizeBuffer(map.width, map.height, tileSheet.tileSize);
    editor.resizeContext(document.documentElement.clientWidth, document.documentElement.clientHeight);
    render();
});
window.addEventListener('resize', (e) => {
    editor.render();
});
canvasElem.addEventListener('mousemove', (e) => {
    const offX = e.offsetX * (editor.camera.pos2.x / editor.context.canvas.width) + editor.camera.pos1.x;
    const offY = e.offsetY * (editor.camera.pos2.y / editor.context.canvas.height) + editor.camera.pos1.y;
    editor.tileIndex.set(Math.floor(offX / tileSheet.tileSize), Math.floor(offY / tileSheet.tileSize));
    render();
});
window.addEventListener("wheel", (event) => {
    editor.camera.zoom += event.deltaY * 0.02 * editor.camera.zoom / 100;
    render();
});
let mouseDown = false;
let button;
canvasElem.addEventListener("mousedown", (e) => {
    button = e.button;
    mouseDown = true;
});
window.addEventListener("mousemove", (event) => {
    if (mouseDown && button == 1) {
        editor.camera.posC.x += event.movementX * -0.39 * editor.camera.zoom / 50;
        editor.camera.posC.y += event.movementY * -0.39 * editor.camera.zoom / 50;
    }
    if (mouseDown && button == 0 && editor.tileIndex.y < map.height && editor.tileIndex.x < map.width) {
        if (tileSheet.tiles[tileSheet.tileIndex].index == -20) {
            map.start = new Vec2(editor.tileIndex.x, editor.tileIndex.y);
        }
        else if (tileSheet.tiles[tileSheet.tileIndex].index == -21) {
            map.end = new Vec2(editor.tileIndex.x, editor.tileIndex.y);
        }
        else {
            map.data[editor.tileIndex.y * map.width + editor.tileIndex.x] = tileSheet.tiles[tileSheet.tileIndex].index;
        }
    }
    render();
});
window.addEventListener("mouseup", () => {
    mouseDown = false;
    if (button == 0 && editor.tileIndex.y < map.height && editor.tileIndex.y > 0 && editor.tileIndex.x < map.width && editor.tileIndex.x > 0) {
        if (tileSheet.tiles[tileSheet.tileIndex].index == -20) {
            map.start.set(editor.tileIndex.x, editor.tileIndex.y);
        }
        else if (tileSheet.tiles[tileSheet.tileIndex].index == -21) {
            map.end.set(editor.tileIndex.x, editor.tileIndex.y);
        }
        else {
            map.data[editor.tileIndex.y * map.width + editor.tileIndex.x] = tileSheet.tiles[tileSheet.tileIndex].index;
        }
    }
    localStorage.setItem('map-edit', JSON.stringify(map));
    render();
});
downloadElem.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(JSON.stringify(map).replaceAll("null", "-1")));
    element.setAttribute('download', "map.json");
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
});
if (urlParams.has("map-id")) {
    console.log(urlParams.get("map-id"));
    publishElem.textContent = "Publish Edit";
    publishElem.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        document.location.href = 'http://localhost/create.php?map-id=' + urlParams.get('map-id') + '&map-data=' + encodeURIComponent(JSON.stringify(map).replaceAll("null", "-1"));
    });
}
else {
    publishElem.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        document.location.href = 'http://localhost/create.php?map-data=' + encodeURIComponent(JSON.stringify(map).replaceAll("null", "-1"));
    });
}
testElem.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    document.location.href = 'https://bafbi.github.io/glagla/?map-data=' + encodeURIComponent(JSON.stringify(map).replaceAll("null", "-1"));
});
editor.camera.posC.set(map.width * tileSheet.tileSize, map.height * tileSheet.tileSize);
editor.resizeBuffer(map.width, map.height, tileSheet.tileSize);
render();
