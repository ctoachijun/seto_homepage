<?
   include "../lib/seto.php";
   include "../lib/PHPExcel/Classes/PHPExcel.php";


   // if($ipaddr){

   //    $res = chkConnCountry($ipaddr);
   //    $box = explode("/",$res);
      
   //    $code = $box[0];
   //    $country = $box[1];
      
   // }

   
   
   
   
   

?>

<form action="<?=$PHP_SELF?>" method="GET">
   <input type="text" name="ipaddr" placeholder="IP주소를 입력 해주세요." />
   <input type="submit" value="확인" />
</form>

<div>
   <p>입력 된 IP주소는 <strong><?=$ipaddr?></strong></p>
   <span>해당 IP주소의 국가는</span><h3><?=$country?>(<?=$code?>)</h3>

