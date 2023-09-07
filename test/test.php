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
   
   $key = array("1B8qIYm2a2AZWz-lDlEAA9wBzcl_blZrJQbAQRD02hbU","1LB7VNo2UMkpeXRbbzECGkGZ9_EsvaV5Gm0VYHb2zrJA","1j16M4UvNPyzgsnsk7dVVwBXnFwr-8RBX9GxnRpl46ro","12JfqNwQNHF8RiQybzTcdlOFMw8BXUIBscAC2W7xBmH0","1yGMwL4YS-IuBbs0Z21qC9TnSrVVfH4CqSlp0SO_iEtA");
   $count = array("한국","일본","미국","대만","기타");
   
   for($a=289,$b=1; $a<=372; $a++,$b++){
      if($b==13){
         $b=1;
         echo "<br><br> ======= <br><br>";
      }
      for($i=0; $i<5; $i++){
         echo "=IMPORTRANGE(\"".$key[$i]."\",\"'".$count[$i]."'!B{$a}\")<br>";
      }
      echo "<br>";
   }
   
   
      
     

exit;

?>


<!DOCTYPE html>
<html lang="ko">

   <head>
      <style>
         #container{width:100%;display:flex;justify-content:center;border:1px solid #444}
         .content{position:relative;border:2px solid #444;width:50%;height:auto;}
         .top_div{position:relative;height:300px;margin-bottom:100px;}
         .middle_div{position:relative;height:1500px;margin-bottom:50px;}
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
         .b4{height:100%;border:1px solid #444;}

      </style>
      <script>
         window.onload = function(){
            // console.log("이거 자식창임. 로딩시에는 전송 안함.");
            // window.parent.postMessage({ childData : 'child child' }, 'https://protoseto.imweb.me');
            let wp = window.parent;
            // wp.postMessage({ "childData" : "abcd" }, '*');
            // console.log("전송 완료!!");
            window.addEventListener('message', function(e) {
               // console.log("===============");
               // console.log('부모창에서 메세지 받음!');
               // console.log(e.data);
               // console.log("e.origin : " + e.origin);
               // console.log("===============");
            
               if(e.data.parentData == "goheight"){
                  wp.postMessage({ "ifheight" : document.body.scrollHeight }, 'https://protoseto.imweb.me');
               }else if(e.data.parentData == "chgCont"){
                  // console.log(document.getElementById('cont').innerHTML);
                  document.getElementById('cont').innerHTML='dklfjskjfd';
                  // console.log(document.getElementById('cont').innerHTML);
               }
               // console.log("부모창에서 데이터 받은 후 바로 전송!!");
            });
         
            console.log(document.body.scrollHeight);
         };
         
      </script>      
   </head>
   <body>
      <div id="container">
         <div class="content">
            <div class="top_div">
               <div class="box b1"></div>
               <div class="box b2"></div>
               <div class="box b3"></div>
            </div>
            <div class="middle_div">
               <div class="b4">
                  <div class="title"><h2>여기서부터가 본문.이거슨 타이틀</div>
                  <div id="cont" class="cont">여기는 본문 내용. 어디까지 이어질까. 아무튼. height 100vh 주고 부모창에서 해보겠음</div>
               </div>
            </div>               
         </div>
      </div>
   

   </body>
</html>


