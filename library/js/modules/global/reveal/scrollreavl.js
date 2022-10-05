module.exports = () => {
  const observeVisibility = require('./observe-visibility.js');

  let onScroll;

  const hiddenEls = document.querySelectorAll('.js-ae');
  let lastScrollTop = 0;
  let scrollDir = 'down';
  let threhold;

  for (let i = 0; i < hiddenEls.length; i++) {
    observeVisibility.default.bind(hiddenEls[i], {
      callback: visibilityChanged,
      intersection: {
        threshold: parseFloat(hiddenEls[i].dataset.threshold, 10) || 0.5
      }
    });
  }

  function visibilityChanged (isVisible, el) {
    if (isVisible) {
      el.classList.add('js-active');
    } else {
      // el.classList.remove('js-show');
    }

    if (isVisible && scrollDir === 'down') {
      el.classList.add('js-active');
    } else if (!isVisible && scrollDir === 'up') {
      el.classList.add('js-active');
    } else if (isVisible) {
      el.classList.add('js-active');
    }
  }


  onScroll = () => {
    const st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop) {
      scrollDir = 'down';
    } else {
      scrollDir = 'up';
    }
    lastScrollTop = st <= 0 ? 0 : st;
  };

}
