/*

  공통적으로 사용되는 함수

*/

// 이미지 업로드시 파일 업로드 없이 바로 미리보기
function setThumbnail(event,did) {
  let file = event.target.files[0];

  if(file){
    if(chkFileType(file,2)){
      var reader = new FileReader();
    
        reader.onload = function(e) {
          // $('#'+did).html("");
          $('.'+did).css({"background": "url('"+e.target.result+"') 50% 50%"});
          $('.'+did).css({'background-repeat': 'no-repeat'});
          $('.'+did).css({'background-size': 'contain'});
        };
    
        reader.readAsDataURL(file);
    }else{
      return false;
    }
  }
}
// 파일 종류 체크
// 1 : 엑셀   2: 이미지
function chkFileType(file,type){
  let whak,csize,msize,whak_box;
  
  whak_box = file.name.split(".");
  whak = whak_box[1];
  csize = file.size / 1024 / 1024;
  
  if(type == 1){
    msize = 20;
    if(whak != "xlsx" && whak != "xls"){
      alert("엑셀 파일만 가능합니다.");
      return false;
    }else if(csize > msize){
      alert("용량은 "+msize+"MB 미만으로 올려주세요");  
      return false;
    }else{
      return true;
    }
  }else if(type == 2){
    msize = 2;
    if($.inArray(whak, ['jpg', 'bmp', 'png', 'jpeg', 'tif', 'gif', 'webp', 'svg']) < 0){  
      alert("이미지 파일만 업로드 가능합니다.");
      return false;
    }else if(csize > msize){
      alert("용량은 "+msize+"MB 미만으로 올려주세요");  
      return false;
    }else{
      return true;
    }
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

function chkStrLength(obj,num){
  if(obj.value.length > num){
    alert(num+"글자까지 가능합니다.");
    obj.value = obj.value.substring(0,num);
  }else{
    $(".chkstr").html(obj.value.length+"/100");
  }
      
}

function chkWall(obj){
  val1 = obj.value;
  val1 = val1.replace(/\|/g,"");
  obj.value = val1;
}

function numberComm(num){
  num = num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
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
        alert("변경했습니다. 재로그인 후 이용 해 주세요.");
        location.href="/admin";
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

// 검색시 페이지는 무조건 1페이지
function chgCurPage(){
  $("input[name=cur_page]").val(1);
  $("input[name=total_cnt]").val("");
  // $("form").submit();
  return true;
}  

function openModal(num){
  $(".backblack").show();
  $("body").css("overflow","hidden");
  if(num == 1){
    $(".modal_answer").show();
  }else if(num == 2){
    $(".modal_mtype").show();
  }else if(num == 3){
    $(".detail_div").show();
  }else{
  }
}

function closeModal(){
  $(".modal").hide();
  $(".backblack").hide();
  $("body").css("overflow","auto");
  
}

function setModal(idx){
  $("input[name=seldata").val(idx);
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"setModal","idx":idx},
    success: function(result){
      let json = JSON.parse(result);
      console.log(json);

      if(json.state == "N"){
        errorAlert();
      }else{
        $(".modal_comp").html(json.comp);
        $(".modal_name").html(json.name);
        $(".modal_tel").html(json.tel);
        $(".modal_email").html(json.email);
        $(".modal_subject").html(json.subject);
        $(".modal_wdate").html(json.wdate);
        $(".modal_content").html(json.content);
        $(".modal_type").html(json.mtype);
        
        if(json.read=="Y"){
          $(".ans_td"+idx).html("<span class='yans'>확인</span>");
        }
      }
      openModal(1);
    }
  })
}

function sortColumn(){
  $("form").submit();
}

function showMtype(){
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"showMtype"},
    success: function(result){
      let json = JSON.parse(result);
      // console.log(json);
      
      $(".mtype_div").html(json.html);
      openModal(2);
    }
  })
}

function setMtype(idx){
  let setv = $(".mt"+idx).html();
  $("#mtype").val(setv);
  $("input[name=aejud]").val("E");
  $("input[name=nowclass]").val("mt"+idx);
  $(".top_div .btn-ok").val("변경");
}

