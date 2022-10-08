const $ = require('jquery')
const {TimelineMax, Linear} = require('gsap')
module.exports = (elm) => {
  if (document.querySelector(elm)) {

  let $tickerWrapper = $(".ticker-style-two");
  let $list = $tickerWrapper.find("ul.list");
  let $clonedList = $list.clone();
  let listWidth = 10;

  $list.find("li").each(function (i) {
    listWidth += $(this, i).outerWidth(true);
  });

  let endPos = $tickerWrapper.width() - listWidth;

  $list.add($clonedList).css({
    "width" : listWidth + "px"
  });

  $clonedList.addClass("cloned").appendTo($tickerWrapper);

  //TimelineMax
  let infinite = new TimelineMax({repeat: -1, paused: true});
  let time = 200;

  infinite
    .fromTo($list, time, {rotation:0.01,x:0}, {force3D:true, x: -listWidth, ease: Linear.easeNone}, 0)
    .fromTo($clonedList, time, {rotation:0.01, x:listWidth}, {force3D:true, x:0, ease: Linear.easeNone}, 0)
    .set($list, {force3D:true, rotation:0.01, x: listWidth})
    .to($clonedList, time, {force3D:true, rotation:0.01, x: -listWidth, ease: Linear.easeNone}, time)
    .to($list, time, {force3D:true, rotation:0.01, x: 0, ease: Linear.easeNone}, time)
    .progress(1).progress(0)
    .play();
    const dragCursor = document.querySelector("#pick");

    let pc = document.querySelector('#buy');
    if(pc) {
      pc.addEventListener('mouseenter', e => {
        dragCursor.classList.add('active');
      },true);

      pc.addEventListener('mouseleave', e => {
        dragCursor.classList.remove('active');
      },true);

      pc.addEventListener('mousemove', function(e) {
        let btn = dragCursor.getBoundingClientRect();
        let rect = this.getBoundingClientRect();
        let x = (e.clientX - rect.left) - (btn.width / 2);
        let y = (e.clientY - rect.top) - (btn.height / 2);
        dragCursor.style.transform = `translate(${x}px, ${y}px)`;
      },true);
    }
  }
  }
