
class car extends Sprite{
    constructor({ position, source, speed}) {
        super({ position, source, speed});
        this.position = position;
        this.image = new Image();
        this.image.src = source;
        this.speed = speed;

        this.height = this.image.height/3.5;
        this.width = this.image.width/3.5;
    }
    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
    }
    update() {
        this.draw()
    }

    turbo(){
        this.speed = 5;
        setTimeout(() => {
            this.speed = 1;
        }, 1000);
    }
}

class bot extends Sprite{
    constructor({ position, source, speed}) {
        super({ position, source, speed});
        this.position = position;
        this.image = new Image();
        this.image.src = source;
        this.speed = speed;

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
    speed: 1
});

const competitor = new bot({
    position: {
        x: 80,
        y: 576/2+40
    },
    source: "img/carros/carro2.png",
    speed: 1.5
});