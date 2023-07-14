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




/*
  공통 함수
*/

// 파일 이름 중복피하기
function getFilename($fname,$dir){
  for($d=1; $d<100; $d++){
    $fjud = file_exists($dir."/".$fname);
    if($fjud){
      $box = explode(".",$fname);
      $f = $box[0]."({$d}).".$box[1];

      // 바꾼이름으로 한번 더 체크
      $fjud2 = file_exists($dir."/".$f);
      if($fjud2){
        continue;
      }else{
        break;
      }

    }else{
      $f = $fname;
      break;
    }
  }
  
  return $f;
}
function alert($txt){
  echo "<script>alert('{$txt}');</script>";
}
function alert_back($txt){
  echo "<script>alert('{$txt}');history.go(-1);</script>";
}
function alert_href($txt,$page){
  echo "<script>alert('{$txt}');location.href='{$page}'</script>";
}
function page_back(){
  echo "<script>pageBack();</script>";
}
function page_move($page){
  echo "<script>location.href='{$page}'</script>";
}

function qsChgForminput($qs,$nopt){
  $box = explode("&",$qs);
  foreach($box as $v1){
    if($v1){
      $box2 = explode("=",$v1);
      $name = $box2[0];
      $value = $box2[1];
      if(array_search($name,$nopt) === 0 || array_search($name,$nopt)){
      }else{
        $html .= "<input type='hidden' name='{$name}' value='{$value}' />";
        if($name == "cur_page"){
          $html .= "<input type='hidden' name='return_cur' value='{$value}' />";
        }
      }
    }
  }
    
  return $html;
}
function getPaging($tbl, $qs, $where){

  if($tbl == "setohp_log"){
    $tbl_name = "sthp_admin_log";
  }else if($tbl == "setohp_moon"){
    $tbl_name = "sthp_inquiry";
  }else if($tbl == "setohp_mail_list"){
    $join = "as s LEFT OUTER JOIN sthp_sendmail_log as sl ON s.s_idx = sl.sl_sidx";
    $tbl_name = "sthp_sendmail {$join}";
    
  }else if($tbl == ""){
    $tbl_name = "";
  }
  
  // 쿼리스트링에서 변수 및 값 대입
  $box = explode("&",$qs);
  foreach($box as $v1){
    if($v1){
      $box2 = explode("=",$v1);
      $arr[$box2[0]] = $box2[1];
      
      // if($box2[0] == "return_cur"){
      //   $box2['cur_page'] = $box2[1];
      // }
    }
  }
  // if(empty($arr['pqs'])){
  //   $arr['pqs'] = $qs;
  // }
  
  
  foreach($arr as $i => $v){
    $$i = $v;
    // echo "$i - $v <br>";
  }
  
  
  // if (!empty($where)) $where = "WHERE 1 " . $where;
  $sql = "SELECT count(*) as total FROM {$tbl_name} {$where}";
  // echo "top sql : $sql <br>";

  $re = sql_fetch($sql);
  $tcnt = $re['total']; // 전체 게시물수
  $total_cnt = $tcnt; // 쿼리스트링 세팅

  $page_rows = $end; // 한페이지에 표시할 데이터 수
  $total_page = ceil($tcnt / $page_rows); // 총 페이지수

//  echo "tcnt : $tcnt <br>";
// echo "page_rows = $page_rows";
// echo "total_page : $total_page <br>";

  // 총페이지가 0이라면 1로 설정
  if ($total_page == 0) {
    ++$total_page;
  }

  // $end == 20 ? $block_limit = 7 : $block_limit = 10;
  $block_limit = 10; // 한 화면에 뿌려질 블럭 개수
  $total_block = ceil($total_page / $block_limit); // 전체 블록수
  $cur_page = $cur_page ? $cur_page : 1; // 현재 페이지
  $cur_block = ceil($cur_page / $block_limit); // 현재블럭 : 화면에 표시 될 페이지 리스트
  $first_page = (((ceil($cur_page / $block_limit) - 1) * $block_limit) + 1); // 현재 블럭의 시작
  $end_page = $first_page + $block_limit - 1; // 현재 블럭의 마지막

  // echo "total_block : $total_page block <br>";
  // echo "cur_block : $cur_block<br>";
  // echo "cur_page : $cur_page<br>";
  // echo "first_page : $first_page <br>";
  // echo "end_page : $end_page <br>";
  // echo "block_limit : $block_limit <br>";



  if ($total_page < $end_page) {
    $end_page = $total_page;
  }

  $prev = $first_page - 1;
  $next = $end_page + 1;
  // 페이징 준비 끝


  // $sql = "SELECT * FROM {$tbl_name} LIMIT {$first_page},{$end_page}";
  // // echo $sql;
  // $total_cnt = sql_num_rows($sql);

  // 이전 블럭을 눌렀을때 현재 페이지 세팅.
// $prev_block = $cur_page - $block_limit;
// 처음 if 조건은, 현재페이지가 23페이지일경우, 이전블럭을 눌렀을때
//  20페이지가 아닌, 13페이지로 세팅이 되어서 계산조절한것.
  if ($end_page == $total_page) {
    $prev_block = floor($end_page / $block_limit) * $block_limit;
  } else {
    $prev_block = $end_page - $block_limit;
  }
  if ($prev_block < $block_limit + 1) {
    $prev_block = $block_limit;
  }

  // 다음블럭의 첫번째 페이지 산출
// $next_block = $cur_page + $block_limit;
  $next_block = $end_page + 1;
  if ($next_block > $total_page) {
    $next_block = (($cur_block + 1) * $block_limit) - ($block_limit - 1);
  }

  // 이전 버튼을 눌렀을때 LIMIT 처리
  $prev_start = $first_page - $block_limit;
  $prev_end = $end_page - $block_limit;
  if ($prev_start < $block_limit + 1) {
    $prev_start = 1;
    $prev_end = $block_limit;
  }

  // 다음 버튼을 눌렀을때 LIMIT 처리
  $next_start = $first_page + $block_limit;
  $next_end = $end_page + $block_limit;
  if ($next_end > $total_page) {
    $next_end = $total_page;
    if ($next_start > $next_end) {
      $next_start = $cur_block * $block_limit + 1;
    }
  }

  // echo "<br>";
// echo "prev_start : $prev_start <br>";
// echo "next_start : $next_start <br>";

  // 블럭 이동용 쿼리스트링 만들기 - 처음
  $prev_qs = $next_qs = "?";
  foreach($arr as $i => $v){
      if($i == "cur_page"){
        $prev_qs .= "cur_page={$prev_block}&";  
      }else if($i == "start"){
        $prev_qs .= "start={$prev_start}&";  
      }else{
        $prev_qs .= "{$i}={$$i}&";
      }
  }

  // 블럭 이동용 쿼리스트링 만들기 - 마지막
  foreach($arr as $i => $v){
      if($i == "cur_page"){
        $next_qs .= "cur_page={$next_block}&";  
      }else if($i == "start"){
        $next_qs .= "start={$next_start}&";  
      }else{
        $next_qs .= "{$i}={$$i}&";
      }
  }
  
  $cur_path = $_SERVER['SCRIPT_NAME'];
  $prev_url = $cur_path.$prev_qs; 
  $next_url = $cur_path.$next_qs;

  
  
  // var_dump($prev_qs);
  // echo "<br>";
  // var_dump($next_qs);
  

  // 이전, 다음버튼 제어 처리
  if ($cur_block == $total_block) {
    $end_class = "disabled";
    $li_href2 = " ";
  } else {
    $end_class = " ";
    $li_href2 = "href='{$next_url}'";
  }
  if ($cur_block == 1) {
    $start_class = "disabled";
    $li_href1 = " ";
  } else {
    $start_class = " ";
    $li_href1 = "href='{$prev_url}'";
  }


  
  
  // 페이지 이동용 쿼리스트링 만들기 
  $p_qs = "?";
  foreach($arr as $i => $v){
    if($i == "cur_page"){
    }else{
      $p_qs .= "{$i}={$$i}&";
    }
  }

  echo "<ul class='pagination'>";
  // <!-- li태그의 클래스에 disabled를 넣으면 마우스를 위에 올렸을 때 클릭 금지 마크가 나오고 클릭도 되지 않는다.-->
  // <!-- disabled의 의미는 앞의 페이지가 존재하지 않다는 뜻이다. -->
  echo "<li class='page-item {$start_class}'>";
  echo "<a {$li_href1}>«</a>";
  echo "</li>";
  // <!-- li태그의 클래스에 active를 넣으면 색이 반전되고 클릭도 되지 않는다. -->
// <!-- active의 의미는 현재 페이지의 의미이다. -->
  for ($i = $first_page; $i <= $end_page; $i++) {
    if ($i == $cur_page) {
      $act = "active";
      $cont = "<a>{$i}</a>";
    } else {
      $act = " ";
      
      $cur_url = $cur_path . $p_qs . "cur_page={$i}";
      $cont = "<a href='{$cur_url}'>{$i}</a>";
    }
    echo "<li class='page-item {$act}'>{$cont}</li>";
  }
  echo "<li class='page-item {$end_class}'><a {$li_href2}>»</a></li>";
  echo "</ul>";
}

