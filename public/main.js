const inputMdp = document.getElementById('password')
const btnPass = document.getElementById('voirPass')
if(btnPass != null){
    btnPass.addEventListener('click', afficherMdp)
    function afficherMdp(){
        if(inputMdp.type === "password"){
            btnPass.src = "img/eyeouvert.png"
            inputMdp.type = "text"
        }else{
            btnPass.src = "img/eyeferme.png"
            inputMdp.type = "password"
        }
    }
}

const prev = document.querySelector(".prev")
const next = document.querySelector(".next")
const carousel = document.querySelector(".carousel-container")
const track = document.querySelector(".carousel-track")
if (prev != null){
    let width = carousel.offsetWidth/4
    let index = 0
    next.addEventListener("click", function (e) {
        e.preventDefault()
        index = index + 1
        prev.style.display = "block"
        track.style.transform = "translateX(" + index * -width + "px)"
        if (track.offsetWidth - index * width < index * width) {
            next.style.display = "none"
        }
    })
    prev.addEventListener("click", function (e) {
        e.preventDefault()
        index = index - 1
        next.style.display = "block"
        track.style.transform = "translateX(" + index * -width + "px)"
        if (track.offsetWidth - index * width < index * width) {
            prev.style.display = "none"
        }
        if (index === 0){
            prev.style.display = "none"
        }
    })
}


const prev2 = document.querySelector(".prev2")
const next2 = document.querySelector(".next2")
const carousel2 = document.querySelector(".carousel-container2")
const track2 = document.querySelector(".carousel-track2")
if (prev2 != null){
    let width2 = carousel2.offsetWidth/4
    let index2 = 0
    next2.addEventListener("click", function (e) {
        e.preventDefault()
        index2 = index2 + 1
        prev2.style.display = "block"
        track2.style.transform = "translateX(" + index2 * -width2 + "px)"
        if (track2.offsetWidth - index2 * width2 < index2 * width2) {
            next2.style.display = "none"
        }
    })
    prev2.addEventListener("click", function (e) {
        e.preventDefault()
        index2 = index2 - 1
        next2.style.display = "block"
        track2.style.transform = "translateX(" + index2 * -width2 + "px)"
        if (track2.offsetWidth - index2 * width2 < index2 * width2) {
            prev2.style.display = "none"
        }
        if (index2 === 0){
            prev2.style.display = "none"
        }
    })
}


function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

let likeLoc = localStorage.getItem("LikedAlbum")
const likeIcon = document.getElementById("likeIcon")

if (likeIcon.src == "img/heartBlack.svg"){
    likeLoc = "not liked"
}
likeIcon.addEventListener("click", () => {

    if(likeLoc == "not liked"){
        likeIcon.src = "img/heartRed.svg"
        localStorage.setItem('LikedAlbum', 'liked')
    }else{
        likeIcon.src = "img/heartBlack.svg"
        localStorage.setItem('LikedAlbum', 'not liked')
    }
})
