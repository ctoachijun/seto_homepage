</div> <!-- id : main -->

<div class="footer d-flex">
  copyright© Setoworks Co., Ltd.
</div>
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
  
  <script>
    // PC버전일때 호버
    $("nav .menu4").hover(function(){
      $('.menu4_drop').slideUp();
      if ($(this).children('.menu4_drop').is(':hidden')){
        $(this).children('.menu4_drop').slideDown();
      } else{
        $(this).children('.menu4_drop').slideUp();
      }
      
      $("nav .menu4_drop_line").css("color","#fff");
      $("nav .dactive").css("color","#E6002D");
    })
    $("nav .menu4_drop_line").hover(function(){
      $("nav .menu4_drop_line").css("color","#fff");
      $(this).css("color","#E6002D");
    })

    // 모바일 버전일때 호버
    $("nav .mmenu4").hover(function(){
      $("nav .mmenu4_drop_line").css("color","#fff");
      $("nav .dactive").css("color","#E6002D");
    })
    $("nav .mmenu4_drop_line").hover(function(){
      $("nav .mmenu4_drop_line").css("color","#fff");
      $(this).css("color","#E6002D");
    })
   
    
    // pc, 모바일 다 사용
    $(".acc_div img").click(function(){
      $(".nav_div").toggle(300);
    })
    
    // 모바일 아코디언
    $('.mmenu4').click(function(){
         $('.mmenu4_drop').slideUp();
         if ($(this).children('.mmenu4_drop').is(':hidden')){
            $(this).children('.mmenu4_drop').slideDown();
         } else{
            $(this).children('.mmenu4_drop').slideUp();
         }
    });
    
  </script>
  
  
  </body>
</html>
  