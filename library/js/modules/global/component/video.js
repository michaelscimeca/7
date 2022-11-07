const $ = require('jquery')
import Plyr from 'plyr';
import Swiper from 'swiper';

module.exports = (elm) => {
  const progress = document.querySelector('#progress-bar #process');
  const videoSlidersContainer = document.querySelector('#video-container-sliders .swiper-wrapper');
  const videos = document.querySelectorAll('.hero-video-player');
  const timeContainer = document.querySelector('#progress-bar-width #time');
  const musicVideoDetails = document.querySelector('#music-video-details');

  function fmtMSS(s){return(s-(s%=60))/60+(9<s?':':':0')+s}

  fetch('/wp-json/wp/v2/hero-videos')
  .then((response) => response.text())
  .then((videoList) => {
    let dataList = JSON.parse(videoList);
    dataList = dataList[0].acf.video_list
    dataList.forEach((item) => {
      videoSlidersContainer.innerHTML +=
      `<div class="swiper-slide">
     <div class="js-player" data-plyr-provider="youtube" data-plyr-embed-id="${item.video_id}"></div>
      </div>`
    })
    // init Swiper:
    const swiper = new Swiper('.swiper', {
      loop: true,
      spaceBetween: 30,
      // autoplay: true,
      on: {
        init: function () {
          let p = document.querySelectorAll('.js-player');
          p.forEach((item) => {
            let v = new Plyr(item,{
              autoplay: true,
              controls: [],
              enablejsapi: 1,
              playsinline: true,
              muted: true,
              loop: {
                active: true
              }
            })
            v.on("playing", function () {
              document.querySelector('.plyr').classList.add('loaded')
              musicVideoDetails.classList.add('loaded')
              function updateBar () {
                const time = fmtMSS(Math.round(v.duration));
                const times = fmtMSS(Math.round(v.currentTime));
                timeContainer.innerHTML = `${times} / ${time}`;
                let updateProgress = (v.currentTime / v.duration) * 100;
                progress.style.width = `${updateProgress}%`
                setTimeout(updateBar,1000);
              }
              updateBar()
            })

          })

        },
      },
    });

  });

  // player.on("playing", function () {
  //   console.log(player)
  //   document.querySelector('.plyr').classList.add('loaded')

  //  function updateBar () {
  //   let updateProgress = (player.currentTime / player.duration) * 100;
  //    progress.style.width = `${updateProgress}%`
  //    setTimeout(updateBar,100);
  //  }
  //  updateBar()
  // })
  if (document.querySelector(elm)) {


  }
}
