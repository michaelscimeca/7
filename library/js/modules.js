import Highway from '@dogstudio/highway';
import Home from './modules/global/page-transition/renderers/home';
import Members from './modules/global/page-transition/renderers/members';
import Slider from './modules/global/page-transition/transitions/slide';
const emitter = require('tiny-emitter/instance');


const Modules = {
  init: function () {
    require('./modules/global/ua-detection')();
    require('./modules/global/scroll/scrolling')();
    require('./modules/global/reveal/scrollreavl')();
    require('./modules/global/three/three')();
    require('./modules/global/component/map')();
    require('./modules/global/component/ticker')();


    const H = new Highway.Core({
      renderers: {
        home: Home,
        members: Members,
      },
      transitions: {
        default: Slider
      }
    });

  H.on('NAVIGATE_IN', ({ location, from }) => {
    emitter.emit('some-event', 'arg1 value', 'arg2 value', 'arg3 value');

        if (location.anchor) {
          const el = document.querySelector(location.anchor);
          const main = document.querySelector('#app main');

          if (el) {
            setTimeout(() => {
              main.scrollTo(0, el.offsetTop);
            }, 100);
          }
        }
      });
  
  }
};
module.exports = Modules;
