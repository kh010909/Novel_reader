function start() {
    var black = document.getElementById("bg-button-dark");
    black.onclick = dark;
    var gray = document.getElementById("bg-button-secondary");
    gray.onclick = secondary;
    var white = document.getElementById("bg-button-light");
    white.onclick = light;
    var Kai = document.getElementById("font-button-cwTeXKai");
    Kai.onclick = cwTeXKai;
    var Yen = document.getElementById("font-button-cwTeXYen");
    Yen.onclick = cwTeXYen;
    var Noto = document.getElementById("font-button-Noto-Sans-TC");
    Noto.onclick = Noto_Sans_TC;
    var Big = document.getElementById("size-button-h3");
    Big.onclick = font_Big;
    var Mid = document.getElementById("size-button-h4");
    Mid.onclick = font_Mid;
    var Small = document.getElementById("size-button-h5");
    Small.onclick = font_Small;
}
window.onload = start;

function dark() {
    var element = document.getElementById("articlemain");
    element.classList.remove("bg-light");
    element.classList.remove("bg-secondary");
    element.classList.remove("bg-dark");
    element.classList.remove("text-white");
    element.classList.remove("text-black");
    element.classList.add("bg-dark");
    element.classList.add("text-white");
    document.cookie = "background=bg-dark";
}

function secondary() {
    var element = document.getElementById("articlemain");
    element.classList.remove("bg-light");
    element.classList.remove("bg-secondary");
    element.classList.remove("bg-dark");
    element.classList.remove("text-white");
    element.classList.remove("text-black");
    element.classList.add("bg-secondary");
    element.classList.add("text-white");
    document.cookie = "background=bg-secondary";
}
function light() {
    var element = document.getElementById("articlemain");
    element.classList.remove("bg-light");
    element.classList.remove("bg-secondary");
    element.classList.remove("bg-dark");
    element.classList.remove("text-white");
    element.classList.remove("text-black");
    element.classList.add("bg-light");
    element.classList.add("text-black");
    document.cookie = "background=bg-light";
}

function cwTeXKai() {
    var element = document.getElementById("fonttarget").querySelectorAll("p");
    var i = 0;
    for (i = 0; i < 2; i++) {
        element[i].classList.remove("cwTeXKai");
        element[i].classList.remove("cwTeXYen");
        element[i].classList.remove("Noto-Sans-TC");
        element[i].classList.add("cwTeXKai");
        document.cookie = "font=cwTeXKai";
    }

}

function cwTeXYen() {
    var element = document.getElementById("fonttarget").querySelectorAll("p");
    var i = 0;
    for (i = 0; i < 2; i++) {
        element[i].classList.remove("cwTeXKai");
        element[i].classList.remove("cwTeXYen");
        element[i].classList.remove("Noto-Sans-TC");
        element[i].classList.add("cwTeXYen");
        document.cookie = "font=cwTeXYen";
    }
}

function Noto_Sans_TC() {
    var element = document.getElementById("fonttarget").querySelectorAll("p");
    var i = 0;
    for (i = 0; i < 2; i++) {
        element[i].classList.remove("cwTeXKai");
        element[i].classList.remove("cwTeXYen");
        element[i].classList.remove("Noto-Sans-TC");
        element[i].classList.add("Noto-Sans-TC");
        document.cookie = "font=Noto-Sans-TC";
    }
}

function font_Big() {
    var element_big = document.getElementById("big");
    var element_small = document.getElementById("small");
    element_big.classList.remove("h1");
    element_big.classList.remove("h2");
    element_big.classList.remove("h3");
    element_small.classList.remove("h3");
    element_small.classList.remove("h4");
    element_small.classList.remove("h5");
    element_big.classList.add("h1");
    element_small.classList.add("h3");
    document.cookie = "size=3";
}

function font_Mid() {
    var element_big = document.getElementById("big");
    var element_small = document.getElementById("small");
    element_big.classList.remove("h1");
    element_big.classList.remove("h2");
    element_big.classList.remove("h3");
    element_small.classList.remove("h3");
    element_small.classList.remove("h4");
    element_small.classList.remove("h5");
    element_big.classList.add("h2");
    element_small.classList.add("h4");
    document.cookie = "size=4";
}

function font_Small() {
    var element_big = document.getElementById("big");
    var element_small = document.getElementById("small");
    element_big.classList.remove("h1");
    element_big.classList.remove("h2");
    element_big.classList.remove("h3");
    element_small.classList.remove("h3");
    element_small.classList.remove("h4");
    element_small.classList.remove("h5");
    element_big.classList.add("h3");
    element_small.classList.add("h5");
    document.cookie = "size=5";
}