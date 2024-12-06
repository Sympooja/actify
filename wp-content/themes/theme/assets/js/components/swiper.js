import Swiper, { Autoplay, Navigation, Pagination } from "swiper";

// import Swiper and modules styles
import "swiper/css";

Swiper.use([Navigation, Pagination, Autoplay]);

const SlideNav = document.querySelectorAll(".slidenav");
const SlideTitle = [...SlideNav].map((el) => el.getAttribute("data-name"));

new Swiper(".swiper-standard", {
  loop: true,
  autoplay: {
    delay: 7000,
    disableOnInteraction: false,
  },
  hashNavigation: {
    watchState: true,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

[...document.querySelectorAll(".swiper-container")].forEach((el) => {
  new Swiper(el.querySelector(".swiper-partner"), {
    slidesPerView: 1,
    loop: false,
    autoplay: {
      delay: 7000,
      disableOnInteraction: false,
    },
    hashNavigation: {
      watchState: true,
    },
    navigation: {
      nextEl: el.querySelector(".swiper-button-next"),
      prevEl: el.querySelector(".swiper-button-prev"),
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1200: {
        slidesPerView: 3,
      },
    },
  });
});

class TabbedSlider {
  activeIndex = 0;
  activeClass = "active-nav";
  constructor($swiper, $navigation) {
    this.$swiper = $swiper;
    this.$navigation = $navigation;
    this.$navigation.first().addClass(this.activeClass);
    this.swiper = new Swiper($swiper[0], {
      loop: true,
      autoplay: {
        delay: 7000,
        disableOnInteraction: false,
      },
      hashNavigation: {
        watchState: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    this.bindEvents();
  }
  bindEvents() {
    const slider = this;
    this.swiper.on("slideChange", function () {
      const index = this.realIndex;
      slider.getActiveNavItem().removeClass(slider.activeClass);
      slider.activeIndex = index;
      slider.getActiveNavItem().addClass(slider.activeClass);
    });
    this.$navigation.on("click", function () {
      const index = $(this).index() + 1;
      if (index - 1 == slider.activeIndex) return;
      slider.swiper.slideTo(index);
    });
  }
  getActiveNavItem() {
    return this.$navigation.eq(this.activeIndex);
  }
}

$(".tabbed-swiper").each(function () {
  new TabbedSlider(
    $(this).find(".tabbed-swiper-wrapper"),
    $(this).find(".tabbed-swiper-navigation-item")
  );
});

new Swiper(".swiper-visible-sides", {
  loop: true,

  slidesPerView: "auto",
  centeredSlides: true,
  spaceBetween: 20,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

new Swiper(".blog-masthead-swiper", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swiperLogos = document.querySelectorAll(".js-swiper-logos");

if (swiperLogos.length > 0) {
  let slidesPerView = swiperLogos.length;

  if (swiperLogos.length > 6) slidesPerView = 6;

  if ($(window).width() < 800 && slidesPerView > 3) {
    slidesPerView = 3;
  }

  new Swiper(".swiper-logos", {
    slidesPerView: slidesPerView,
    spaceBetween: 20,
    loop: true,
    autoplay: {
      delay: 7000,
      disableOnInteraction: false,
    },
  });
}
