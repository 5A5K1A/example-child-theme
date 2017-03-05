const slides = document.querySelectorAll('.usps--item');
const slidesContainer = document.querySelector('.usps--list');
const maxSlides = slides.length - 1;
let counter = 0;

const prevButton = document.querySelector('.usps--prev-button');
const nextButton = document.querySelector('.usps--next-button');

slidesContainer.classList.add('usps-js');

for (var i = 0; i < slides.length; i++) {
  slides[i].classList.add('usp-js');
  i === 0 ? slides[i].classList.add('show') : '';
}

function prevSlide() {
  slides[counter].classList.remove('show', 'from-right', 'from-left'); // Hide current slide
  counter = ( counter <= 0 ) ? maxSlides : counter - 1; // counter -1 exept if it gets under the 0
  slides[counter].classList.add('show', 'from-left'); // Show next slide
}
function nextSlide() {
  slides[counter].classList.remove('show', 'from-right', 'from-left');
  counter = ( counter >= maxSlides ) ? 0 : counter + 1;
  slides[counter].classList.add('show', 'from-right');
}

// Add controls to buttons
prevButton.addEventListener('click', prevSlide, false);
nextButton.addEventListener('click', nextSlide, false);
