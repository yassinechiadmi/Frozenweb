"use strict";

//////////////////////////
//#region *Url param* //

import baseLevel from "./level/map.js";

let lvl = JSON.stringify(baseLevel);

const urlParams = new URLSearchParams(window.location.search); // get url params
let path = [];

if (urlParams.has("map-data")) {
    lvl = decodeURI(urlParams.get("map-data"));

    if (urlParams.has("path")) {
        path = urlParams.get("path");
        console.log(path);
        localStorage.setItem("tmp_path", path);
    } else localStorage.setItem("tmp_path", "[]");

    if (urlParams.has("map-id")) {
        localStorage.setItem("tmp_id", urlParams.get("map-id"));
    }
    localStorage.setItem("tmp-level", lvl);

    window.location.replace(window.location.pathname);
} else if (localStorage.getItem("tmp-level") !== null) {
    lvl = localStorage.getItem("tmp-level");
    if (localStorage.getItem("tmp_path") !== null) {
        path = JSON.parse(localStorage.getItem("tmp_path"));
    }
}

console.log(path);

//#endregion            //
//////////////////////////

////////////////////////////
//#region *Import modules* ///

import { Vec2 } from "./game_modules/utils.js";
import { Display } from "./game_modules/display.js";
import { Controller } from "./game_modules/controller.js";
import { Game } from "./game_modules/game.js";
import { Engine } from "./game_modules/engine.js";

//#endregion              //
////////////////////////////

/////////////////////
//#region *Function* //

function render() {
    display.drawMap(game.world.level.data, game.world.level.width); // draw the map
    display.drawWall(game.world.level.width, game.world.level.height); // draw the walls
    display.drawTile(
        { x: game.world.level.end.x + 1, y: game.world.level.end.y + 1 },
        19
    ); // draw the end tile
    display.drawTile(
        { x: game.world.level.start.x + 1, y: game.world.level.start.y + 1 },
        18
    ); // draw the start tile
    if (cheat) display.drawPath(path, game.world.level.width); // draw the path
    display.drawPlayer(
        game.world.player.displayPos,
        game.world.player.lastDir,
        game.world.player.animation.currentAnim,
        game.world.player.animation.currentFrame
    ); // draw the player
    display.updateCamera(); // update camera
    display.render(); // render the game
    counter.innerHTML = game.world.player.moveCount; // update the counter
}
function update() {
    if (!keyBlock) {
        Object.keys(controller).forEach((key, index) => {
            if (controller[key].active) {
                controller[key].callback();
                controller[key].active = !controller[key].slow;
            }
        });
    }

    game.world.player.animation.update(engine.time); // update animation
    // console.log(engine.time);
    if (game.world.distanceOfEnd() < 0.2 && !game.win) {
        game.win = true;
        game.world.player.pos.copy(game.world.player.displayPos);
        post("http://localhost/completed.php", {
            id: localStorage.getItem("tmp_id"),
            move: game.world.player.moveCount,
        });
    }

    game.update(); // update the game
}

function reloadDisplay() {
    display.buffer.canvas.height =
        (game.world.level.height + 2) * display.tileSheet.tileSize;
    display.buffer.canvas.width =
        (game.world.level.width + 2) * display.tileSheet.tileSize; // +2 for the walls
    display.resize(
        document.documentElement.clientWidth,
        document.documentElement.clientHeight,
        (game.world.level.height + 2) / (game.world.level.width + 2) // aspect ratio
    );
}

