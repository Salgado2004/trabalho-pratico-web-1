const scene = document.querySelector(".scene");
const ctx = scene.getContext("2d");

const canvasWidth = 1024;
const canvasHeight = 576;

let goAudio;
let end = false;

scene.width = canvasWidth;
scene.height = canvasHeight;

const time = {
    minuto: 0,
    segundo: 0,
    totalSegundos: 0
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

    if (time.minuto == tempoMax || player.lap == voltasMax){
        finish();
    }

}

async function play(){
    try{
        let response = await fetch("assets/words.json");
        let json = await response.json();
        let possibleWords = json.palavras[dificuldade];
        wordsInterval = generateWords(possibleWords);

        seconds = setInterval(() => {
            time.segundo++;
            time.totalSegundos++;
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
    let startAudio = new Audio("assets/music/start.mp3");
    startAudio.play();
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
    }, 1800);
    startAudio.onended = () => {
        goAudio = new Audio(`assets/music/${estilo}.mp3`);
        goAudio.play();
    }
}

function finish(){
    if (!end){
        end = true;
        clearInterval(seconds);
        clearInterval(wordsInterval);
        goAudio.pause();

        let finalPlace = player.place;

        switch (finalPlace){
            case 1:
                bonusPosition = 100;
                finalAudio = new Audio("assets/music/final1.mp3");
                break;
            case 2:
                bonusPosition = 50;
                finalAudio = new Audio("assets/music/final1.mp3");
                break;
            case 3:
                bonusPosition = 25;
                finalAudio = new Audio("assets/music/final2.mp3");
                break;
            default:
                bonusPosition = 0;
                finalAudio = new Audio("assets/music/final2.mp3");
                break;
        }
        finalAudio.play();
        points = ((wordsWritten-wordsLost)*10)+((tempoMax*60)-time.totalSegundos)+bonusPosition;

        switch(dificuldade){
            case "facil":
                points *= 1;
                break;
            case "medio":
                points *= 1.5;
                break;
            case "dificil":
                points *= 2;
                break;
            case "impossivel":
                points *= 10;
                break;
        }

        points = points > 0 ? Math.floor(points) : 0;

        let banner = document.createElement("div");
        banner.classList.add("banner");
        banner.innerHTML = `
        <span>Fim de jogo!</span>
        <h2>Você terminou em ${finalPlace}º Lugar!</h2>
        <h3>Palavras escritas: +${wordsWritten}</h3>
        <h3>Palavras perdidas: -${wordsLost}</h3>
        <h3>Bônus de tempo: +${(tempoMax*60)-time.totalSegundos}</h3>
        <h3>Bônus de posição: +${bonusPosition}</h3>
        <h2>Total: ${points}</h2>`;
        document.body.appendChild(banner);

        let request = new XMLHttpRequest();
        request.open("POST", "endgame.php", true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        const params = new URLSearchParams();
        params.append('points', encodeURIComponent(points));
        params.append('time', encodeURIComponent(time.totalSegundos));
        params.append('modo', '0');

        request.send(params.toString());

        setTimeout(() => {
            window.location.href = "home/home.php";
        }, 10000);

    }
}

