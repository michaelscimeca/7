module.exports = () => {
  const UAParser = require('ua-parser-js');
  const au = new UAParser();
  const name = au.getResult().browser.name;
  const html = document.getElementsByTagName('html')[0];
  switch (name) {
    case 'IE':
    html.classList.add('is_ie');
    break;
    case 'Edge':
    html.classList.add('is_edge');
    break;
    case 'Chrome':
    html.classList.add('is_chrome');
    break;
    case 'Firefox':
    html.classList.add('is_ff');
    break;
    case 'Safari':
    html.classList.add('is_safari');
    break;
    case 'Mobile Safari':
    if (au.getResult().browser.major === '8') {
      html.classList.add('is_ios8');
    }
    break;
    case 'Android':
    html.classList.add('is_android');
  }
  if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
    html.classList.add('touchevents');
  } else {
    html.classList.add('no-touchevents');
  }
};
