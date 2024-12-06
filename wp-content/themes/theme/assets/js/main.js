import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.min.css";
import AOS from "aos";
import "../css/main.css";

import "./components/accordion";
import "./components/toggle";
import "./components/swiper";
import "./components/swipe-helper";
import "./components/link-select";
import "./components/blog";
import "./helper/checkout";
import "./components/tabs";

setTimeout(() => {
  AOS.init();
}, 50);

GLightbox({
  touchNavigation: true,
  loop: true,
  autoplayVideos: true,
});
