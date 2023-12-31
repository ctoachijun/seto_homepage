<?
  include "header.php";



  chkPermission($aidx,1);
  
  
  
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


  <div id="firstConnect">
    <div class="content">
      <div class="pw_div">
        <div class="logo_div"><img src="../img/seto_logo.png" /></div>
        <div class="pw_notice">
          ※계정 생성후, 또는 비밀번호 초기화 후 <span>처음 접속시</span>에는
          <span>비밀번호를 변경 후 이용</span>하셔야 합니다.
        </div>
        <div>
          <input type='hidden' name='pwjud' />
          
          현재 비밀번호 : <span class="error error_curpw"></span>
          <input type="password" class="txt-input" id="cpw" name="cpw" />
        </div>
        <div>
          
          새 비밀번호 : <span class="error error_pw"></span>
          <input type="password" class="txt-input" id="upw" name="upw" autocomplete="new-password" />
        </div>
        <div>
          새 비밀번호 확인: <input type="password" class="txt-input" id="urepw" name="reupw" autocomplete="new-password" />
        </div>
        <div>
          <input type="button" class="btn btn-ok" value='변경' onclick="chgPw()"/>
        </div>
      </div>
    </div>
  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
  <script>
    $(function(){
      
      $("input").on("keydown",function(key){
          if(key.keyCode==13) {
              chgPw();
          }
      });
      $("#cpw").change(function(){
        $.ajax({
          url : "ajax_admin.php",
          type: "post",
          data: {"w_mode":"chkPw","cpw":this.value},
          success: function(result){
            let json = JSON.parse(result);
            
            if(json.state == "Y"){
            }else{
              alert("현재 비밀번호가 틀렸습니다.");
              $("#cpw").val("");
              $("#cpw").focus();
              return false;
            }
          }
        })
      })
      $("#upw").on("input",function(){
        let upw = $("#upw").val();
        let urpw = $("#urepw").val();
        
        if(upw != urpw){
          $(".error_pw").html("비밀번호가 일치하지 않습니다.");
          $("input[name=pwjud]").val(1);
          return false;
        }else if( (urepw.length < 6 && urepw.length > 0) || (upw.length < 6 && upw.length > 0) ){
          $(".error_pw").html("최소 6글자 이상으로 입력 해 주세요.");
          $("input[name=pwjud]").val(1);
          return false;
        }else{
          $(".error_pw").html("");
          $("input[name=pwjud]").val("");
        }
      })

      $("#urepw").on("input",function(){
        let upw = $("#upw").val();
        let urpw = $("#urepw").val();
        
        if(upw != urpw){
          $(".error_pw").html("비밀번호가 일치하지 않습니다.");
          $("input[name=pwjud]").val(1);
          return false;
        }else if(urepw.length < 6 || upw.length < 6){
          $(".error_pw").html("최소 6글자 이상으로 입력 해 주세요.");
          $("input[name=pwjud]").val(1);
          return false;
        }else{
          $(".error_pw").html("");
          $("input[name=pwjud]").val("");
        }
      })

    })  
  </script>