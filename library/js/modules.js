import Highway from '@dogstudio/highway';
import Home from './modules/global/page-transition/renderers/home';
import Members from './modules/global/page-transition/renderers/members';
import Slider from './modules/global/page-transition/transitions/slide';
const emitter = require('tiny-emitter/instance');

var Modules = {
  init: function () {
    require('./modules/global/ua-detection')();
    require('./modules/global/scroll/scrolling')();
    require('./modules/global/reveal/scrollreavl')();
    require('./modules/global/three/three')();
    
    const hash = `${window.location.pathname}${window.location.hash}`;
    const main = document.querySelector('#app main'); 

    function scrollToMe (el, main) {
      if (el) {
        setTimeout(() => {
          main.scrollTo(0, el.offsetTop);
        }, 100);
      }
    }

    const H = new Highway.Core({
      renderers: {
        home: Home,
        members: Members,
      },
      transitions: {
        // home: Fade,
        default: Slider
      }
    });

    emitter.on('redirect', function (href) {
      H.redirect(href);
    });
  }
};
module.exports = Modules;
