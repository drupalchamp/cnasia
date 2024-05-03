window.addEventListener("DOMContentLoaded", () => {
  window.onscroll = function () { stickyheader() };
  var header = document.querySelector("#header-bottom-area");
  var masthead = document.getElementById("masthead");
  var sticky = header.offsetTop;

  function stickyheader() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
      masthead.classList.add("sticky-header");
    } else {
      header.classList.remove("sticky");
      masthead.classList.remove("sticky-header");
    }
  }


})

jQuery(document).ready(function () {
  jQuery('.hamburger-menu').click(function () {
    jQuery('.pop-out-menu-area').toggleClass('pop-out-menu-open')
    jQuery('.hamburger-menu').toggleClass('open-close')
    jQuery('body').toggleClass('show-hide')
  });

  jQuery('.video-slideshow').slick({
    infinite: true,
    speed: 1000,
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });

  jQuery('.trending-post-listing').slick({
    infinite: true,
    speed: 1000,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: false,
    responsive: [
      {
        breakpoint: 768, // Adjust the breakpoint according to your needs
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  jQuery('.editor-pick-slider').slick({
    slidesToShow: 3, // Set the number of slides to show
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    centerMode: true,
    variableWidth: true,
    infinite: true,
    focusOnSelect: true,
    cssEase: 'ease', // You can customize the easing function here
    speed: 600, // Set the speed of the animation in milliseconds (0.3 seconds in this case)
    touchMove: true,
    prevArrow: '<button class="slick-prev"> < </button>',
    nextArrow: '<button class="slick-next"> > </button>',
    responsive: [
      {
        breakpoint: 768, // Adjust the breakpoint according to your needs
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  jQuery('.bottom-box').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 768, // Adjust the breakpoint according to your needs
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  jQuery(".personalise-my-feed .form-element label").click(function () {
    jQuery(this).siblings().removeClass('active')
    jQuery(this).toggleClass('active')
  });
});