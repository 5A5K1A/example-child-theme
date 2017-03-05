const body = document.querySelector('body');
let classListToggle = false;

// return another value on each adjust mixin breakpoint
function checkBodyPadding() {
  if ( window.innerWidth > 1300 ) {
    return 20;
  } else if ( window.innerWidth > 1000 ) {
    return 16;
  } else if ( window.innerWidth > 800 ) {
    return 10;
  } else {
    return 5;
  }
}

// check if an class needs to be added and which one
function checkAddClass(tippingPoint) {
  let scrollTop = document.documentElement.scrollTop || document.body.scrollTop; // used instead of window.scrollY for IE support
  if ((scrollTop) >= tippingPoint && classListToggle === false) {
    body.classList.add('scroll');
    classListToggle = true;
  }
  if ((scrollTop) < tippingPoint && classListToggle === true) {
    body.classList.remove('scroll');
    classListToggle = false;
  }
}

// action on scroll
function checkPos(e) {
  const tippingPoint = checkBodyPadding();
  checkAddClass(tippingPoint);
}

window.addEventListener('scroll', checkPos);
checkPos();