function addMtype(){
  let jud = $("input[name=aejud]").val();
  let value = $("#mtype").val();
  let mttxt = $("input[name=nowclass").val();
  let idx = mttxt.replace(/[^0-9]/g,"");
  let jtxt;

  if(jud == "E"){
    jtxt = "변경";
  }else{
    jtxt = "추가";
    jud = "I";
  }
  
  if( confirm(jtxt+" 하시겠습니까?") ){
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: {"w_mode":"addMtype","idx":idx,"value":value,"jud":jud},
      success: function(result){
        let json = JSON.parse(result);
        // console.log(json);
        
        if(json.state=="Y"){
          alert(jtxt+" 되었습니다.");
          history.go(0);
        }else{
          errorAlert();
        }
      }
    })
  }
}

function delMtype(idx){
  if( confirm("연계 된 문의의 문의 유형이 없어집니다.\n다시 한번 확인 해 주세요.\n삭제 하시겠습니까?") ){
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: {"w_mode":"delMtype","idx":idx},
      success: function(result){
        let json = JSON.parse(result);
        
        if(json.state == "Y"){
          alert("삭제 되었습니다.");
          history.go(0);
        }else{
          errorAlert();
        }
      }
    })
  }
}

function regPortpolio(){
  let rt = $("input[name=reg_type]").val();
  let rt_txt,rt_wmod;
  
  if(rt == "I"){
    if( $("#thumbimg")[0].files.length === 0 ){
      alert("썸네일을 등록 해 주세요.");
      $("#thumbimg").click();
      return false;
    }
  }

  if( !$("#title").val() ){
    alert("제목을 입력 해 주세요.");
    $("#title").focus();
    return false;
  }
  if( $("#country").val() == "N" ){
    alert("국가를 선택 해 주세요.");
    return false;
  }
  if( $("#platform").val() == "N" ){
    alert("플랫폼을 선택 해 주세요.");
    return false;
  }
  if( !$("#amount").val() ){
    alert("펀딩금액을 입력 해 주세요.");
    $("#amount").focus();
    return false;
  }
  if( !$("#rate").val() ){
    alert("달성률을 입력 해 주세요.");
    $("#rate").focus();
    return false;
  }

  if(rt=="E"){
    rt_txt = "수정";
  }else{
    rt_txt = "등록";
  }
  
  if( confirm(rt_txt+"하시겠습니까?") ){
    let f = new FormData($("#regForm")[0]);
    f.append("w_mode","regPortpolio");
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: f,
      processData: false,
      contentType: false,
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        if(json.state == "Y"){
          alert(rt_txt+" 되었습니다.");
          pageBack();
        }else{
          errorAlert();
        }
      }
      
    })
  }
}

function goRegPortp(){
  $("#regForm").attr("action","portpolReg.php");
  $("input[name=reg_type]").val("");
  $("#regForm").submit();
}

function goEditPortp(obj){
  let cname = obj.className;
  console.log(cname);
  let pidx = cname.replace(/[^0-9]/g,"");
  $("input[name=reg_type]").val("E");
  $("#regForm").attr("action","portpolReg.php");
  $("#regForm").prepend("<input type='hidden' name='pidx' value='"+pidx+"'>");
  $("#regForm").submit();
  
}

function delPortpolio(idx){
  if( confirm("삭제 하시겠습니까?") ){
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: {"w_mode":"delPortpolio","idx":idx},
      success: function(result){
        let json = JSON.parse(result);
        
        if(json.state == "N"){
          errorAlert();
        }else{
          alert("삭제 되었습니다.");
          pageBack();
        }
      }
    })
  }
}

function setImgname(num){
  let txt_target,img_id,img;
  if(num == 3){
    txt_target = "mainimg_name";
    img_id = $("#mainimg")[0].files;
  }else{
    txt_target = "img"+num+"_name";
    img_id = $("#img"+num)[0].files;
  }
  
  img = img_id[0].name;
  var ext = img_id[0].name.split('.').pop().toLowerCase(); //확장자분리
  //아래 확장자가 있는지 체크
  if($.inArray(ext, ['jpg','jpeg','gif','png']) == -1) {
  }else{
    $("."+txt_target).html(img_id[0].name);
  }
  console.log(img_id);  
}

function setTemp(num){

  // 템플릿 라벨 클래스 초기화
  $(".templabel").removeClass("selact");
  
  // 이미지 버튼 클래스 초기화
  $(".main_div").removeClass("img_div");
  $(".img1_div").removeClass("img_div");
  $(".img2_div").removeClass("img_div");
  
  if(num == 1){
    $(".seltemp1").addClass("selact");
    $(".img2_div").addClass("img_div");
  }else if(num == 2){
    $(".seltemp2").addClass("selact");
  }else{
    $(".seltemp3").addClass("selact");
  }
  
  console.log("체크값 : "+$("input[name=template]:checked").val());
}

