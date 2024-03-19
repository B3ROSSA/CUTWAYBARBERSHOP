$(document).ready(function(){ 
    $(".gallery__haircuts").hide();
    $("#phone").inputmask("+7 (999) 999-99-99");
    $("#restore_code").inputmask("9999");

});

// Слайдер Интерьер
var swiper = new Swiper(".mySwiper", {
    pagination: {
      el: ".swiper-pagination",
      type: "progressbar",
    },
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    loop: true,
  });

// Change gallery
$('#gallery__int').click(function(){
    $(".gallery__haircuts").hide();
    $(".gallery__interior").fadeIn(500);
    $("#gallery__haircuts").removeClass('gallery__active');
    $("#gallery__int").addClass('gallery__active');
});

$('#gallery__haircuts').click(function(){
    $(".gallery__interior").hide();
    $(".gallery__haircuts").fadeIn(500);
    $(".gallery__haircuts").css('display', 'flex');
    $("#gallery__int").removeClass('gallery__active');
    $("#gallery__haircuts").addClass('gallery__active');
});

// Кнопка "Наверх"
function backToTop() {
  var button = $('.back-to-top')

  if($(window.innerWidth) < 1200){
      button.hide();
  }
  else{
      $(window).on('scroll', () => {
          if($(this).scrollTop() >= 50){
              button.fadeIn();
          } else {
              button.fadeOut();
          }
      });

      button.on('click', (e) => {
          e.preventDefault();
          $('html').animate({scrollTop: 0}, 1000);
      })
  }
      
}
backToTop();

// Плавный якорь
$(function(){
    $("a.scrollto").click(function(){
        if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){
            var t=$(this.hash);
            if(t=t.length?t:$("[name="+this.hash.slice(1)+"]"),t.length)return $("html,body").animate({
                scrollTop:t.offset().top-70},
                1000),!1
            }
    })}
);


SmoothScroll({
    // Время скролла 400 = 0.4 секунды
    animationTime    : 1000,
    // Размер шага в пикселях 
    stepSize         : 75,

    // Дополнительные настройки:
    
    // Ускорение 
    accelerationDelta : 30,  
    // Максимальное ускорение
    accelerationMax   : 2,   

    // Поддержка клавиатуры
    keyboardSupport   : true,  
    // Шаг скролла стрелками на клавиатуре в пикселях
    arrowScroll       : 50,

    // Pulse (less tweakable)
    // ratio of "tail" to "acceleration"
    pulseAlgorithm   : true,
    pulseScale       : 4,
    pulseNormalize   : 1,

    // Поддержка тачпада
    touchpadSupport   : true,
})

