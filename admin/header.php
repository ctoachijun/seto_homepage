<?
include "../lib/seto.php";

// 로그인 체크
chkLogin();

// 세션값 세팅. 이후 접속한 모든 동작은 아래 변수가 이용된다.
$aidx = $_SESSION['aidx'];
$aid = $_SESSION['aid'];
$aname = $_SESSION['aname'];
$agrade = $_SESSION['agrade'];

$current = preg_replace("/\/admin\//","",$_SERVER['SCRIPT_NAME']);

$port_act = $moon_act = $mail_act = $acc_act = "";
$drop1_act = $drop2_act = "";
if($current == "portpolList.php" || $current == "portpolReg.php"){
  $port_act = "active";
}else if($current == "mooniList.php"){
  $moon_act = "active";
}else if($current == "mailList.php" || $current == "mailSend.php"){
  $mail_act = "active";
}else if($current == "accountList.php" || $current == "accountReg.php" || $current == "adminLog.php"){
  $acc_act = "active";
  
  $current == "adminLog.php" ? $drop2_act = "dactive" : $drop1_act = "dactive";
  
}


// 첫 접속시 비밀번호 변경 페이지로 이동시킴.
// 단, 비밀번호 변경 페이지인 경우에는 제외
if($current != "firstConnect.php"){
  $admin = getAdminInfo($aidx);
  $first = $admin['a_first'];
  if($first == "Y"){
    header("Location: firstConnect.php");
  }
}

$noimg = "/img/no_img1.jpg";

?>



<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자</title>
  <link href="./css/admin.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/77ad8525ff.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="backblack"></div>
  
  <? if($current != "firstConnect.php"){ ?>
  <nav class="notmobi d-flex">
    <div class="logo_div">
      <a href="/admin"><img src="../img/seto_logo.png" /></a>
    </div>
    <div class="nav_div d-flex">
      <div class="menu1 <?=$port_act?>"><a href="portpolList.php">포트폴리오</a></div>
      <div class="menu2 <?=$moon_act?>"><a href="mooniList.php">문의</a></div>
      <div class="menu3 <?=$mail_act?>"><a href="mailList.php">뉴스레터</a></div>
      <? if($agrade == "A"): ?>
        <div class="menu4 <?=$acc_act?>">
          계정관리
          <div class="menu4_drop d-flex">
            <div class="menu4_drop_line <?=$drop1_act?>" onclick="accpageMove(1)">관리자 계정관리</div>
            <div class="menu4_drop_line <?=$drop2_act?>" onclick="accpageMove(2)">관리자 로그</div>
            <? if($aid == "bbangs") : ?>
            <div class="menu4_drop_line <?=$drop3_act?>" onclick="accpageMove(3)">방문자 로그</div>
            <? endif; ?>
          </div>
        </div>
      <? endif; ?>      
    </div>
    <div class="acc_div d-flex">
      <span class="aname">Hi~ <?=$aname?>님</span>
      <span class="lout" onclick="logOut()">로그아웃</span>
    </div>
  </nav>
  <? } ?>
  
  <nav class="mobi">
    <div class="top_div">
      <div class="logo_div">
        <a href="/admin"><img src="../img/seto_logo.png" /></a>
      </div>
      <div class="acc_div">
        <img src="../img/hamb.png" />
      </div>
    </div>
    <ul class="nav_div">
      <li class="mmenu1"><a href="portpolList.php">포트폴리오</a></li>
      <li class="mmenu2"><a href="mooniList.php">문의</a></li>
      <li class="mmenu3"><a href="mailList.php">뉴스레터</a></li>
      <? if($agrade == "A"): ?>
        <li class="mmenu4">
          <a>계정관리</a>
          <ul class="mmenu4_drop">
            <li class="mmenu4_drop_line <?=$drop1_act?>" onclick="accpageMove(1)">관리자 계정관리</li>
            <li class="mmenu4_drop_line <?=$drop2_act?>" onclick="accpageMove(2)">관리자 로그</li>
            <? if($aid == "bbangs") : ?>
            <li class="mmenu4_drop_line <?=$drop3_act?>" onclick="accpageMove(3)">방문자 로그</li>
            <? endif; ?>
          </ul>
      </li>
      <? endif; ?>      
      <li class="mmenu5">          
        <span class="aname"><?=$aname?>님</span>
        <span class="lout" onclick="logOut()">로그아웃</span>
      </li>

    </div>

    <!-- <nav class="mobi">
    <div class="top_div">
      <div class="logo_div">
        <a href="/admin"><img src="../img/seto_logo.png" /></a>
      </div>
      <div class="acc_div">
        <img src="../img/hamb.png" />
      </div>
    </div>
    <div class="nav_div">
      <div class="menu1"><a href="portpolList.php">포트폴리오</a></div>
      <div class="menu2"><a href="mooniList.php">문의</a></div>
      <div class="menu3"><a href="mailList.php">뉴스레터</a></div>
      <? if($agrade == "A"): ?>
        <div class="menu4">
          <a>계정관리</a>
          <div class="menu4_drop">
            <div class="menu4_drop_line <?=$drop1_act?>" onclick="accpageMove(1)">관리자 계정관리</div>
            <div class="menu4_drop_line <?=$drop2_act?>" onclick="accpageMove(2)">관리자 로그</div>
          </div>
        </div>
      <? endif; ?>      
      <div class="menu5">          
        <span class="aname"><?=$aname?>님</span>
        <span class="lout" onclick="logOut()">로그아웃</span>
      </div>

    </div> -->
    
    
    
  </nav>
  
  <div id="main">
  
