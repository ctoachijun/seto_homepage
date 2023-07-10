<?
include "../lib/seto.php";

// 로그인 체크
chkLogin();

// 세션값 세팅. 이후 접속한 모든 동작은 아래 변수가 이용된다.
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
?>



<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자</title>
  <link href="./css/admin.css" rel="stylesheet">
</head>

<body>
  <div class="backblack"></div>


<? if($current != "firstConnect.php"){ ?>
<div class="row">
  <input type="button" value="로그아웃" onclick="logOut()"/>
</div>
<? } ?>


