<?
include "header.php";

// 수퍼관리자만 접속할수 있는 페이지에 넣을 처리
if(!chkTopAdmin($aidx)){
  alert_back("접근 권한이 없습니다.");
  exit;
}

if(!$reg_type) $reg_type = "I";
$grade1_chk = "checked";
$grade2_chk = "";
$reg_type == "E" ? $rtxt = "수정": $rtxt = "등록";


if($reg_type == "E"){
  $admin = getAdminInfo($admin_idx);
  $uid = $admin['a_id'];
  $name = $admin['a_name'];
  $tel = $admin['a_tel'];
  $part = $admin['a_part'];
  $title = $admin['a_title'];
  $grade = $admin['a_grade'];
  
  if($grade == "N"){
    $grade1_chk = "checked";
    $grade2_chk = "";
  }else{
    $grade1_chk = "";
    $grade2_chk = "checked";
  }
  
  $editver = "readonly";
}


?>



  <div id="accountReg">
    <div class="content">
      <form method="post" id="regForm" >
          <input type='hidden' name='idjud' />
          <input type='hidden' name='pwjud' />
          <input type='hidden' name='reg_type' value="<?=$reg_type?>" />
          <div class="row">
            <label for="uid">ID : </label>
            <span class="error error_id"></span>
            <input type="text" class="txt-input <?=$editver?>" name="uid" id="uid" placeholder="회사 이메일" value="<?=$uid?>" />
          </div>
          <div class="row">
          <? if($reg_type == "E") : ?>
            <label for="upw">PW : </label>
            <span class="error error_pw"></span>
            <input type="password" class="txt-input" name="upw" id="upw" placeholder="" autocomplete="new-password" />
            <label for="urepw">RE PW : </label>
            <input type="password" class="txt-input" name="urepw" id="urepw" placeholder="" autocomplete="new-password" />
            <? else: ?>
              <span class='pw_txt'>비밀번호는 초기 세팅입니다 : 12341234</span>
            <? endif; ?>
          </div>
          <div class="row">
            <label for="name">이름 : </label>
            <input type="text" class="txt-input" name="name" id="uname" placeholder="이름을 입력 해 주세요." value="<?=$name?>" />
            <label for="tel">연락처 : </label>
            <input type="text" class="txt-input" name="tel" id="tel" placeholder="연락처를 입력 해 주세요." maxlength="11" value="<?=$tel?>" />

          </div>
          <div class="row">
            <label for="part"> 부서 : </label>
            <input type="text" class="txt-input" name="part" id="part" placeholder="부서를 입력 해 주세요." value="<?=$part?>" />
            <label for="title"> 직함 : </label>
            <input type="text" class="txt-input" name="title" id="title" placeholder="직함 입력 해 주세요." value="<?=$title?>" />
          </div>
          <div class="row">
            <input type='radio' name="grade" value="N" id="ilban" <?=$grade1_chk?> />
            <label for="ilban"> 일반 </label>
            <input type='radio' name="grade" value="A" id="guanri" <?=$grade2_chk?> />
            <label for="guanri"> 관리자 </label>
          </div>

          <div class="row">
            
            <? if($reg_type == "E"){ ?><input type="button" class="btn btn-no" value="삭제" onclick="delAdmin(<?=$admin_idx?>)" /><? } ?>
            <input type="button" class="btn btn-ok" value="<?=$rtxt?>" onclick="regAccount()" />
            <input type="button" class="btn" value="취소" onclick="pageBack()" />
          </div>
        </div>
    </form>

  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
  <script>
    $(function(){
      
      $("#uid").on("input",function(){
        console.log(this.value);
        if(!chkEmailType(this.value)){
          $(".error_id").html("올바른 이메일 주소가 아닙니다.");
          $("input[name=idjud").val(1);
          return false;
        }else{
          $(".error_id").html("");
          $("input[name=idjud").val("");
        }
      })
      
      $("#uid").change(function(){
        $.ajax({
          url : "ajax_admin.php",
          type: "post",
          data: {"w_mode":"chkEmail","email":this.value},
          success: function(result){
            let json = JSON.parse(result);
            
            if(json.state == "N"){
              alert("이미 등록 된 이메일입니다.");
              $("#uid").val("");
              $("#uid").focus();
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
      
      $("#tel").on("input",function(){
        onlyNum(this);
      });
      
      $("")

    })  
  </script>
  
  


</body>

</html>