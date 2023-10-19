const scene = document.querySelector(".scene");
const ctx = scene.getContext("2d");

const canvasWidth = 1024;
const canvasHeight = 576;

scene.width = canvasWidth;
scene.height = canvasHeight;

let prevTime = 0;

const playerPlace = document.querySelector(".player-place");
const lapCount = document.querySelector(".lap-count");


function animate(){
    window.requestAnimationFrame(animate);

    ctx.fillStyle = "white";
    ctx.fillRect(0,0, canvasWidth, canvasHeight);

    background.update();
    road.forEach(roadSegment => roadSegment.update());
    player.update();
    competitor.update();
    words.forEach(word => word.update());

    playerPlace.textContent = player.place+"º Posição";
    lapCount.textContent = "Volta: "+player.lap;

    // FPS
    let delta = (performance.now() - prevTime)/1000;
    let fps = 1 / delta;

    prevTime = performance.now();
    //console.log(`FPS: ${fps}`);
}

let dificuldade = "facil";

function play(){
    fetch("assets/words.json")
        .then(response => response.json())
        .then(json => {
            let possibleWords = json.palavras[dificuldade];
            generateWords(possibleWords);
        });

    animate();
}

function pause(){
    window.cancelAnimationFrame(animate);
    player.speed = 0;
}

play();