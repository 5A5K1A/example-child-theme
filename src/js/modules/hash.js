if (window.location.hash) {
  const hash = window.location.hash;
  const el = document.querySelector(hash);
  const pos = el.offsetTop - 100;

  setTimeout(function() {
    window.scrollTo(0, pos);
  }, 1);
}
