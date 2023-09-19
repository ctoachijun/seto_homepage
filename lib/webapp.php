<?php
$root_path = $_SERVER['DOCUMENT_ROOT'];
require_once $root_path . "/lib/db_config.php";


$host = $_SERVER["SERVER_NAME"];

ini_set("session.use_trans_sid", 0); // PHPSESSID를 자동으로 넘기지 않음
ini_set("url_rewriter.tags", ""); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)
ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 10800); // session data의 garbage collection 존재 기간을 지정 (초)
ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
ini_set("session.gc_divisor", 100); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.
ini_set("session.cookie_lifetime", 0);

// ini_set("session.cookie_domain",$host);
ini_set('display_errors', 0);
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

session_start();
//==========================================================================================================================
// extract($_GET); 명령으로 인해 page.php?_POST[var1]=data1&_POST[var2]=data2 와 같은 코드가 _POST 변수로 사용되는 것을 막음
// 081029 : letsgolee 님께서 도움 주셨습니다.
//--------------------------------------------------------------------------------------------------------------------------
$ext_arr = array(
  'PHP_SELF',
  '_ENV',
  '_GET',
  '_POST',
  '_FILES',
  '_SERVER',
  '_COOKIE',
  '_SESSION',
  '_REQUEST',
  'HTTP_ENV_VARS',
  'HTTP_GET_VARS',
  'HTTP_POST_VARS',
  'HTTP_POST_FILES',
  'HTTP_SERVER_VARS',
  'HTTP_COOKIE_VARS',
  'HTTP_SESSION_VARS',
  'GLOBALS'
);
$ext_cnt = count($ext_arr);
for ($i = 0; $i < $ext_cnt; $i++) {
  // POST, GET 으로 선언된 전역변수가 있다면 unset() 시킴
  if (isset($_GET[$ext_arr[$i]]))
    unset($_GET[$ext_arr[$i]]);
  if (isset($_POST[$ext_arr[$i]]))
    unset($_POST[$ext_arr[$i]]);
}

// PHP 4.1.0 부터 지원됨
// php.ini 의 register_globals=off 일 경우
@extract($_GET);
@extract($_POST);
@extract($_SERVER);


function sumMonth($start,$end){
  global $arr_sum,$arr_txt;
  $today = date("Y-m");
  
  $cmonth = substr($end,5,2);
  $cyear = substr($end,0,4);
  $dstart = $start."-01";
  $dend = date("Y-m-t",mktime(0,0,0,$cmonth,1,$cyear));
  
  // 개월차를 구함  
  $date1 = new DateTime($dstart);
  $date2 = new DateTime($dend);
  $interval = date_diff($date1, $date2);

  // 1년 이상 차이가 나면 12개월 더하기(연도가 바뀌는게 아닌 1년 차이상.)
  $ycha = $interval->y;
  $mcha = $interval->m;
  if($ycha > 0){
    $mcha += $ycha * 12;
  }
  
  // 왜인지.. 1월에는 2월이 같이 나온다. diff에서 개월차 수가 그렇게 됨.
  // 전년 10월~ 당년 1월 = 4개월차  / 전년 10월~당년 2월 = 4개월차.
  // 그래서 1월에는 차수 하나 빼주기
  if($cmonth == "01"){
    $mcha--;
  }

  $tmp_start = $start;
  for($i=0; $i<=$mcha; $i++){
    $arr_sum[$tmp_start] = "0|0";
    
    $sbox = explode("-",$tmp_start);
    // 12월이면 연도 +1, 밑에서 1을 더하므로 월은 0으로.
    if($sbox[1] == 12){
      $sbox[0] += 1;
      $sbox[1] = 0;
    }
    $sbox[1] = sprintf("%02d",$sbox[1]+1);
    $tmp_start = implode("-",$sbox);
  }
  
  // $sql = "SELECT * FROM ex_wp1_stp WHERE ewstp_date >= '{$dstart}' AND ewstp_date <= '{$dend}'";
  $sql = "SELECT * FROM ex_wp1_stp";
  $re = sql_query($sql);
  
  // 멤버 한명당 수치를 대입해서 합산
  foreach($re as $v){
    $mstart = substr($v['ewstp_date'],0,7);
    
    // echo $v['ewstp_name'];
    // echo "<br>";
    
    $diff1 = new DateTime($mstart);
    $diff2 = new DateTime($today);
    $interv = date_diff($diff1,$diff2);
    
    $interv_y = $interv->y;
    $interv_m = $interv->m;
    if($interv_y > 0){
      $interv_m += 12;
    }
  
   
    // 멤버의 시작 년월
    $ms_date = $mstart;
    for($i=0; $i<=$interv_m; $i++){
      
      $moncha = getSssValue($i);

      if($ms_date >= $start && $ms_date <= $end){
        // 안의 데이터를 꺼내서 합산 후 다시 문자열로 대입
        $inbox = $arr_sum[$ms_date];
        if(!$inbox || $inbox === 0){
          $arr_sum[$ms_date] = $moncha;
        }else{
          $box = explode("|",$inbox);
          $incnt = $box[0];
          $inamount = $box[1];
          
          $monbox = explode("|", $moncha);
          $moncnt = $monbox[0];
          // if($moncnt > 0 ) $moncnt = 1;
          $monamount = $monbox[1];
          
          $sum_cnt = $incnt + $moncnt;
          $sum_amount = $inamount + $monamount;
          $sum_txt = $sum_cnt."|".$sum_amount;
          
          $arr_sum[$ms_date] = $sum_txt;
        }
      }
      // $arr_sum[$ms_date] = getSssValue($i);
      // 시작일의 한달 뒤
      $after_month = date("Y-m-d",strtotime("+1 months", strtotime($ms_date."-01")));
      $ms_date = substr($after_month,0,7);
    }
    // foreach($arr_sum as $k => $v){
    //   echo "$k : $v <br>";
    // }
    // echo "<br><br>";
  }
}
function getSssValue($num){
  $sql = "SELECT * FROM ex_wp1_sss WHERE ews_step = '{$num}'";
  $re = sql_fetch($sql);
  
  if(!$re){
    $sql = "SELECT * FROM ex_wp1_sss ORDER BY ews_idx DESC LIMIT 0,1";
    $re = sql_fetch($sql);
  }
  
  $cnt = $re['ews_count'];
  $amt = $re['ews_amount'];
  
  if(!$cnt) $cnt = 0;
  if(!$amt) $amt = 0;  
  $res = $cnt."|".$amt;
  
  return $res;
}

