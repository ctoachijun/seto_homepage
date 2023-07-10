<?
  include "../lib/seto.php";
  

  if($logout == "logout"){
    session_destroy();
    // var_dump($_SESSION);
    // echo "<br>";
  }else{
    if($_SESSION){
      // header("./main.php");
      page_move("main.php");
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


  <div id="logIn">
    <div class="content">
        ID : <input type="text" class="txt-input" id="uid" name="uid" /><br />
        PW : <input type="password" class="txt-input" id="upw" name="upw" autocomplete="new-password" />
        <input type="button" class="btn btn-ok" value='로그인' onclick="chkAccount()"/>
    </div>
  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
  
  <script type="text/javascript">
    $("input").on("keyup",function(key){
        if(key.keyCode==13) {
            chkAccount();
        }
    });
  </script>