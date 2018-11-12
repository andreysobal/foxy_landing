//swiper slider
var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    // navigation: {
    //   nextEl: '.swiper-button-next',
    //   prevEl: '.swiper-button-prev',
    // },

    // And if we need scrollbar
    // scrollbar: {
    //   el: '.swiper-scrollbar',
    // },
  })

//outside navigation arrows controllers
document.getElementById("prev-slide").addEventListener( "click" , function() {mySwiper.slidePrev();});
document.getElementById("next-slide").addEventListener( "click" , function() {mySwiper.slideNext();});