import Highway from '@dogstudio/highway';
import imagesLoaded from 'imagesLoaded';
const FontFaceObserver = require('fontfaceobserver');
const observeVisibility = require('../modules/global/observe-visibility');
const counterAnimation = require('../modules/global/counter-animation');
const rotateIcon = require('../modules/global/rotate-icon');
const text = require('../modules/global/text');
const heroSlider = require('../modules/global/slider-hero');
const sliderScroll = require('../modules/home/slider-scroll');
const main = document.querySelector('#app main');


let onScroll;
const preloadImages = () => {
  return new Promise((resolve, reject) => {
    imagesLoaded(document.querySelectorAll('img'), { background: true }, resolve);
  });
};

class Home extends Highway.Renderer {
  // Hooks/methods
  onEnter () {
    main.scrollTo(0, 0);

    if (document.querySelector('#slider-hero')) {
      heroSlider.init('#slider-hero');
    }
    sliderScroll.init('#slider');
  }

  onLeave () {
  }

  onEnterCompleted () {
    const font = new FontFaceObserver('montserrat');
    const hiddenEls = document.querySelectorAll('.js-ae');
    const fireImmediately = document.querySelectorAll('.js-if-ae');
    let lastScrollTop = 0;
    let scrollDir = 'down';
    rotateIcon.init('#spin', '#rotation');

    // Listen for @font-face to be loaded to transform text
    font.load().then(function () {
      const headline = document.querySelectorAll('#hero-headline h1');
      const coordinatesN = document.querySelector('#n');
      const coordinatesW = document.querySelector('#w');
      const location = document.querySelectorAll('.location');

      text.init(coordinatesN, 2);
      text.init(coordinatesW, 2);

      for (let i = 0; i < location.length; i++) {
        text.init(location[i], 2);
      }

      for (let i = 0; i < headline.length; i++) {
        text.init(headline[i], 1);
      }
    });

    setTimeout(() => {
      const counterEls = document.querySelectorAll('.js-counter');
      for (let i = 0; i < counterEls.length; i++) {
        counterEls[i].style.width = `${counterEls[i].offsetWidth}px`;
        counterAnimation.init(counterEls[i], 0, 150 * i, counterEls[i].innerText, i, true);
        counterEls[i].innerText = 0;
      }
    }, 100);

    for (let i = 0; i < hiddenEls.length; i++) {
      observeVisibility.default.bind(hiddenEls[i], {
        callback: visibilityChanged
      });
    }

    preloadImages().then(() => {
      require('../modules/global/hero')('#hero');
      require('../modules/load-snippets/snippets')();
      require('../modules/global/footer')();

      for (let i = 0; i < fireImmediately.length; i++) {
        fireImmediately[i].classList.add('js-show');
      }
    });

    function visibilityChanged (isVisible, el) {
      if (isVisible) {
        el.classList.add('js-show');
      } else {
        // el.classList.remove('js-show');
      }

      if (isVisible && scrollDir === 'down') {
        el.classList.add('js-show');
      } else if (!isVisible && scrollDir === 'up') {
        el.classList.remove('js-show');
      } else if (isVisible) {
        el.classList.add('js-show');
      }
    }

    onScroll = () => {
      const st = main.scrollTop;
      if (st > lastScrollTop) {
        scrollDir = 'down';
      } else {
        scrollDir = 'up';
      }
      lastScrollTop = st <= 0 ? 0 : st;
    };

    main.addEventListener('scroll', onScroll);
  }

  onLeaveCompleted () {
    if (document.querySelector('#slider-hero')) {
      heroSlider.destroy();
    }
    sliderScroll.destroy();
    rotateIcon.destroy();
    // observeVisibility.default.unbind(document.querySelector('#companies'));
    main.removeEventListener('scroll', onScroll);
  }
}

// Don`t forget to export your renderer
export default Home;