function getFundingAmount($type,$id){
  if($type == 1){
    $url = "https://www.wadiz.kr/web/apip/funding/campaigns/{$id}/detail";
  }
  
  $ch = curl_init();                                 //curl 초기화
  curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함

  $response = curl_exec($ch);
  curl_close($ch);

  $arr = json_decode($response,true);
  $amount = $arr["data"]['totalFundingAmount'];
  
  
  return $amount;  
}





/*
관리자 함수
*/

function getLog($sql,$exec,$name){
  $sql = addslashes($sql);
  $lsql = "INSERT INTO sthp_admin_log SET al_name = '{$name}', al_exec = '{$exec}', al_sql = '{$sql}', al_wdate = now() ";
  sql_exec($lsql);
  return $lsql;
}

function chkTopAdmin($idx){
  $admin = getAdminInfo($idx);
  $grade = $admin['a_grade'];
  
  if($grade == "A"){
    return true;
  }else{
    return false;
  }
}

function chkLogin(){
  if( empty($_SESSION['aidx']) || empty($_SESSION['aid']) ){
    alert_href("관리자 전용 페이지입니다.","./");    
  }
}

function getAdminInfo($idx){
  $sql = "SELECT * FROM sthp_admin WHERE a_idx = {$idx}";
  return sql_fetch($sql);
}
function getAdminList($type,$sw){
  if($sw){
    $where = "AND a_{$type} like '%{$sw}%'";
  }
  $sql = "SELECT * FROM sthp_admin WHERE 1 {$where} ORDER BY a_idx DESC";

  return sql_query($sql);
}
function chkPermission($idx,$num){
  if($num == 1){
    $admin = getAdminInfo($idx);
    $first = $admin['a_first'];
    
    if($first == "N"){
      alert_back("접근 권한이 없습니다");
    }
  }
}
function getMooniInfo($idx){
  $sql = "SELECT * FROM sthp_inquiry as i INNER JOIN sthp_inquiry_type as it ON i.i_itidx = it.it_idx WHERE i.i_idx = {$idx}";
  return sql_fetch($sql);
}
function getMooniType($idx){
  $sql = "SELECT * FROM sthp_inquiry_type WHERE it_idx = {$idx}";
  $re = sql_fetch($sql);
  return $re['it_type'];
}
function getMooniTypeList(){
  $sql = "SELECT * FROM sthp_inquiry_type";
  return sql_query($sql);
}
function getPortpolioInfo($idx){
  $sql = "SELECT * FROM sthp_portpolio WHERE p_idx = {$idx}";
  return sql_fetch($sql);
}
function getNewsLetterInfo($idx){
  $sql = "SELECT * FROM sthp_sendmail WHERE s_idx = {$idx}";
  return sql_fetch($sql);
}
function getSendMailInfo($idx){
  $sql = "SELECT * FROM sthp_sendmail as s LEFT OUTER JOIN sthp_sendmail_log as sl ON s.s_idx = sl.sl_sidx WHERE s.s_idx = {$idx}";
  return sql_fetch($sql);
}