function showTempl(){
  let head = $("#head").val();
  let temp = $("input[type=radio]:checked").val();
  let title1 = $("#title1").val();
  let title2 = $("#title2").val();
  let cont1 = $("#cont1").val();
  let cont2 = $("#cont2").val();
  let mainimg = $("#mainimg").val();
  let img1 = $("#img1").val();
  let img2 = $("#img2").val();

  
  $(".pre_head").html(head);
  $(".pre_title1").html(title1);
  $(".pre_title2").html(title2);
  $(".pre_cont1").html(cont1.replace(/(?:\r\n|\r|\n)/g, "<br />"));
  $(".pre_cont2").html(cont2.replace(/(?:\r\n|\r|\n)/g, "<br />"));
  
  
  $(".backblack").show();
  $("#preview1").hide();
  $("#preview2").hide();
  $("#preview3").hide();
  if(temp == "temp1"){
    $("#preview1").show();
  }else if(temp == "temp2"){
    $("#preview2").show();
  }else{
    $("#preview3").show();
  }
  
}  

function addEmailTarget(){
  let name = $("#name").val();
  let email = $("#email").val();
  let rnames = $("input[name=rnames]").val();
  let remails = $("input[name=remails").val();
  
  if(!name){
    alert("이름을 입력 해 주세요.");
    $("#name").focus();
    return false;
  }
  if(!email){
    alert("이메일 주소를 입력 해 주세요.");
    $("#email").focus();
    return false;
  }
  
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"addEmailTarget","name":name,"email":email,"rnames":rnames,"remails":remails},
    success : function(result){
      let json = JSON.parse(result);
      console.log(json);
      
      $(".target_div").html(json.html);
      $("input[name=rnames]").val(json.rnames);
      $("input[name=remails]").val(json.remails);
      $("#name").val("");
      $("#email").val("");
      $("#name").focus();
      
    }
  })
}

function removeLine(num){
  let rnames = $("input[name=rnames]").val();
  let remails = $("input[name=remails").val();
  
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"delEmailTarget","rnames":rnames,"remails":remails,"num":num},
    success : function(result){
      let json = JSON.parse(result);
      console.log(json);
      
      $(".target_div").html(json.html);
      $("input[name=rnames]").val(json.rnames);
      $("input[name=remails]").val(json.remails);
    }
  })
}

function sendSetoMail(){
  let subject = $("#subject").val();
  let head = $("#head").val();
  let temp = $("input[type=radio]:checked").val();
  let title1 = $("#title1").val();
  let title2 = $("#title2").val();
  let cont1 = $("#cont1").val();
  let cont2 = $("#cont2").val();
  let mainimg = $("#mainimg").val();
  let img1 = $("#img1").val();
  let img2 = $("#img2").val();
  let rnames = $("input[name=rnames]").val();
  let remails = $("input[name=remails").val();

  
  if(!subject){
    alert("제목을 입력 해 주세요");
    $("#subject").focus();
    return false;
  }
  if(!head){
    alert("머릿글을 입력 해 주세요");
    $("#head").focus();
    return false;
  }
  if(!title1){
    alert("타이틀1을 입력 해 주세요");
    $("#title1").focus();
    return false;
  }
  if(!title2){
    alert("타이틀2를 입력 해 주세요");
    $("#title2").focus();
    return false;
  }
  if(!cont1){
    alert("내용1을 입력 해 주세요");
    $("#cont1").focus();
    return false;
  }
  if(!cont2){
    alert("내용2을 입력 해 주세요");
    $("#cont2").focus();
    return false;
  }
  if(!mainimg){
    alert("메인이미지를 등록 해 주세요.");
    $("#mainimg").click();
    return false;
  }
  if(!img1){
    alert("사진1을 등록 해 주세요.");
    $("#img1").click();
    return false;
  }
  if(temp == "temp2" && !img2){
    alert("사진2를 등록 해 주세요.");
    $("#img2").click();
    return false;
  }
  if(temp == "temp3" && !img3){
    alert("사진3를 등록 해 주세요.");
    $("#img3").click();
    return false;
  }
  if(!rnames){
    alert("수신자 이름이 없습니다.");
    $("#name").focus();
    return false;
  }
  if(!remails){
    alert("수신대상 이메일주소가 없습니다.");
    $("#remails").focus();
    return false;
  }
  
  
  if( confirm("내용과 수신대상을 확인 해 주세요.\n메일을 발송 하시겠습니까?") ){
    
    let f = new FormData($("#sendForm")[0]);
    f.append("w_mode","sendSetoMail");
    
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: f,
      processData: false,
      contentType: false,
      success: function(result){
        let json = JSON.parse(result);
        
        if(json.state == "Y"){
          alert("발송했습니다.\n자세한 내역은 다이렉트센드 홈페이지에서 확인 해 주세요.");
          pageBack();
        }else{
          errorAlert();
          history.go(0);
          console.log(json);
        }
      }
    })
  }
}
  
