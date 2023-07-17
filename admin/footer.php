</div> <!-- id : main -->

<div class="footer d-flex">
  copyright© Setoworks Co., Ltd.
</div>
  
  
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
  
  <script>
    $("nav .menu4").hover(function(){
      $(".menu4_drop").toggle(500);
      $("nav .menu4_drop_line").css("color","#fff");
      $("nav .dactive").css("color","#E6002D");
    })
    $("nav .menu4_drop_line").hover(function(){
      $("nav .menu4_drop_line").css("color","#fff");
      $(this).css("color","#E6002D");
    })
    $(".acc_div img").click(function(){
      $(".nav_div").toggle(200);
    })

    
  </script>
  
  
  </body>
</html>
  