const quotes = document.querySelectorAll('.quotes--item');
const quotesContainer = document.querySelector('.quotes');
const maxQuotes = quotes.length - 1;
const dur = 8000;

let maxHeight = 0;
let counter = 0;

function setSlides() {
  for (var i = 0; i < quotes.length; i++) {
    quotes[i].clientHeight > maxHeight ? maxHeight = quotes[i].clientHeight : ''; // Get height of largest slide
    i === 0 ? quotes[i].classList.add('fade-in') : ''; // Let first quote fade in
  }
  maxHeight = maxHeight + 100; // Create a bit of padding
  quotesContainer.style.height = maxHeight.toString() + 'px'; // Add max-height to quote-container
}

function nextSlide() {
  quotes[counter].classList.remove('fade-in'); // Remove current slide
  counter === maxQuotes ? counter = 0 : counter = counter + 1; // Count 1 to current exept if it's bigger than the total amount of quotes
  quotes[counter].classList.add('fade-in'); // Show new current item
}

setSlides();

// Create auto slider
setInterval(function(){
  nextSlide();
}, dur);
