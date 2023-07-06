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






