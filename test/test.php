<?
   include "../lib/seto.php";
   include "../lib/PHPExcel/Classes/PHPExcel.php";

   
   
   
   

   // for($i=0; $i<22; $i++){
   //    $ga = rand(5000000,50000000);
   //    $ga1 = ceil($ga / 100000);
   //    $ga = $ga1 * 100000;
      
   //    echo "$ga<br>";
   // }
   
   // exit;
   
//    $count = array("X","Y","Z","AA","AB");
//    $count = array("한국","일본","미국","대만","기타");
//    $count = array("B","C","D","E","F");

// $count = array("Wadiz","Makuake","Zeczec","Kickstarter","Kakaomakers","Funshop","Others");
// $count = array("H","I","J","K","L","M","N");

      // foreach($count as $v){
      // $v = "Kakaomakers";
      // $x = "O";
      // $y = "E";
      // $z = "F";
      // for($a=1,$i=215; $i<=226; $i++,$a++){
      //       if($a==13){
      //          $a = 1;
      //          echo "<br><br> ======== <br><br>";
      //       }
            // 국가별
            //  echo "=SUMIFS(U2:U22,F2:F22,\">=\"&H{$i},F2:F22,\"<=\"&I{$i},B2:B22,\"=\"&\"{$v}\")";
            //  echo "=SUMIFS(U2:U22,E2:E22,\">=\"&H{$i},E2:E22,\"<=\"&I{$i},F2:F22,\">=\"&H{$i},F2:F22,\"<=\"&I{$i},B2:B22,\"=\"&\"{$v}\")+SUMIFS(U2:U22,E2:E22,\"<\"&H{$i},F2:F22,\">=\"&H{$i},F2:F22,\"<=\"&I{$i},B2:B22,\"=\"&\"{$v}\")+SUMIFS(U2:U22,E2:E22,\">=\"&H{$i},E2:E22,\"<=\"&I{$i},F2:F22,\">\"&I{$i},B2:B22,\"=\"&\"{$v}\")";
            // echo "=SUMIFS(K2:K22,E2:E22,\">=\"&AD{$i},E2:E22,\"<=\"&AE{$i},B2:B22,\"=\"&\"{$v}\")";
            // echo "=SUMIFS(N2:N29,F2:F29,\">=\"&H{$i},F2:F29,\"<=\"&I{$i},B2:B29,\"=\"&\"{$v}\")";
            
            // 펀딩사이트
            // echo "=SUMIFS({$x}2:{$x}211,{$y}2:{$y}211,\">=\"&A{$i},{$y}2:{$y}211,\"<=\"&B{$i},C2:C211,\"=\"&\"{$v}\")";
            // echo "=SUMIFS(U2:U211,{$y}2:{$y}211,\">=\"&A{$i},{$y}2:{$y}211,\"<=\"&B{$i},{$z}2:{$z}211,\">=\"&A{$i},{$z}2:{$z}211,\"<=\"&B{$i},C2:C211,\"=\"&\"{$v}\")+SUMIFS(U2:U211,{$y}2:{$y}211,\"<\"&A{$i},{$z}2:{$z}211,\">=\"&A{$i},{$z}2:{$z}211,\"<=\"&B{$i},C2:C211,\"=\"&\"{$v}\")+SUMIFS(U2:U211,{$y}2:{$y}211,\">=\"&A{$i},{$y}2:{$y}211,\"<=\"&B{$i},{$z}2:{$z}211,\">\"&B{$i},C2:C211,\"=\"&\"{$v}\")";
            // echo "=SUMIFS(O2:O211,F2:F211,\">=\"&H{$i},F2:F211,\"<=\"&I{$i},C2:C211,\"=\"&\"{$v}\")";
            // echo "=프로젝트별!{$v}{$i}";
         //    echo "<br>";
         // }
         // echo "<br><br>";
      // }
   
   // $key = array(
   //    "1B8qIYm2a2AZWz-lDlEAA9wBzcl_blZrJQbAQRD02hbU","1LB7VNo2UMkpeXRbbzECGkGZ9_EsvaV5Gm0VYHb2zrJA","12JfqNwQNHF8RiQybzTcdlOFMw8BXUIBscAC2W7xBmH0","1j16M4UvNPyzgsnsk7dVVwBXnFwr-8RBX9GxnRpl46ro",
   //    "1B8qIYm2a2AZWz-lDlEAA9wBzcl_blZrJQbAQRD02hbU","1B8qIYm2a2AZWz-lDlEAA9wBzcl_blZrJQbAQRD02hbU","1yGMwL4YS-IuBbs0Z21qC9TnSrVVfH4CqSlp0SO_iEtA");
   // $count = array("한국","일본","대만","미국","한국","한국","기타");
  
   // for($a=289,$b=1; $a<=372; $a++,$b++){
   //    // for($a=229,$b=1; $a<=288; $a++,$b++){
   //       if($b==13){
   //          $b=1;
   //          echo "<br><br> ======= <br><br>";
   //       }
   //    $soon = 1;
   //    for($i=0; $i<6; $i++){
   //       if($soon == 5){
   //          $point = "E";
   //       }else if($soon == 6){
   //          $point = "F";
   //       }else if($soon == 7){
   //          $point = "G";
   //       }else{
   //          $point = "D";
   //       }
        
   //       echo "=IMPORTRANGE(\"".$key[$i]."\",\"'".$count[$i]."'!{$point}\${$a}\")<br>";
   //       $soon++;
   //    }
   //    for($i=0; $i<7; $i++){
   //       if($i === 0){
   //          $point = "G";
   //          $ipt = "=IMPORTRANGE(\"".$key[$i]."\",\"'".$count[$i]."'!{$point}\${$a}\")";
   //       }else if($i == 4 || $i == 5){
   //          continue;
   //       }else if($i == 6){
   //          $point = "D";
   //          $ipt .= "+IMPORTRANGE(\"".$key[$i]."\",\"'".$count[$i]."'!{$point}\${$a}\")";
   //       }else{
   //          $point = "E";
   //          $ipt .= "+IMPORTRANGE(\"".$key[$i]."\",\"'".$count[$i]."'!{$point}\${$a}\")";
   //       }

   //    }
   //    echo $ipt."<br>";
   //    echo "<br>";
   // }
   
   
      
     

// exit;

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

