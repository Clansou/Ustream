const prev = document.querySelector(".prev")
const next = document.querySelector(".next")
const carousel = document.querySelector(".carousel-container")
const track = document.querySelector(".track")
let width = carousel.offsetWidth
let index = 0
next.addEventListener("click", function (e) {
  e.preventDefault()
  index = index + 1
  prev.style.display = "block"
  track.style.transform = "translateX(" + index * -width + "px)"
  if (track.offsetWidth - index * width < index * width) {
    next.style.display = "none"
  }
});
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
  
});
