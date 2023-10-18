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
    update() {
        this.position.x -= player.speed;
        if (this.position.x <= -segmentLenght){
            this.position.x = 1024;
        }
        this.draw()
    }
}

let roadSegment1 = new roadSegment({
    id: 0,
    position: {
        x: 0,
        y: 113
    },
    source: "img/roads/start.jpg"
});

road.push(roadSegment1);

for (i=1; i*segmentLenght<=1024; i++){
    if(i%6==0){
        img = "img/roads/street2.jpg";
    }else{
        img = "img/roads/street1.jpg";
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


