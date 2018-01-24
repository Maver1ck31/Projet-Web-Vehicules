/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var slideIndex = 1;
showSlides(slideIndex);
// Change image every 5 seconds
var timer = setInterval(plusSlides, 5000, 1);

// Next/previous image 
function ChangeSlides(n) {
    showSlides(slideIndex += n);
    resetTimer();
}

function currentSlide(n) {
    showSlides(slideIndex = n);
    resetTimer();
}

function resetTimer() {
    clearInterval(timer);
    timer = setInterval(plusSlides, 5000, 1);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    if (slides[slideIndex-1] != undefined) {
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    } else {
        console.log("BUG: slides = " + JSON.stringify(slides));
    }
}