function showMlDetail(idx){
  openModal(3);
  
  $.ajax({
    url : "ajax_admin.php",
    type: "post",
    data: {"w_mode":"showMlDetail","idx":idx},
    success: function(result){
      let json = JSON.parse(result);
      console.log(json);
      
      $(".temp_wdate").html(json.sdate);
      $(".detail_temp_num").html(json.temp_num);
      $(".detail_receiv").html(json.receiv);
      $(".detail_receiv_mail").html(json.receiv_mail);
      $(".detail_result").html(json.result);
      $(".detail_code").html(json.code);
      $(".detail_etc").html(json.etc);
      $(".detail_count").html(json.count);
      $(".detail_show").html(json.show);
      
    }
  })
}

function goSend(){
  $("form").attr("action","mailSend.php");
  $("form").submit();
}

function listUp(){
  $("#list").click();
}

function setList(obj){
  let file = obj.files[0];
  if(chkFileType(file,1)){
    
    let f = new FormData($("#sendForm")[0]);
    f.append("w_mode","setList");
    
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: f,
      processData: false,
      contentType: false,
      success : function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        $("input[name=rnames").val(json.arr_name);
        $("input[name=remails").val(json.arr_email);
        $(".target_div").html(json.html);
      }
    })

  }
}

function accpageMove(num){
  if(num == 1){
    location.href="accountList.php";
  }else{
    location.href="adminLog.php";
  }
}

function setTargetAdd(num){
  if(num == 1){
    $(".one").addClass("sendact");
    $(".all").removeClass("sendact");
    $(".one_up_div").css("display","flex");
    $(".all_up_div").hide();
  }else{
    $(".one").removeClass("sendact");
    $(".all").addClass("sendact");
    // $(".all_up_div").css("display","flex");
    $(".all_up_div").show();
    $(".one_up_div").hide();
  }
}

function setHpView(num){
  if(num == 1){
    $(".hpy").addClass("hpact");
    $(".hpn").removeClass("hpact");
  }else{
    $(".hpy").removeClass("hpact");
    $(".hpn").addClass("hpact");
  }
  console.log( $("input[name=open]:checked").val() );
}

function setCardData(num,obj){
  let val; 
  
  if(num == 1){
    $(".cont_right .title").html(obj.value);
  }else if(num == 2){
    $(".cont_right .subt").html(obj.value);
  }else if(num == 3){
    if(obj.value != "N"){
      $(".cont_right .country").html(obj.value);
    }else{
      $(".cont_right .country").html("");
    }
  }else if(num == 4){
    if(obj.value != "N"){
      $(".cont_right .platf").html("<img src='../img/"+obj.value+".png'>");
    }else{
      $(".cont_right .platf").html("");
    }
  }else if(num == 5){
    let cur =  $("#currency").val();
    val = numberComm(obj.value);
    $(".cont_right .amount").html(cur+" "+val);
  }else if(num == 6){
    val = numberComm(obj.value);
    $(".cont_right .rate").html(val+" %");
  }else if(num == 7){
    $(".cont_right .subt").html(obj.value);
  }
}

function sendTempPw(){
  let id = $("#uid").val();
  console.log(id);
  if(!id || id == ""){
    alert("ID를 입력 해 주세요.");
    $("#uid").focus();
    return false;
  }
  
  if( confirm("임시 비밀번호를 발송 하시겠습니까?")){
    $.ajax({
      url : "ajax_admin.php",
      type: "post",
      data: {"w_mode":"sendTempPw","id":id},
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        if(json.state == "IN"){
          alert("등록 된 ID가 아닙니다.");
          $("#uid").focus();
          return false;
        }else if(json.state == "O"){
          alert("인증횟수 초과입니다. 관리자에게 문의주세요.");
          return false;          
        }else if(json.state == "N"){
          errorAlert();
        }else{
          alert("발송되었습니다.");
          location.href="/admin";
        }
        
      }
    })
  }
  
  
}



