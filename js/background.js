class Sprite {
    constructor({ position, velocity, dimensions, source}) {
        this.position = position
        this.velocity = velocity
        this.width = dimensions?.width
        this.height = dimensions?.height
        this.image = new Image()
        this.image.src = source
    }

    draw() {
        ctx.drawImage(this.image, this.position.x, this.position.y, this.width, this.height)
    }

    update() {
        this.draw()
    }
}

const background = new Sprite({
    position: {
        x: 0,
        y: 0
    }, 
    dimensions: {
        width: 1024,
        height: 576
    },
    source: "img/roads/background.png"
})