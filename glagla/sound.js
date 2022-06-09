const music = document.createElement("audio");
music.setAttribute("id", "music");
music.setAttribute("src", "music/Ice_Path.mp3");
music.setAttribute("type", "audio/mp3");
music.setAttribute("controls", "controls");
music.setAttribute("autoplay", "autoplay");
music.setAttribute("loop", "loop");
music.style.display = "none";
document.body.appendChild(music);

function playPause() {
    console.log(`${music.paused}`);
    music.paused ? music.play() : music.pause();
    playPauseBTN.classList.toggle("mute");
}

const volumeInput = document.getElementById("sound-volume");

volumeInput.addEventListener("input", () => {
    music.volume = volumeInput.value / 100;
});
