

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

function objToUrlEncoded (obj) {
    var str = [];
    for (var key in obj) {
         if (obj.hasOwnProperty(key)) {
               str.push(encodeURIComponent(key) + "=" + encodeURIComponent(obj[key]))                  
               console.log(key + " -> " + obj[key]);
         }
    }
    return str.join("&");
}