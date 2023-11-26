const ranking = [];
const competitors = [];
const lanes = [576/2+70, 576/2-40, 576/2-150];

class car extends Sprite{
    constructor({ position, source, speed, place}) {
        super({ position, source, speed, place});
        this.position = position;

        this.image = new Image();
        this.image.src = source;

        this.image.onload = () => {
            this.height = this.image.height/3.5;
            this.width = this.image.width/3.5;
        }

        this.speed = speed;
        this.place = place;
        this.lap = 1;

        // if the image breaks, the car is a square
        this.height = 80;
        this.width = 80;
        
    }
    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
        ctx.font = "20px 'Formula 1 regular'";
        ctx.fillStyle = "white";
        ctx.fillText(nomeJogador, this.position.x+this.width/2-50, this.position.y-10);
    }
    update() {
        // order ranking by position
        ranking.sort((a, b) => (a.position.x < b.position.x) ? 1 : -1);
        // update place
        ranking.forEach((car, index) => {
            car.place = index+1;
        });
        this.draw()
    }

    turbo(){
        this.speed = baseSpeed*2.5;
        setTimeout(() => {
            this.speed = baseSpeed;
        }, 1000);
    }

    penalty(){
        this.speed = baseSpeed/2;
        setTimeout(() => {
            this.speed = baseSpeed;
        }, 250);
    }
}

class bot extends Sprite{
    constructor({ position, source}) {
        super({ position, source});
        this.position = position;

        this.image = new Image();
        this.image.src = source;

        this.image.onload = () => {
            this.height = this.image.height/3.5;
            this.width = this.image.width/3.5;
        }

        let maxSpeed = baseSpeed+1.5;
        let minSpeed = baseSpeed+0.5;

        this.speed = Math.random() * (maxSpeed - minSpeed) + minSpeed;

        // if the image breaks, the car is a square
        this.height = 80;
        this.width = 80;
    }
    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
    }
    update() {
        this.position.x += this.speed-player.speed;
        this.draw()
    }

    updateSpeed(){
        this.speed = Math.random() * (maxSpeed - minSpeed) + minSpeed;
    }
}

const player = new car({
    position: {
        x: 100,
        y: 576/2-40
    },
    source: `assets/img/carros/carro${estiloCarro}.png`,
    speed: baseSpeed
});

ranking.push(player);

for (i=0; i<3; i++){
    let carImg = Math.floor(Math.random() * (6 - 1) + 1);
    let newBot = new bot({
        position: {
            x: 100,
            y: lanes[i]
        },
        source: `assets/img/carros/carro${carImg}.png`
    });
    console.log(newBot);
    competitors.push(newBot);
    ranking.push(newBot);
}