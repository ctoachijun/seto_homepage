<?
   include "../lib/seto.php";
   include "../lib/PHPExcel/Classes/PHPExcel.php";
?>


<!DOCTYPE html>
<html lang="ko">

   <head>
      <!-- AOS 라이브러리 불러오기-->
      <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"> 
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
      <style>
         #container{width:100%;height:90vh;display:flex;justify-content:center;align-items:center;border:1px solid #444}
         .content{position:relative;border:2px solid #444;width:50%;height:300px;}
         .box{
            width:300px;height:250px;border:1px solid #444;position:absolute;left:50%;top:50%;transform:translate(-50%, -50%);
            animation-duration:2s;
            animation-iteration-count:1;
            animation-timing-function:ease-in;
            animation-fill-mode: forwards;
         }
         .b1{border:3px solid;animation-direction:nomal;animation-name:ldirection}
         .b2{border:2px solid red;}
         .b3{border:1px solid blue;animation-direction:nomal;animation-name:rdirection}
         
         @-webkit-keyframes ldirection{
            0%{left:50%;}
            100%{left:0%;}
         }
         @-webkit-keyframes rdirection{
            0%{left:50%;}
            100%{left:100%;}
         }

      </style>
   </head>
   <body>
      <div id="container">
         <div class="content">
            <div class="box b1"></div>
            <div class="box b2"></div>
            <div class="box b3"></div>
            <!-- <div class="box b1" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500"></div>
            <div class="box b2" data-aos=""></div>
            <div class="box b3" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1500"></div> -->
         </div>
      </div>
   




      <script>
         // AOS.init();
      </script>
   </body>
</html>


