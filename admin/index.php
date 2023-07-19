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

        <div class="login_div">
          <div class="top_div d-flex wv-1">
            <img src="../img/seto_logo.png" />
            <p>관리자</p>
          </div>
          <div class="cont_div d-flex">
            <div class="left_div d-flex">
              <div class="left_cont">
                <div class="head">
                  <span>ID :</span> 
                </div>
                <div class="inputd">
                  <input type="text" class="txt-input" id="uid" name="uid" placeholder="ID를 입력 해 주세요.(이메일)"/><br />
                </div>
              </div>
              <div class="left_cont">
                <div class="head">
                  <span>비밀번호 :</span>
                </div>
                <div class="inputd">
                  <input type="password" class="txt-input" id="upw" name="upw" autocomplete="new-password" placeholder="Password를 입력 해 주세요." />
                </div>
              </div>
            </div>
            <div class="right_div d-flex">
              <input type="button" class="btn btn-ok" value='로그인' onclick="chkAccount()"/>
              <!-- <p class="fpt">비밀번호를 잊은 경우에는 <a href="./forgetPw.php">여기</a>를 클릭 해 주세요.</p> -->
            </div>
          </div>
        </div>

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