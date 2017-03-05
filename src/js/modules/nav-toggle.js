const body = document.querySelector('body');
const toggleButton = document.querySelector('.menu-toggle');
let classListToggle = false;

function showMenu() {
  body.classList.add('dropdown');
  classListToggle = true;
}
function hideMenu() {
  body.classList.remove('dropdown');
  classListToggle = false;
}

function toggleMenu() {

  if ( classListToggle === true ) {
    hideMenu();
  } else {
    showMenu();
    window.onkeyup = function(e) {
      if (e.keyCode === 27) { hideMenu(); }
    };
  }
}

toggleButton.addEventListener('click', toggleMenu, false);
