const prev = document.querySelector(".prev")
const next = document.querySelector(".next")
const carousel = document.querySelector(".carousel-container")
const track = document.querySelector(".carousel-track")
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