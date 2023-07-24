//slide deluxe
let slideDeluxeIndex = 1;
showSlidesDeluxe(slideDeluxeIndex);

function plusSlidesDeluxe(n) {
    showSlidesDeluxe(slideDeluxeIndex += n);
}

function currentSlideDeluxe(n) {
    showSlidesDeluxe(slideDeluxeIndex = n);
}

function showSlidesDeluxe(n) {
  let i;
  let slides = document.getElementsByClassName("my-deluxe-slide");
  let dots = document.getElementsByClassName("img-description__slide_deluxe");
  if (n > slides.length) {slideDeluxeIndex = 1}
  if (n < 1) {slideDeluxeIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideDeluxeIndex-1].style.display = "block";
  dots[slideDeluxeIndex-1].className += " active";
}

//slide standard
let slideStandardIndex = 1;
showSlidesStandard(slideStandardIndex);

function plusSlidesStandard(n) {
    showSlidesStandard(slideStandardIndex += n);
}

function currentSlideStandard(n) {
    showSlidesStandard(slideStandardIndex = n);
}

function showSlidesStandard(n) {
  let i;
  let slides = document.getElementsByClassName("my-standard-slide");
  let dots = document.getElementsByClassName("img-description__slide_standard");
  if (n > slides.length) {slideStandardIndex = 1}
  if (n < 1) {slideStandardIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideStandardIndex-1].style.display = "block";
  dots[slideStandardIndex-1].className += " active";
}
