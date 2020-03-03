let audio_created = false;
const lista = [
    ["Sonatine", 1], 
    ["The Infant Paganini", 2], 
    ["Concertino in the Style of Vivaldi", 3],
    ["Concertino in the Style of Mozart", 4],
    ["Concerto in B Minor", 5]
];
const listb = [
    ["Sonata in F Major", 6],
    ["Sarabande", 7],
    ["Giguetta", 8], 
    ["Bourree", 9]
];
const listc = [
    ["The Song of Twilight", 10],
    ["Soldatenmarsch", 11],
    ["The Faun", 12],
    ["Summer Song", 13],
    ["Merry-Go-Round", 14],
    ["Neapolitan Dance", 15],
    ["Knight Rupert", 16],
    ["Fast Dance", 17]
];
function changeSong(input) {
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
    audio.src = "Track " + input + ".mp3";
}

function clearList() {
    let list = document.getElementById("song");
    while (list.firstChild) {
        list.removeChild(list.lastChild);
    }
}
function setList(list) {
    let songs = document.getElementById("song");
    for(let i = 0; i < list.length; i++) {
        let option = document.createElement("option");
        if (document.getElementById("instruments").value == "piano") {
            option.value = list[i][1] + 17;
        } else {
            option.value = list[i][1];
        }
        option.textContent = list[i][0];
        songs.appendChild(option);
    }
}
function changeList(value) {
    switch(value) {
        case 'a': {
            clearList();
            setList(lista);
            break;
        }
        case 'b': {
            clearList();
            setList(listb);
            break;
        }
        case 'c': {
            clearList();
            setList(listc);
            break;
        }
    }
    changeSong(document.getElementById("song").value)
}
document.getElementById("list").onchange = (e) => {
    changeList(e.target.value);
};
changeList(document.getElementById("list").value);
document.getElementById("song").onchange = (e) => {
    changeSong(e.target.value);
}
document.getElementById("instruments").onchange = () => {
    changeList(document.getElementById("list").value);
}