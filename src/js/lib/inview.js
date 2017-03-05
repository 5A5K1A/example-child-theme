const view = {};
view.inView = function(item) {
  let scrollTop = document.documentElement.scrollTop || document.body.scrollTop; // used instead of window.scrollY for IE support
  let bottomPosition = scrollTop + window.innerHeight; // The px of the bottom of the window
  let inViewPos = bottomPosition; // add an extra 100px to the inviewpos to make shure the user sees the effect

  // if the position of the element related to the document top is larger than the length of the window and the scrolled length of the docuent
  return inViewPos > item ? true : false;
};

module.exports = view;
