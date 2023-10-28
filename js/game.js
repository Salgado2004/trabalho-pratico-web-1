const scene = document.querySelector(".scene");
const ctx = scene.getContext("2d");

const canvasWidth = 1024;
const canvasHeight = 576;

scene.width = canvasWidth;
scene.height = canvasHeight;

const time = {
    minuto: 0,
    segundo: 0
}

let lastLap = 0;

let distance = 0;

const playerPlace = document.querySelector(".player-place");
const lapCount = document.querySelector(".lap-count");
const timeCount = document.querySelector(".time");


function animate(){
    window.requestAnimationFrame(animate);

    ctx.fillStyle = "white";
    ctx.fillRect(0,0, canvasWidth, canvasHeight);

    background.update();
    road.forEach(roadSegment => roadSegment.update());
    competitors.forEach(bot => bot.update());
    player.update();
    words.forEach(word => word.update());

    timeCount.textContent = time.minuto.toString().padStart(2, "0")+":"+time.segundo.toString().padStart(2, "0");
    playerPlace.textContent = player.place+"º Posição";
    lapCount.textContent = "Volta: "+player.lap;

}

async function play(){
    try{
        let response = await fetch("assets/words.json");
        let json = await response.json();
        let possibleWords = json.palavras[dificuldade];
        generateWords(possibleWords);

        seconds = setInterval(() => {
            time.segundo++;
            if(time.segundo == 60){
                time.segundo = 0;
                time.minuto++;
            }
        }, 1000);
        animate();

    } catch (err){
        console.log(err);
    }
}

function countLap(){
    if (lastLap > ((time.segundo+time.minuto*60)-2)){
        return;
    } else{
        lastLap = time.segundo+time.minuto*60;
        player.lap++;
        competitors.forEach(bot => bot.updateSpeed());
    }
}

function start(){
    let banner = document.querySelector(".banner");
    banner.innerHTML = "<span>Se prepare!</span>";
    // countdown from 3 to 0 and then call play()
    let countdown = 3;
    let countdownInterval = setInterval(() => {
        if (countdown == 0){
            clearInterval(countdownInterval);
            banner.remove();
            play();
        } else{
            banner.innerHTML = "<span>"+countdown+"</span>";
            countdown--;
        }
    }, 1500);
}

