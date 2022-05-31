const gameFrame = document.getElementById("game");
const levelList = document.getElementsByClassName("level");

[].forEach.call(levelList, (level) => {
    level.addEventListener("pointerenter", () => {
        gameFrame.src = `http://localhost:5500/?map-data=${level.dataset.map}`;
    });
    level.addEventListener("click", () => {
        gameFrame.classList.add("fullscreen");
    });
});
