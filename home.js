let body=document.getElementById('body');
var nav = document.getElementById("navlist");
var about = document.getElementById("about");
var brand = document.getElementById("brand");
var foot = document.getElementById("copyright")
var list =document.getElementById("burger-nav");

var toggle = document.getElementById("switch");

toggle.onclick = function () {
    if (body.className=="light") {
        about.className="dark-me";
        body.className="dark";
        nav.className="navlist-dark";
        foot.className="p-dark";
        brand.className="b-dark";
        toggle.className="bi bi-toggle2-on";
        list.style.color="white";
    }else{
        about.className="me";
        body.className="light";
        nav.className="navlist";
        foot.className="p-light";
        brand.className="b-light";
        toggle.className="bi bi-toggle2-off";
        list.style.color="black";
    }
   
}