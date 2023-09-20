<?
   include "../lib/seto.php";
   include "../lib/PHPExcel/Classes/PHPExcel.php";

?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>GSAP</title>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<!-- CDN -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>		 -->
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
   <style>
      .tweenbox {
         position: absolute;
         top: 0;
         left: 0;
         width: 10px;
         height: 10px;
         background-color:lightcoral;
         border: 1px solid orangered;
      }
   </style>

   <script>
      $(function(){
         TweenMax.to('.tweenbox', 3, {
            bezier: [
               {top:200, left:200},
               // {top:0, left:400},
               {top:100, left:600}
            ], 
            ease: Power1.easeInOut, 
            repeat: 1,
            
         });
      });   
   </script>
</head>
<body>

   <div class="tweenbox">
   </div>

</body>
</html>

