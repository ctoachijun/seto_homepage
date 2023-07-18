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
      <div class="page_title">
        <div>계정 정보 <?=$rtxt?></div>
      </div>
      <form method="post" id="regForm" >
          <input type='hidden' name='idjud' />
          <input type='hidden' name='pwjud' />
          <input type='hidden' name='reg_type' value="<?=$reg_type?>" />
          <div class="row">
            <div><label for="uid">ID</label><span class="pil">*</span><span class="error error_id"></span></div>
            <div>
              <input type="text" class="txt-input <?=$editver?>" name="uid" id="uid" placeholder="회사 이메일" value="<?=$uid?>" />
            </div>
          </div>
          <div class="row">
            <div><label for="upw">PW</label><span class="pil">*</span><span class="error error_pw"></span></div>
            <? if($reg_type == "E") : ?>
            <div>
              <input type="password" class="txt-input" name="upw" id="upw" placeholder="" autocomplete="new-password" />
            </div>
            <div><label for="urepw">RE PW</label><span class="pil">*</span></div>
            <div>
              <input type="password" class="txt-input" name="urepw" id="urepw" placeholder="" autocomplete="new-password" />
            </div>
            <? else: ?>
              <span class='pw_txt'>초기 비밀번호는 고정 세팅입니다 : 12341234</span>
            <? endif; ?>
          </div>
          <div class="row">
            <div>
              <label for="name">이름</label><span class="pil">*</span>
              <input type="text" class="txt-input" name="name" id="uname" placeholder="이름을 입력 해 주세요." value="<?=$name?>" />
            </div>
          </div>
          <div class="row">
            <div>
              <label for="tel">연락처</label>
              <input type="text" class="txt-input" name="tel" id="tel" placeholder="연락처를 입력 해 주세요." maxlength="11" value="<?=$tel?>" />
            </div>
          </div>
          <div class="row posi">
            <div class="wv-2">
              <div><label for="part">부서</label></div>
              <div><input type="text" class="txt-input" name="part" id="part" placeholder="부서를 입력 해 주세요." value="<?=$part?>" /></div>
            </div>
            <div class="wv-2">
              <div><label for="title">직함</label></div>
              <div><input type="text" class="txt-input" name="title" id="title" placeholder="직함 입력 해 주세요." value="<?=$title?>" /></div>
            </div>
          </div>
          <div class="row rad_row d-flex">
            <div class="d-flex">
              <label for="ilban"><img src="../img/user.png" /></label>
              <input type='radio' name="grade" value="N" id="ilban" <?=$grade1_chk?> />
              <span>일반 계정</span>
            </div>
            <div class="d-flex">
              <label for="guanri"><img src="../img/admin.png" /></label>
              <input type='radio' name="grade" value="A" id="guanri" <?=$grade2_chk?> />
              <span>관리 계정</span>
            </div>
          </div>

          <div class="row btn_row d-flex">
            <div class="btn_div d-flex">
              <input type="button" class="btn btn-ok" value="<?=$rtxt?>" onclick="regAccount()" />
              <input type="button" class="btn" value="취소" onclick="pageBack()" />
            </div>
            <? if($reg_type == "E"){ ?><input type="button" class="btn btn-no" value="삭제" onclick="delAdmin(<?=$admin_idx?>)" /><? } ?>
          </div>
        </div>
    </form>

  </div>
  
  <? include "footer.php"; ?>
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
  

