let time = 30;
var isPlaying = true;
const output = document.querySelector(".output");
const box = document.createElement("div");
const timerID = document.getElementById("timer");
const poin = document.querySelector(".message");
const start_box = document.getElementById("start-box");
var timerInterval;
var click = 0;




function timer() {
    timerInterval = setInterval(() => {
        if (time == 0) {
            clearInterval(timerInterval)
            isPlaying = false;
        } else {
            time--;
            document.getElementById("timer").innerHTML = time;
        };
    }, 1000);
}

function ulang() {
    box.classList.add("box");
    output.append(box);

    // Langsung tampilkan box pertama untuk trigger start
    box.style.display = "block";
    box.style.top = "50px";
    box.style.left = "45%";
    box.style.textAlign = "center";
    box.style.lineHeight = "100px";


    addBox()
    if (isPlaying == true) {
        setTimeout("ulang()", 1000);
    } else {
        poin.innerHTML = `Final Score ${click}`;
        box.innerHTML = "AGAIN?";
        box.style.color = "white";
        box.style.display = "flex";
        box.style.alignItems = "center";
        box.style.justifyContent = "center"
    }

}

function randomNumbers(max) {
    return Math.floor(Math.random() * max);
}

function addBox() {

    const dimX = randomNumbers(50) + 10;
    const dimY = randomNumbers(50) + 10;

    box.style.display = "block";
    box.style.width = `${dimX}px`;
    box.style.height = `${dimY}px`;
    box.style.backgroundColor = "#" + Math.random().toString(16).substr(-6);

    // Pastikan posisi tetap di dalam kontainer output
    box.style.left = randomNumbers(900) + "px";
    box.style.top = randomNumbers(600) + "px";
    box.style.borderRadius = randomNumbers(50) + "%";
}


box.addEventListener("click", function () {
    if (isPlaying == true) {
        click += 1;
        poin.innerHTML = `Score ${click}`;
        console.log("clicked");
    } else {
        start();
    }
});

function start() {
    if (isPlaying) {
        poin.innerHTML = "Click as fast as you can!!";
        start_box.style.display = 'none';
        timer()
        ulang()
    } else {
        box.style.display = 'none';
        poin.innerHTML = "Click as fast as you can!!";
        time = 30
        click = 0;
        isPlaying = true;
        box.innerHTML = "";
        document.getElementById("timer").innerHTML = time;
        timer()
        ulang()
    }

}