function getSumMember($start,$end){
  
  $cmonth = substr($end,5,2);
  $cyear = substr($end,0,4);
  $dstart = $start."-01";
  $dend = date("Y-m-t",mktime(0,0,0,$cmonth,1,$cyear));
  
  // 개월차를 구함  
  $date1 = new DateTime($dstart);
  $date2 = new DateTime($dend);
  $interval = date_diff($date1, $date2);

  // 1년 이상 차이가 나면 12개월 더하기(연도가 바뀌는게 아닌 1년 차이상.)
  $ycha = $interval->y;
  $mcha = $interval->m;
  if($ycha > 0){
    $mcha += $ycha * 12;
  }
  
  // 왜인지.. 1월에는 2월이 같이 나온다. diff에서 개월차 수가 그렇게 됨.
  // 전년 10월~ 당년 1월 = 4개월차  / 전년 10월~당년 2월 = 4개월차.
  // 그래서 1월에는 차수 하나 빼주기
  if($cmonth == "01"){
    $mcha--;
  }

  $tmp_start = $start;
  for($i=0; $i<=$mcha; $i++){
    $arr_mcnt[$tmp_start] = 0;
    
    $sbox = explode("-",$tmp_start);
    // 12월이면 연도 +1, 밑에서 1을 더하므로 월은 0으로.
    if($sbox[1] == 12){
      $sbox[0] += 1;
      $sbox[1] = 0;
    }
    $sbox[1] = sprintf("%02d",$sbox[1]+1);
    $tmp_start = implode("-",$sbox);
  }

  // sql 검색시, 년월만하면 1일 기준으로 하기때문에 종료월이 매칭이 안된다.
  // 해당월 말일을 구한다음에 검색하는걸로.
  $emonth = substr($end,5,2);
  $eyear = substr($end,0,4);
  $start_start = $start."-01";
  $last_end = date("Y-m-t",mktime(0,0,0,$emonth,1,$eyear));
  $sql = "SELECT * FROM ex_wp1_stp WHERE ewstp_date >= '{$start_start}' AND ewstp_date <= '{$last_end}'";
  $re = sql_query($sql);

  foreach($re as $v){
    $target = $v['ewstp_date'];
    $tidx = substr($target,0,7);
    $arr_mcnt[$tidx] = $arr_mcnt[$tidx] + 1;
  }

  return $arr_mcnt;
}


?>