const options = document.getElementById("opt-tipe");
const nilai = document.getElementById("number");
const hasil = document.getElementById("hasil");
function calculate() {
    var n = parseInt(nilai.value)
    var op = options.value
    if (op == "" || isNaN(n)) {
        hasil.innerHTML = "Masukan nilai untuk hasil.";
    }
    else {
        if (op == "1") {
            hasil.innerHTML = (`Ke Fahrenheit = ${(n * 9 / 5) + 32}, Ke Kelvin = ${(n) + 273}`)
        } else if (op == "2") {
            hasil.innerHTML = `Ke Celcius = ${(n - 32) * 5 / 9}, Ke Kelvin = ${n + 273}`
        } else if (op == "3") {
            hasil.innerHTML = `Ke Celcius = ${n - 273}, Ke Kelvin = ${n + 32}`
        }
    };


}
options.addEventListener("change", function () {
    calculate()
});
nilai.addEventListener("input", function () {
    calculate()
});
