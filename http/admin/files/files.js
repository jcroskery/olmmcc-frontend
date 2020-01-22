let audio_created = false;
const displaySong = () => {
    let audio;
    if (!audio_created) {
        let br = document.createElement("br");
        audio = document.createElement("audio");
        audio.id = "audio";
        audio.controls = true;
        let violinDiv = document.getElementById("violinDiv");
        violinDiv.appendChild(br);
        violinDiv.appendChild(br.cloneNode(false));
        violinDiv.appendChild(audio);
        audio_created = true;
    } else {
        audio = document.getElementById("audio");
    }
    let input = document.getElementById("song").value;
    audio.src = "Track " + input + ".mp3";
};
let song = document.getElementById("song");
song.addEventListener("change", displaySong);
window.addEventListener("keypress", (ev) => {
    if(ev.key == "Enter") {
        displaySong()
    }
});
