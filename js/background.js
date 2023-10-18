class Sprite {
    constructor({ position, velocity, dimensions}) {
        this.position = position
        this.velocity = velocity
        this.width = dimensions?.width
        this.height = dimensions?.height
    }

    draw() {
        ctx.fillStyle = "#8ce99a"
        ctx.fillRect(this.position.x, this.position.y, this.width, this.height)
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
    }
})