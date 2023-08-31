<?
   include "../lib/seto.php";
   include "../lib/PHPExcel/Classes/PHPExcel.php";


   
   $count = array("W","X","Y","Z","AA");
   
   for($i=50; $i<=61; $i++){
      foreach($count as $v){
      //  echo "=SUMIFS(U2:U22,F2:F22,\">=\"&H{$i},F2:F22,\"<=\"&I{$i},B2:B22,\"=\"&\"{$v}\")";
      //  echo "=SUMIFS(U2:U22,E2:E22,\">=\"&H{$i},E2:E22,\"<=\"&I{$i},F2:F22,\">=\"&H{$i},F2:F22,\"<=\"&I{$i},B2:B22,\"=\"&\"{$v}\")+SUMIFS(U2:U22,E2:E22,\"<\"&H{$i},F2:F22,\">=\"&H{$i},F2:F22,\"<=\"&I{$i},B2:B22,\"=\"&\"{$v}\")+SUMIFS(U2:U22,E2:E22,\">=\"&H{$i},E2:E22,\"<=\"&I{$i},F2:F22,\">\"&I{$i},B2:B22,\"=\"&\"{$v}\")";
         echo "=프로젝트별!{$v}{$i}";
         echo "<br>";
      }
      echo "<br><br>";
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


