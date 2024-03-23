let body=document.getElementById('body');
let img = document.getElementsByClassName("gallery-item-active")
var toggle = document.getElementById("switch");
const bod = document.getElementsByTagName("body");
const image= document.querySelector("#gallery");
var nav = document.getElementById("navlist");
var about = document.getElementById("about");
var brand = document.getElementById("brand");
var foot = document.getElementById("copyright")
var toggle = document.getElementById("switch");

toggle.onclick = function () {
    if (body.className=="light" || body.className=="light image-active") {
        body.className="dark";
        nav.className="navlist-dark";
        foot.className="p-dark";
        brand.className="b-dark";
        toggle.className="bi bi-toggle2-on";
        list.style.color="white";
    }else if(body.className=="dark" || body.className=="dark image-active" || body.className=="dark "){
        body.className="light";
        nav.className="navlist";
        foot.className="p-light";
        brand.className="b-light";
        toggle.className="bi bi-toggle2-off";
        list.style.color="black";
    }
   
}


image.addEventListener("click", function (e) {
    if (e.target.className == "gallery-item") {
        e.target.className="gallery-item-active";
        body.className+=" image-active";
        toggle.style.opacity="0.0";
    }else if(e.target.className=="gallery-item-active"){
        e.target.className="gallery-item";
        body.className=body.className.slice( 0,5);
        toggle.style.opacity="1";
    };

});



