<?php

/*
  백업은 언제 실행하든, PM12시 이전에는 {년월일_AM} 으로, PM12시부터 PM3시까지는 {년월일_PM1}, PM3시 이후로는 {년월일_PM2}로 생성합니다.
  하루에 총 3개까지만 생성되도록 했습니다.
  큰 작업이 있기전이나 혹시 모를 상황이 있다면 필히 실행시켜주시길 바랍니다.
  깃헙 커밋 되돌렸더니 파일이 다 사라지는걸 한번 경험했더니, 백업은 닥치고 필수라는걸 알게 됩니다. (뭐, 커밋 되돌리지 않는게 제일 좋습니다 ;;)
*/

$today = date("ymd");
$hour = date("H");

if($hour <12){
  $fname = "{$today}_AM.tar.gz";
}else if($hour >= 12 && $hour < 15){
  $fname = "{$today}_PM1.tar.gz";
}else{
  $fname = "{$today}_PM2.tar.gz";
}

$cmd = "tar zcvf {$fname} ../* --exclude=backup";


echo "파일 체크 : {$fname} <br><br>";
if(is_file("./{$fname}")){
  
  echo "파일 있음요!<br>";
}else{
  echo "파일 없음! 백업 시작!!!<br>";
  echo "실행 : $cmd <br>";
  exec($cmd);
  
  echo "<br>{$fname} 파일 생성 여부 확인...";
  
  
  if(is_file("./{$fname}")){
    echo "<br><br>파일 생성 완료!!!";
  }else{
    echo "<br><br>파일 생성 실패..";
  }
  
}





?>