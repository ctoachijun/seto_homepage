<?php
  include "lib/seto.php";
  
  /*
    이하 헤더에 들어갈 함수들.
  */

  // 방문자 카운트 체크
  visitCount();
  
  // 접속 IP를 기반으로 어디서 접속했는지 확인.
  $ipaddr = $_SERVER['REMOTE_ADDR'];
  $code = chkConnCountry($ipaddr);
  
  foreach($_SERVER as $k => $v){
    echo "$k : $v <br>";
  }
  
  
  
  if($code == "KR"){
    echo '한국서 접속';
  }else if($code == "JP"){
    echo "일본서 접속";
  }else if($code == "TW"){
    echo "대만서 접속";
  }else if($code == "US"){
    echo "미쿸서 접속";
  }
  
  
  
?>

<div style="width:100%; display:flex; justify-content:center;flex-direction:column;align-items:center;">
  <h3>자..이제 홈페이지를 시작해볼까?</h3>
  <img style="width:200px" src="./img/Frieza.webp" />
</div>