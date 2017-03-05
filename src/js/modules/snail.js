const view = require('../lib/inview');

const snail = document.querySelector('.slowinvest');
let animate = false;

function checkSnail() {
  const snailTop = snail.offsetTop + ((snail.offsetHeight / 3) * 2);

  if ( view.inView(snailTop) === true && animate === false ) {
    snail.classList.add('snail-ani');
    animate = true;
  }
}

function onScroll(e) {
  if (animate === false) {
    window.requestAnimationFrame(function() {
      checkSnail();
    });
  }
}

// add scroll event listener to window
window.addEventListener('scroll', onScroll);
