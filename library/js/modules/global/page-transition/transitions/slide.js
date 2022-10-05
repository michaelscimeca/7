// File: fade.js
// Import Highway
import Highway from '@dogstudio/highway';

// GSAP Library
import Tween from 'gsap';

// Fade
class Fade extends Highway.Transition {
  in ({ from, to, done }) {
    console.log('in');
    main.scrollTo(0, 0);
    from.remove();

    Tween.fromTo(to, 0.5,
      { opacity: 0 },
      {
        opacity: 1,
        onComplete: function () {
          from.remove();
          done();
        }
      }
    );
  }

  out ({ from, done }) {
    console.log('from');
    Tween.fromTo(from, 0.5,
      { opacity: 1 },
      {
        opacity: 0,
        onComplete: done
      }
    );
  }
}

export default Fade;