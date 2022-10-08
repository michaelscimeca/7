import Highway from '@dogstudio/highway';
import Home from './modules/global/page-transition/renderers/home';
import Members from './modules/global/page-transition/renderers/members';
import Style from './modules/global/page-transition/renderers/members';
import Slider from './modules/global/page-transition/transitions/slide';
const emitter = require('tiny-emitter/instance');
const moment = require('moment')
const $ = require('jquery')

const Modules = {
  init: function () {
    require('./modules/global/ua-detection')();
    setTimeout(()=>{
      require('./modules/global/scroll/scrolling')();

    },1300)
    // require('./modules/global/reveal/scrollreavl')();
    // require('./modules/global/three/three')();
    require('./modules/global/component/map')('#map');
    // require('./modules/global/component/ticker-style-one')();
    // require('./modules/global/component/ticker-style-two')('#buy');
    let d = [];
    fetch('/wp-json/wp/v2/event_listing')
    .then(response => response.text())
    .then(mapData => {
      let dataList = JSON.parse(mapData);
      console.log( dataList)
    dataList.forEach(data => {
        d.push({
          "id": data.id,
          "acf": data.acf,
          "title": data.title,
          "show-type": data.x_metadata._show_type,
          // "date": data.x_date,
          "date-start": data.x_metadata._event_start_date.split(" ")[0],
          "date-end": data.x_metadata._event_end_date.split(" ")[0],
          "time-start": data.x_metadata._event_start_time,
          "time-end": data.x_metadata._event_end_time,
          "lat": data.acf.location.lat,
          "lng": data.acf.location.lng,

        })
      })

        const sortedArray = d.sort((a,b) => new Moment(a['date-start']).format('YYYYMMDD') - new Moment(b['date-start']).format('YYYYMMDD'))
        console.log(sortedArray)


        let map = new google.maps.Map(document.getElementById("map"), {
          center: { lat:  41.881832, lng: -87.623177 },
          zoom: 8,
          mapId: 'ab386c69ad530575'
      });


      sortedArray.forEach((item, i) => {
          let location = new google.maps.Marker({
              position: { lat: item.lat, lng: item.lng },
              map: map,
              icon: (item['show-type'][0] !== "acoustic") ? 'https://developers.google.com/maps/documentation/javascript/examples/full/images/library_maps.png' : 'https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png'
          })
  
          location.addListener('click', ()=>{
              alert('d')
          })
      });

        const mainContainer = document.querySelector("#tour ul");

        sortedArray.forEach((item) => {
          mainContainer.innerHTML += `<li>
          <div class="tour-date">
              <span>${item['date-start']}</span>
              <span>${item.acf.name}</span>
           </div>
           <div class="tour-place">
              <span>${item.title.rendered}</span>
           </div>
           <div class="tour-location">
              <span>${item.acf.location.city}</span>
              <span>${item.acf.location.address}</span>
              <a href="https://www.google.com/maps/dir/${item.lat},${item.lng}" target="_blank">View Direction</a>
           </div>
          </li>`;
        })
        
        // console.log(Moment().format('h:mm:ss'))
        // var eventTime= Moment().format('h:mm:ss'); // Timestamp - Sun, 21 Apr 2013 13:00:00 GMT
        // var currentTime = 1366547400; // Timestamp - Sun, 21 Apr 2013 12:30:00 GMT
        // var diffTime = eventTime - currentTime;
        // var duration = Moment.duration(diffTime*1000, 'milliseconds');
        // var interval = 1000;
        
        // setInterval(function(){
        //   duration = Moment.duration(duration - interval, 'milliseconds');
        //     $('.countdown').text(duration.hours() + ":" + duration.minutes() + ":" + duration.seconds())
        // }, interval);

        
        (function () {

          var timeElement, eventTime, currentTime, duration, interval, intervalId;
        
          interval = 1000; // 1 second
        
          // get time element
          timeElement = document.querySelector("time");
          // calculate difference between two times
          eventTime = moment.tz("2040-11-15T09:00:00", "America/Los_Angeles");
          // based on time set in user's computer time / OS
          currentTime = moment.tz();
          // get duration between two times
          duration = moment.duration(eventTime.diff(currentTime));
        
          // loop to countdown every 1 second
          setInterval(function() {
            // get updated duration
            duration = moment.duration(duration - interval, 'milliseconds');
        
            // if duration is >= 0
            if (duration.asSeconds() <= 0) {
              clearInterval(intervalId);
              // hide the countdown element
              timeElement.classList.add("hidden");
            } else {
              // otherwise, show the updated countdown
              timeElement.innerText = duration.years() + " years " + duration.days() + " days " + duration.hours() + " hours " + duration.minutes()  + " minutes " + duration.seconds() + " seconds";
            }
          }, interval);
        
        }());

    });

    const H = new Highway.Core({
      renderers: {
        home: Home,
        members: Members,
        style: Style,

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
