import { api } from "./main.js";

api.registerEvent("onReset", (e) => {
    console.log("Level used");
    console.log(e);
    e.body.data[0] = 1;
});
api.registerEvent("onPlayerMove", (e) => {
    console.log("Player has moved");
    console.log(e);
});
