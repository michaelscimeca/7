const LocomotiveScroll = require('locomotive-scroll');
module.exports = () => {
  const scroll = new LocomotiveScroll({
    el: document.querySelector('[data-scroll-container]'),
    smooth: true
  });
  scroll.on('scroll', (args) => {
    console.log(args.scroll.y, args.delta.y, ((args.scroll.y / args.delta.y) * 100))
    // Get all current elements : args.currentElements
    if(typeof args.currentElements['hey'] === 'object') {
        let progress = args.currentElements['hey'].progress;
        console.log(progress);
        // ouput log example: 0.34
        // gsap example : myGsapAnimation.progress(progress);
    }
});
}
