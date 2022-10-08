const LocomotiveScroll = require('locomotive-scroll');
module.exports = () => {
    const scroll = new LocomotiveScroll({
      el: document.querySelector('[data-scroll-container]'),
      smooth: true
    });
  
  
    scroll.on('scroll', (args) => {
      console.log(scroll)
  });
 
}
