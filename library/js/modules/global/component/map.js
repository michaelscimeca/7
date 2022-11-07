const Moment = require('moment')
const $ = require('jquery')

module.exports = (elm) => {
  if (document.querySelector(elm)) {
    let mapDataHold = []
    let markers = []
    const toggle = [...document.querySelectorAll('.toggle input')];
    const tourContainer = document.querySelector('#tour');
    const mainContainer = document.querySelector('#tour ul')
    const countdown = document.querySelector('#count-down')
    const live = document.querySelector('#live')

    const tourBtn = document.querySelector('#js-tour-btn');

    tourBtn.addEventListener('click', (e)=> {
      tourContainer.classList.add('active');
    })

    function getDay(d) {
      console.log(d)
      const date = new Moment(d, "MM-DD-YYYY"); // Thursday Feb 2015
      return date._locale._weekdaysShort[date.day()]
    }
    function cleanShowType(show) {
      const string = show;
      return string[0].replace('_', ' ');
    }

    toggle.forEach((item, i)=>{
      item.addEventListener('change', (event) => {
        console.dir(event.target.checked)
      });
    })

    fetch('/wp-json/wp/v2/event_listing')
    .then((response) => response.text())
    .then((mapData) => {
      let dataList = JSON.parse(mapData)
      dataList.forEach((data) => {

        mapDataHold.push({
          id: data.id,
          acf: data.acf,
          title: data.title,
          day: getDay(data.x_date),
          date: Moment(data.x_metadata._event_start_date.split(' ')[0]).format('D'),
          'show-type': cleanShowType(data.x_metadata._show_type),
          event_type: data.x_metadata.event_type,
          city: data.acf.location.city,
          state: data.acf.location.state_short,
          website: data.acf.website,
          'date-start': Moment(data.x_metadata._event_start_date.split(' ')[0]).format('MMM YYYY'),
          'date-end': data.x_metadata._event_end_date.split(' ')[0],
          'time-start': Moment(data.x_metadata._event_start_time,'hhmm').format("hh:mma"),
          'time-end': Moment(data.x_metadata._event_end_time,'hhmm').format("hh:mma"),
          lat: data.acf.location.lat,
          lng: data.acf.location.lng,
          rawData: {
            date: Moment(data.x_metadata._event_start_date).format('YYYY-MM-DD'),
            dateStartTime: data.x_metadata._event_start_time,
            dateEndTime: Moment(data.x_metadata._event_end_time,'hhmm').format("hh:mm:ss"),
            startTime: Moment(data.x_metadata._event_start_time,'hhmm').format("hh:mm:ss"),
            start: data.x_metadata._event_start_date,
            end: data.x_metadata._event_end_date
          }
        })
      })

      const sortedArray = mapDataHold.sort(
        (a, b) =>
        new Moment(a['date-start']).format('YYYYMMDD') -
        new Moment(b['date-start']).format('YYYYMMDD')
      )
      // google.maps.event.trigger(marker, 'mouseover');

      const results = sortedArray.filter(function(num) {
        return num['show-type'] === 'full show';
      });

      const map = new google.maps.Map(
        document.getElementById('map'),{
          center: { lat: 41.881832, lng: -87.623177 },
          zoom: 10,
          mapId: 'bfd1eeb3eeeb6027',
          disableDefaultUI: true, // a way to quickly hide all controls
          scaleControl: true,
          keyboardShortcuts: false,
        }
      )

      let infowindow = new google.maps.InfoWindow()

      sortedArray.forEach((item, i) => {
        let location = new google.maps.Marker({
          position: { lat: item.lat, lng: item.lng },
          map: map,
          icon:
          item['show-type'][0] !== 'acoustic'
          ? 'https://developers.google.com/maps/documentation/javascript/examples/full/images/library_maps.png'
          : 'https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png',
        })

        google.maps.event.addListener(
          location,
          'click',
          (function (location, i) {
            return function () {
              infowindow.setContent(
                mapDataHold[i]['show-type'][0]
              )
              infowindow.open(map, location)
            }
          })(location, i)
        )

        // location.addListener('click', () => {
        //   console.log(item);
        // })
        markers.push(location)
      })

      sortedArray.forEach((item) => {
        mainContainer.innerHTML +=
        `<li>
        <div class="date-container">
        <div class="box-date">
        <div class="day">${item.day}</div>
        <div class="date">${item.date}</div>
        <div class="start-date">${item['date-start']}</div>
        <div class="time">${item['time-start']} - ${item['time-end']}</div>
        </div>
        </div>

        <div class="tour-detail-container">
        <div class="name">${item.title.rendered}</div>
        <div class="event-details">
        <div class="show-type">${item['show-type']}</div> <div class="event-type">${item.event_type}</div>
        </div>
        <div class="location">${item.city}, ${item.state}</div>
        </div>

        <div class="tour-location">
        <a href="${item.website}" target="_blank">Website</a>
        <a href="https://www.google.com/maps/dir//${item.lat},${item.lng}" target="_blank">Get Direction</a>
        </div>
        </li>`
      })

      let locationElm = document.querySelector('#current-show-location')

      locationElm.innerHTML =
      `
      <div class="start-date">
      <div class="location-name">${sortedArray[0].title.rendered}</div>
      <div class="date">${sortedArray[0].day} ${sortedArray[0].date} ${sortedArray[0]['date-start']}        ${sortedArray[0]['time-start']} - ${sortedArray[0]['time-end']} </div>
       </div>
      `

      mainContainer.querySelectorAll('li').forEach((item, i) => {
        item.addEventListener('mouseover', (event) => {
          // console.log(markers[i])
          google.maps.event.trigger(markers[i], 'click')
        })
      })
      //
      // let f = "M/DD/YYYY hh:mm:ss A";
      // var now = Moment()
      // var time = Moment().format('M/DD/YYYY hh:mm:ss A')
      // var ad = Moment(sortedArray[0].rawData.start).format('M/DD/YYYY hh:mm:ss A');
      // var sd = Moment(sortedArray[0].rawData.end).format('M/DD/YYYY hh:mm:ss A');
      // var format = 'hh:mm:ss'

      // var times = Moment('09:34:00',format),
      // beforeTime = Moment('08:34:00', format),
      // afterTime = Moment('10:34:00', format);

      // if (times.isBetween(beforeTime, afterTime)) {
      //   console.log('is between')
      // } else {
      //   console.log('is not between')
      // }
      //

      var countDownDate = new Date(`${sortedArray[0].rawData.date} ${sortedArray[0].rawData.dateStartTime}`).getTime()
      var x = setInterval(function () {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        function prependZero(number) {
          if (number <= 9)
          if (number < 0) {
            return "00";
          } else {
            return "0" + number;
          }
          else return number;
        }

        days = prependZero(days);
        hours = prependZero(hours);
        minutes = prependZero(minutes);
        seconds = prependZero(seconds);
        countdown.innerHTML =
        `<div class="days">${days} :</div>
        <div class="hours">${hours} :</div>
        <div class="mintues">${minutes} :</div>
        <div class="seconds">${seconds}</div>`;

        // console.log(days, hours, minutes, seconds);

        // Display the result in the element with id="demo"
        //
        // document.getElementById("days1").innerHTML = days.toString().slice(0, 1);
        //
        // document.getElementById("days2").innerHTML = days.toString().slice(1, 2);
        //
        // document.getElementById("hours1").innerHTML = hours.toString().slice(0, 1);
        //
        // document.getElementById("hours2").innerHTML = hours.toString().slice(1, 2);
        //
        // document.getElementById("minutes1").innerHTML = minutes
        //   .toString()
        //   .slice(0, 1);
        // document.getElementById("minutes2").innerHTML = minutes
        //   .toString()
        //   .slice(1, 2);
        //
        // document.getElementById("seconds1").innerHTML = seconds
        //   .toString()
        //   .slice(0, 1);
        // document.getElementById("seconds2").innerHTML = seconds
        //   .toString()
        //   .slice(1, 2);

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          // document.getElementById("demo").innerHTML = "EXPIRED";
        }
      }, 1000);


      //     // var twilio = require('twilio');

      //     // // Find your account sid and auth token in your Twilio account Console.
      //     // var client = new twilio('TWILIO_ACCOUNT_SID', 'TWILIO_AUTH_TOKEN');

      //     // // Send the text message.
      //     // client.messages.create({
      //     //   to: 'YOUR_NUMBER',
      //     //   from: 'YOUR_TWILIO_NUMBER',
      //     //   body: 'Hello from Twilio!'
      //     // });
    })
  }
}
