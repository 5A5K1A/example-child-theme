const faqItems = document.querySelectorAll('.faqs--item');


for (var i = 0; i < faqItems.length; i++) {
  const item = faqItems[i];

  // add classes to the faq
  item.classList.add('closed');

  // add event listener
  item.firstElementChild.addEventListener('click', toggleFaq);
}

function toggleFaq(e) {
  // hide current slide
  // const openTab = document.querySelector('.collapsed');
  // openTab ? openTab.classList.remove('collapsed') : 'dd';
  // Do we want this?

  const parent = e.target.parentElement;
  parent.classList.toggle('collapsed');
}
