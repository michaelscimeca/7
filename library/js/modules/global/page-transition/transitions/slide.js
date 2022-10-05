// File: fade.js
// Import Highway
import Highway from '@dogstudio/highway';

// GSAP Library
import Tween from 'gsap';

// Fade
class Slider extends Highway.Transition {
  in({ from, to, done }) {
    console.log(from,to,done)
    // Reset Scroll
    window.scrollTo(0, 0);

    // Remove Old View
    from.remove();

    // Animation
    Tween.fromTo(to, 0.5,
      { opacity: 0 },
      {
        opacity: 1,
        onComplete: done
      }
    );
  }

  out({ from, done }) {
    // Animation
    console.log(from,done)
    Tween.fromTo(from, 0.5,
      { opacity: 1 },
      {
        opacity: 0,
        onComplete: done
      }
    );
  }
}

export default Slider;