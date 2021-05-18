

let navLinks = document.getElementById("navLinks");

let menuIcon = document.getElementsByClassName("fa-bars");

let closeIcon = document.getElementsByClassName("fa-times");

menuIcon[0].addEventListener("click", showMenu);
closeIcon[0].addEventListener("click", hideMenu);

function showMenu() {
    navLinks.style.right = "0px";
}

function hideMenu() {
    navLinks.style.right = "-200px";
}