function post(path, params, method = "post") {
    // The rest of this code assumes you are not using a library.
    // It can be made less verbose if you use one.
    const form = document.createElement("form");
    form.method = method;
    form.action = path;

    for (const key in params) {
        if (params.hasOwnProperty(key)) {
            const hiddenField = document.createElement("input");
            hiddenField.type = "hidden";
            hiddenField.name = key;
            hiddenField.value = params[key];

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

//#endregion      //
/////////////////////

////////////////////
//#region *Objects* //

const gameWindow = document.getElementById("gameWindow");
const display = new Display(gameWindow);
const controller = new Controller();
const game = new Game(lvl);
const engine = new Engine(1000 / 30, render, update);
const menu = document.getElementById("menu");
const counter = document.getElementById("move-counter");
let keyBlock = false;
let cheat = false;

//#endregion      //
////////////////////

///////////////////////
//#region *Listeners*//

//#region File loader //
const dropArea = document.getElementById("drop-area");

window.addEventListener("dragover", (event) => {
    event.stopPropagation();
    event.preventDefault();
    // Style the drag-and-drop as a "copy file" operation.
    event.dataTransfer.dropEffect = "copy";
});

window.addEventListener("drop", (event) => {
    event.stopPropagation();
    event.preventDefault();
    const fileList = event.dataTransfer.files;
    console.log(fileList.item(0));
    if (
        fileList.length > 1 ||
        (!fileList.item(0).name.includes(".ice") &&
            fileList.item(0).type != "application/json")
    ) {
        console.error("wrong format : .ice espected");
        return;
    }
    const reader = new FileReader();
    reader.addEventListener("load", (event) => {
        const rawdata = event.target.result;
        localStorage.setItem("tmp-level", rawdata);
        localStorage.setItem("tmp_id", null);
        window.location.search = "";
        // const importLevel = JSON.parsetion(rawdata);
        // console.log(importLevel);
        // game.level = importLevel;
        // game.reset();
        // reloadDisplay();
    });
    reader.readAsText(fileList.item(0));
});

//#endregion

//#region Controler //
window.addEventListener("keydown", (event) => {
    controller.keyDownUp(event.type, event.key);
    // console.log(event.key);
});
window.addEventListener("keyup", (event) =>
    controller.keyDownUp(event.type, event.key)
);
window.addEventListener("resize", () => {
    display.resize(
        document.documentElement.clientWidth,
        document.documentElement.clientHeight,
        (game.world.level.height + 2) / (game.world.level.width + 2) // aspect ratio
    );
});
//#endregion

const ctn_btn = document.getElementById("continue_btn");

ctn_btn.addEventListener("click", () => {
    menu.classList.toggle("disable");
    gameWindow.classList.toggle("disable");
});

const edit_btn = document.getElementById("edit_btn");

edit_btn.addEventListener("click", () => {
    window.location =
        localStorage.getItem("editorUrl") +
        "?map-data=" +
        JSON.stringify(game.world.level);
});

//#region Camera //
window.addEventListener("wheel", (event) => {
    display.camera.zoom += event.deltaY * 0.01 * (display.camera.zoom / 80);
});

let mouseDown = false;
let startX;
let startY;
window.addEventListener("mousedown", (event) => {
    mouseDown = true;
    startX = event.clientX;
    startY = event.clientY;
});
window.addEventListener("mousemove", (event) => {
    if (mouseDown) {
        display.camera.posC.x +=
            (event.clientX - startX) * -0.02 * (display.camera.zoom / 100);
        display.camera.posC.y +=
            (event.clientY - startY) * -0.02 * (display.camera.zoom / 100);
        startX = event.clientX;
        startY = event.clientY;
    }
});
window.addEventListener("mouseup", (event) => {
    mouseDown = false;
});
//#endregion

//#endregion         //
///////////////////////

//////////////////////////////
//#region Controle register //
controller.register(
    "center",
    " ",
    () => {
        display.camera.posC.copy(game.world.player.pos);
        console.log(display.camera);
    },
    true
);
controller.register(
    "cam",
    "m",
    () => {
        display.toggleCameraMode(
            document.documentElement.clientWidth,
            document.documentElement.clientHeight,
            (game.world.level.height + 2) / (game.world.level.width + 2)
        );
        display.camera.posC.copy(game.world.player.pos);
    },
    true
);
controller.register(
    "reset",
    "r",
    () => {
        game.reset();
    },
    true
);
controller.register(
    "up",
    ["z", "ArrowUp"],
    () => {
        if (!game.world.player.moving) game.world.player.move({ x: 0, y: -1 });
    },
    true
);
controller.register(
    "right",
    ["d", "ArrowRight"],
    () => {
        if (!game.world.player.moving) game.world.player.move({ x: 1, y: 0 });
    },
    true
);
controller.register(
    "down",
    ["s", "ArrowDown"],
    () => {
        if (!game.world.player.moving) game.world.player.move({ x: 0, y: 1 });
    },
    true
);
controller.register(
    "left",
    ["q", "ArrowLeft"],
    () => {
        if (!game.world.player.moving) game.world.player.move({ x: -1, y: 0 });
    },
    true
);
controller.register(
    "esc",
    ["Escape"],
    () => {
        // console.log(engine.running);
        menu.classList.toggle("disable");
        gameWindow.classList.toggle("disable");
        // if (engine.running) engine.stop();
        // else engine.start();
    },
    true
);
controller.register(
    "return",
    ["v"],
    () => {
        // console.log(engine.running);
        window.location = "http://localhost/game.php";
        // menu.classList.toggle("disable");
        // gameWindow.classList.toggle("disable");
        // if (engine.running) engine.stop();
        // else engine.start();
    },
    true
);
controller.register(
    "edit",
    ["e"],
    () => {
        window.location =
            localStorage.getItem("editorUrl") +
            "?map-data=" +
            JSON.stringify(game.world.level);
        // window.location =
        //     "https://bafbi.github.io/2d-tilemap-editor/?map-data=" +
        //     JSON.stringify(game.world.level);
    },
    true
);

controller.register(
    "changeUrl",
    ["E"],
    () => {
        keyBlock = true;
        const input = document.createElement("input");
        input.type = "text";
        input.placeholder = "Editor Url";
        input.style =
            "position: absolute; top: 50%; left: 50%; width: 10rem; height: 2rem;";
        document.body.appendChild(input);
        input.focus();
        input.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                localStorage.setItem("editorUrl", input.value);
                input.remove();
                keyBlock = false;
            }
        });
    },
    true
);
controller.register(
    "cheat",
    ["c"],
    () => {
        cheat = !cheat;
    },
    true
);

//#endregion                //
//////////////////////////////

//////////////////
/// Initialize ///
//////////////////
export const api = {
    registerEvent(type, callback) {
        game.registerEvent(type, callback);
    },
};

display.tileSheet.image.src = "./assets/tilesheet.png";
display.player.image.src = "./assets/player.png";

display.tileSheet.image.onload = () => {
    reloadDisplay();
    engine.start();
};
