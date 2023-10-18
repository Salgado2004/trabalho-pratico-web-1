const scene = document.querySelector(".scene");
const ctx = scene.getContext("2d");

const canvasWidth = 1024;
const canvasHeight = 576;

scene.width = canvasWidth;
scene.height = canvasHeight;

let prevTime = 0;


function animate(){
    window.requestAnimationFrame(animate);

    ctx.fillStyle = "white";
    ctx.fillRect(0,0, canvasWidth, canvasHeight);

    background.update();
    road.forEach(roadSegment => roadSegment.update());
    words.forEach(word => word.update());
    player.update();
    competitor.update();

    // FPS
    let delta = (performance.now() - prevTime)/1000;
    let fps = 1 / delta;

    prevTime = performance.now();
    //console.log(`FPS: ${fps}`);
}

function play(){
    animate();
}

function pause(){
    window.cancelAnimationFrame(animate);
    player.speed = 0;
}

play();