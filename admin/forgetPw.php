<?
  include "../lib/seto.php";
  include "../lib/directsend.php";
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
          <div class="top_div d-flex">
            <p>비밀번호 찾기</p>
          </div>
          <div class="cont_div d-flex">
            <div class="desc_div d-flex">
                <p>등록되어 있는 ID를 입력하시면, 해당 메일계정으로 임시 비밀번호 메일을 발송합니다.</p>
                <p>임시 비밀번호를 이용해 로그인, 비밀번호 변경 후 이용하시면 됩니다.</p>
                
            </div>
              <div class="left_cont">
                <div class="head">
                  <span>ID :</span> 
                </div>
                <div class="inputd">
                  <input type="text" class="txt-input" id="uid" name="uid" placeholder="ID를 입력 해 주세요.(이메일)" onchange="chkSpaceFe(this)" /><br />
                </div>
              </div>
            <div class="right_div d-flex">
              <button type="button" class="btn btn-ok" onclick="sendTempPw()">변경</button>
            </div>
          </div>
        </div>

      </div>
  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
  
  <script type="text/javascript">
    $(".txt-input").on("keydown",function(key){
      if(key.keyCode==13) {
            sendTempPw();
        }
    });
    
  </script>