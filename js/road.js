const road = [];
const segmentLenght = 64;
const roadWidth = 350;

class roadSegment extends Sprite{
    constructor({ id, position, source}) {
        super({ id, position});
        this.id = id;
        this.position = position;
        this.height = roadWidth;
        this.width = segmentLenght;
        this.image = new Image();
        this.image.src = source;
    }
    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
    }

    // check if the player is in this segment
    check(){
        if (player.position.x >= this.position.x && player.position.x <= this.position.x+segmentLenght){
            return true;
        } else {
            return false;
        }
    }

    update() {
        this.position.x -= player.speed;
        if (this.position.x <= -segmentLenght){
            this.position.x = 1024;
        }
        if (this.id == 3 && this.check()){
            countLap();
        }
        this.draw()
    }
}

for (i=0; i<=18; i++){
    if(i%3==0){
        img = `assets/img/roads/${style}/street2.jpg`;
    }else{
        img = `assets/img/roads/${style}/street1.jpg`;
    }
    if (i == 3){
        img = `assets/img/roads/${style}/start.jpg`;
    }
    road.push(
        new roadSegment({
            id: i,
            position: {
                x: i*segmentLenght,
                y: 576/2-175
            },
            source: img
        })
    );
}


