<?
include "../lib/seto.php";

// 로그인 체크
chkLogin();

// 세션값 세팅
$aidx = $_SESSION['aidx'];
$aid = $_SESSION['aid'];
$aname = $_SESSION['aname'];

$current = preg_replace("/\/admin\//","",$_SERVER['SCRIPT_NAME']);

// 첫 접속시 비밀번호 변경 페이지로 이동시킴.
// 단, 비밀번호 변경 페이지인 경우에는 제외
if($current != "firstConnect.php"){
  $admin = getAdminInfo($aidx);
  $first = $admin['a_first'];
  if($first == "Y"){
    header("Location: firstConnect.php");
  }
}
