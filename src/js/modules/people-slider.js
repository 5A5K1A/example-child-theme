const peopleList = document.querySelector('.people--list');
const peopleItems = document.querySelectorAll('.people--item');
const peopleContainer = document.querySelector('.people--container');

// Get the total amount of people
const totalAmountOfItems = peopleItems.length;

let itemWidth;
const marge = 16;

function calculateListWidth() {
  // Get the with of one item in the list
  itemWidth = peopleItems[1].offsetWidth;
  // set the width of the list to the width of all the elements combined
  peopleList.style.width = totalAmountOfItems * (itemWidth + marge) + 'px';
}
calculateListWidth();

let peopleShown;

function getAmountOfPeople() {
  if ( window.innerWidth < 960 ) {
    peopleShown = 1;
  }
  if ( window.innerWidth >= 960 ) {
    peopleShown = 2;
  }
  if ( window.innerWidth >= 1200 ) {
    peopleShown = 3;
  }
}
getAmountOfPeople();

window.onresize = function() {
  getAmountOfPeople();
  calculateListWidth();
};


// create buttons
const buttonLeft = document.createElement('button');
const buttonRight = document.createElement('button');

// add eventListeners to the buttons
buttonLeft.addEventListener('click', moveLeft);
buttonRight.addEventListener('click', moveRight);

// add all the valeus to the buttons
addButtonValues(buttonLeft, 'left');
addButtonValues(buttonRight, 'right');

function addButtonValues(button, value) {
    button.classList.add('people--button');
    button.classList.add('people--button-' + value);
    // button.innerHTML = value;

    peopleContainer.appendChild(button);
}

// Disable the left button on default
buttonLeft.disabled = true;

// Move the slider functions
let pos = 0;
let counter = 0;

peopleList.style.transition = '.3s transform';

function moveLeft(e) {
  pos += itemWidth;
  let posPx = pos + 'px';
  peopleList.style.transform = 'translateX(' + posPx + ')';

  checkRightButton(e.target);
}
function moveRight(e) {
  pos -= itemWidth;
  let posPx = pos + 'px';
  peopleList.style.transform = 'translateX(' + posPx + ')';

  checkLeftButton(e.target);
}

// Check if abutton is disabled and needs to be enabled
function checkButtonsDisabled() {
  if ( buttonLeft.disabled === true && counter !== 0 ) {
    buttonLeft.disabled = false;
  }
  if ( buttonRight.disabled === true && counter < (totalAmountOfItems - peopleShown) ) {
    buttonRight.disabled = false;
  }
}


function checkLeftButton(button) {
  counter += 1;
  counter >= (totalAmountOfItems - peopleShown) ? button.disabled = true : checkButtonsDisabled();
}

function checkRightButton(button) {
  counter -= 1;
  counter === 0 ? button.disabled = true : checkButtonsDisabled();
}
