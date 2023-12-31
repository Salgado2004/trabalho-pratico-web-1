const words = [];
let wordsWritten =0;
let wordsLost=0;

class word extends Sprite{
    constructor({ position, text}) {
        super({ position, text});
        this.position = position;
        this.text = text;
    }
    draw() {
        ctx.font = "40px 'Black Ops One'";
        ctx.fillStyle = "black";
        ctx.fillText(this.text, this.position.x+3, this.position.y+2);
        ctx.fillStyle = "yellow";
        ctx.fillText(this.text, this.position.x, this.position.y);
        ctx.strokeStyle = "red";
        ctx.strokeText(this.text, this.position.x, this.position.y);
    }

    update() {
        this.position.x -= player.speed;
        if (this.position.x <= player.position.x+player.width){
            this.remove();
            wordsLost++;
            player.penalty();
        } else {
            this.draw();
        }
    }

    write(key) {
        if(this.text[0].toLowerCase() == key){
            this.text = this.text.slice(1);
            if(this.text.length == 0){
                player.turbo();
                wordsWritten++;
                this.remove();
            }
        }
    }

    remove() {
        let index = words.indexOf(this);
        words.splice(index, 1);
    }
}

// Random number between 900 and 1024
function randomPositionX(){
    return Math.floor(Math.random() * (1024 - 800) + 800);
}

// Random number between 113 and 463
function randomPositionY(){
    return Math.floor(Math.random() * (463 - 113) + 113);
}

function generateWords(possibleWords){
    //a cada 1.5 segundo, gera uma palavra aleatória
    let wordInterval = setInterval(() => {
        let newWord = new word({
            position: {
                x: randomPositionX(),
                y: randomPositionY()
            },
            text: possibleWords[Math.floor(Math.random() * possibleWords.length)].toUpperCase()
        });
        if (words.length < 8){
            words.push(newWord);
        }
    }, 1500);

    window.addEventListener("keydown", (e) => {
        words.forEach(word => word.write(e.key));
    });

    return wordInterval;
}

