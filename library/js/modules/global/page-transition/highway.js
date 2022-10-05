import Highway from '@dogstudio/highway';
import Slider from './transitions/slide';
import Home from './renderers/home';
const emitter = require('tiny-emitter/instance');

var Modules = {
  init: function () {
    require('./modules/global/ua-detection')();
    require('./modules/global/touchEvent')();
    require('./modules/global/hamburger')();
    require('./modules/global/nav')();

    const hash = `${window.location.pathname}${window.location.hash}`;
    const split = document.querySelector('#manifesto ');
    const daily = document.querySelector('#daily');
    const main = document.querySelector('#app main');

    if (hash === `/values/#manifesto ` || hash === `/values/#manifesto/`) {
      if (split) {
        setTimeout(() => {
          main.scrollTo(0, split.offsetTop - 80);
        }, 100);
      }
    }
    if (hash === `/values/#daily` || hash === `/values/#daily/`) {
      scrollToMe(daily, main);
    }

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
        companies: Companies,
        story: Story,
        team: Team,
        values: Values,
        contact: Contact,
        privacy: Privacy,
        fourohfour: FourOhFour
      },
      transitions: {
        // home: Fade,
        default: Slider
      }
    });

    emitter.on('redirect', function (href) {
      H.redirect(href);
    });

    // H.on('NAVIGATE_IN', ({ location, from }) => {
    //   if (location.anchor) {
    //     const el = document.querySelector(location.anchor);
    //     const main = document.querySelector('#app main');
    //
    //     if (el) {
    //       setTimeout(() => {
    //         main.scrollTo(0, el.offsetTop);
    //       }, 100);
    //     }
    //   }
    // });
  }
};
module.exports = Modules;
