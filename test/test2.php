<!DOCTYPE html>
<html lang="ko">

   <head>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
      <style>
        .swiper-slide{width:300px;height:300px;display:flex;justify-content: center;align-items:center;border:1px solid #999;}
      </style>
   </head>
   <body>
   <div class="swiper">
    <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide">Slide 1</div>
    <div class="swiper-slide">Slide 2</div>
    <div class="swiper-slide">Slide 3</div>
    <div class="swiper-slide">Slide 4</div>
    <div class="swiper-slide">Slide 5</div>
    <div class="swiper-slide">Slide 6</div>
    <div class="swiper-slide">Slide 7</div>
  </div>
  <!-- If we need pagination -->
  <!-- <div class="swiper-pagination"></div> -->

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <!-- If we need scrollbar -->
  <!-- <div class="swiper-scrollbar"></div> -->
</div>
   


<script>
    const swiper = new Swiper('.swiper', {
      direction: 'horizontal',
      slidesPerView : 3,
      loop: true,
      spaceBetween : 10,
      pagination: {
        el: '.swiper-pagination',
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      scrollbar: {
        el: '.swiper-scrollbar',
      },
      autoplay : {
        delay : 2000,
        disableOnInteraction : false,
      },
      breakpoint : {
        200 : {
          slidesPerView : 1
        },
        766 : {
          slidesPerView : 3
        }
      }
    });
</script>

   </body>
</html>
