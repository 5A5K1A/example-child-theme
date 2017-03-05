require('classlist-polyfill');

require('./modules/nav-scroll');
require('./modules/nav-toggle');

if (document.querySelector('.quotes')) {
  require('./modules/quote-slider');
}

if (document.querySelector('.usps')) {
  require('./modules/usp-slider');
}
if (document.querySelector('.faqs--item')) {
  require('./modules/faq');
}
if (document.querySelector('.chartify')) {
  require('./modules/chartify');
}
if (document.querySelector('.video-custom')) {
  require('./modules/video');
}
if (document.querySelector('.calculator')) {
  require('./modules/calculator');
}
if (document.querySelector('.slowinvest--img')) {
  require('./modules/snail');
}
if (document.querySelector('.people--list')) {
  require('./modules/people-slider');
}

if (window.location.hash) {
  require('./modules/hash');
}
