const ranking = [];

class car extends Sprite{
    constructor({ position, source, speed, place}) {
        super({ position, source, speed, place});
        this.position = position;
        this.image = new Image();
        this.image.src = source;
        this.speed = speed;
        this.place = place;
        this.lap = 1;

        this.height = this.image.height/3.5;
        this.width = this.image.width/3.5;
    }
    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
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
        this.speed += 3;
        setTimeout(() => {
            this.speed -= 3;
        }, 1000);
    }
}

class bot extends Sprite{
    constructor({ position, source, speed, place}) {
        super({ position, source, speed, place});
        this.position = position;
        this.image = new Image();
        this.image.src = source;
        this.speed = speed;
        this.place = place;

        this.height = this.image.height/3.5;
        this.width = this.image.width/3.5;
    }
    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
    }
    update() {
        this.position.x += this.speed-player.speed;
        this.draw()
    }
}

const player = new car({
    position: {
        x: 100,
        y: 576/2-40
    },
    source: "img/carros/carro1.png",
    speed: 2
});

ranking.push(player);

const competitor = new bot({
    position: {
        x: 80,
        y: 576/2+40
    },
    source: "img/carros/carro2.png",
    speed: 2.5
});

ranking.push(competitor);