/*

  공통적으로 사용되는 함수

*/

// 이미지 업로드시 파일 업로드 없이 바로 미리보기
function setThumbnail(event,did) {
  let file = event.target.files[0];
  
  if(chkFileType(file,2)){
    var reader = new FileReader();
  
      reader.onload = function(e) {
        // $('#'+did).html("");
        $('#'+did).css({"background": "url('"+e.target.result+"') 50% 50%"});
        $('#'+did).css({'background-repeat': 'no-repeat'});
        $('#'+did).css({'background-size': 'contain'});
      };
  
      reader.readAsDataURL(file);
  }else{
    alert("이미지 파일만 업로드 가능합니다.");
    return false;
  }
}

function errorAlert(){
  alert("시스템 오류입니다.\n반복 될 경우 고객센터로 문의 주세요.");
}

function chkSpaceFe(obj){
  let id = obj.id;
  let val = obj.value;
  val = val.replace(/(^\s+)|(\s*$)/gi,"");

  $("#"+id).val(val);
}

function pageBack(){
  history.go(-1);
}



function chkEmailType(email) {
  console.log(email);
  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  return re.test(email);
}

function onlyNum(obj){
  let val1;
  val1 = obj.value;
  val1 = val1.replace(/[^0-9]/g,"");
  obj.value = val1;
}









/*
  관리자 사용 함수
*/
function chkAccount(){
  let id = $("#uid").val();
  let pw = $("#upw").val();
  
  if(!id){
    alert("ID를 입력 해 주세요.");
    $("#uid").focus();
    return false;
  }
  if(!pw){
    alert("패스워드를 입력 해 주세요.");
    $("#upw").focus();
    return false;
  }
  
  
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    async: false,
    data: {"w_mode":"chkAccount","id":id,"pw":pw},
    success: function(result){
      let json = JSON.parse(result);
      
      if(json.state == "Y"){
        location.href = "main.php";    
      }else if(json.state == "N"){
        alert("등록된 계정이 아닙니다.");
        $("#uid").focus();
      }else{
        alert("계정정보를 확인 해 주세요");
        $("#uid").focus();
      }
    }
  })
}
function regAccount(){
  let id = $("#uid").val();
  let pw = $('#upw').val();
  let repw = $('#urepw').val();
  let name = $('#uname').val();
  let ijud = $("input[name=idjud]").val();
  let pjud = $("input[name=pwjud]").val();
  let rt = $("input[name=reg_type]").val();
  let rt_txt;
  if(rt == "I"){
    rt_txt = "등록";
  }else{
    rt_txt = "수정";
  }
  
  if(!id){
    alert("ID를 입력 해 주세요");
    $("#uid").focus();
    return false;
  }
  
  // if( rt == "E" ){
  //   if(!pw || !repw){
  //     alert("비밀번호를 입력 해 주세요");
  //     $("#upw").focus();
  //     return false;
  //   }
  // }
  
  
  
  if(!name){
    alert("이름을 입력 해 주세요");
    $("#uname").focus();
    return false;
  }
  
  if(ijud == 1){
    alert("ID를 확인 해 주세요.");
    $("#uid").focus();
    return false;
  }
  if(pjud == 1){
    alert("비밀번호를 확인 해 주세요.");
    $("#upw").focus();
    return false;
  }
  
  if( confirm(rt_txt+" 하시겠습니까?") ){
    let f = new FormData($("#regForm")[0]);
    f.append("w_mode","regAccount");
    
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      processData: false,
      contentType: false,
      data: f,
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        if(json.state=="Y"){
          alert("정상 "+rt_txt+" 되었습니다");
          pageBack();
        }else{
          errorAlert();
        }
      }
    })
  }
}
function goReg(){
  location.href="./accountReg.php";
}
function goDetail(idx){
  $("form").attr("action","accountReg.php");
  $("input[name=reg_type").val("E");
  $("form").prepend("<input type='hidden' name='admin_idx' value='"+idx+"'>");
  $("form").submit();
}
function delAdmin(idx){
  if( confirm("해당 계정을 삭제 하시겠습니까?") ){
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: {"w_mode":"delAdmin","idx":idx}
    }).done(function(result){
      let json = JSON.parse(result);
      
      if(json.state == "Y"){
        alert("삭제 되었습니다.");
        history.go(0);
      }else{
        erroeAlert();
      }
    })
  }
}
function chgPw(){
  let pjud = $("input[name=pwjud]").val();
  
  if(!$("#cpw").val()){
    alert("현재 비밀번호를 입력 해 주세요.");
    $("#cpw").focus();
    return false;
  }
  if(!$("#upw").val() || !$("#urepw").val()){
    alert("새 비밀번호를 입력 해 주세요.");
    $("#upw").focus();
    return false;
  }
  
  if(pjud == 1){
    alert("비밀번호를 확인 해 주세요.");
    $("#upw").focus();
    return false;
  }
  
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"chgPw","pw":$("#upw").val()},
    success: function(result){
      let json = JSON.parse(result);
      
      if(json.state == "Y"){
        location.href="main.php";
      }else{
        errorAlert();
      }
    }
  })
  
}

function logOut(){
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"logOut"},
    success: function(result){
      let json = JSON.parse(result);
      if(json.state == "Y"){
        location.href="./";
      }
    }
  })
}



