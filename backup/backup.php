<?php

/*
  백업은 언제 실행하든, PM12시 이전에는 {년월일_AM} 으로, PM12시부터 PM3시까지는 {년월일_PM1}, PM3시 이후로는 {년월일_PM2}로 생성합니다.
  하루에 총 3개까지만 생성되도록 했습니다.
  큰 작업이 있기전이나 혹시 모를 상황이 있다면 필히 실행시켜주시길 바랍니다.
  깃헙 커밋 되돌렸더니 파일이 다 사라지는걸 한번 경험했더니, 백업은 닥치고 필수라는걸 알게 됩니다. (뭐, 커밋 되돌리지 않는게 제일 좋습니다 ;;)
  
  DB 복원은 아래처럼 하시면 됩니다.
  mysql -u setoworks -p setoworks < [백업 한 sql파일]
  
  비밀번호는 따로 쳐야하지만, 전체 테이블 드롭 후, 기존에 있는 데이터를 INSERT 합니다.
  
*/

$today = date("ymd");
$hour = date("H");

if($hour <12){
  $fname = "{$today}_AM.tar.gz";
  $dbname = "{$today}_AM_db.sql";
}else if($hour >= 12 && $hour < 15){
  $fname = "{$today}_PM1.tar.gz";
  $dbname = "{$today}_PM1_db.sql";
}else{
  $fname = "{$today}_PM2.tar.gz";
  $dbname = "{$today}_PM2_db.sql";
}

$cmd = "tar zcvf {$fname} ../* --exclude=backup";
$db_cmd = "mysqldump -u setoworks -p --password=tpxhdnjrtm2@ --add-drop-table --set-charset --default-character-set=utf8 setoworks > {$dbname}";

echo "파일 체크 : {$fname} <br><br>";
if(is_file("./{$fname}")){
  
  echo "파일 있음요!<br>";
}else{
  echo "파일 없음! 백업 시작!!!<br>";
  echo "실행 : $cmd <br>";
  exec($cmd);
  
  echo "<br>{$fname} 파일 생성 여부 확인...";
  
  
  if(is_file("./{$fname}")){
    echo "<br><br>파일 생성 완료!!!<br><br>";
    
    //파일 생성이 되었으니 DB도 백업.
    echo "소스백업 했으니 이제 dB백업 들어갑니다.<br><br>";
    if(is_file("./{$dbname}")){
      echo "{$dbname} 파일 있습니다.<br>종료합니다.";
    }else{
      
      echo "{$dbname} 파일 없으니까 백업 들어가유~<br><br>";
      exec($db_cmd);
      
      echo "자.. 파일 생성되었는지 볼까요?<br><br>";
      
      if(is_file("./{$dbname}")){
        echo "우왕 굿!!! {$dbname} 파일 있습니다.<br><br>끗!!!!";
      }else{
        echo "어라.. DB백업에 실패한것같네요. 커맨드 확인 해주세요!<br><br>";
      }
    }
    
  }else{
    echo "<br><br>파일 생성 실패..";
  }
  
}





?>