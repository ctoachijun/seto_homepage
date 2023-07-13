<?
  include "../lib/seto.php";
  include "../lib/directsend.php";
  
  $arr_name = array("장현준","김현준","최현준");
  $arr_addr = array("ctoachijun@naver.com","timeoftheoath@daum.net","ctoachijun@gmail.com");
  
  
  
  //받는사람, 받는사람주소를 배열로 만들어서 아래 함수로 던지면
  //정상적으로 발송 됨.
  //템플릿 만들어서 번호만 넣으면..알아서 그렇게 간다.
  //단,템플릿은 내용이....변경되려나???
  
  //메일 발송 호출은 분당 300을 넘어서는 안된다.
  
  // $arr_name = "개발자";
  // $arr_addr = "jhj@setoworks.com";
  // $subject = "테스트 메일입니다.";
  
  // sendMail($arr_name,$arr_addr);
  
  $today = date('Y.m.d');
  $title1 = '벌써 목요일이라니!!!';
  $cont1 = '직장인들이 가장 힘들어한다는 목요일이 다가왔습니다.<br>
  월요병의 월요일이 가장 힘들것으로 예상되었지만 의외로 목요일이 1등을 차지했는데요<br>
  그 이유를 세토웍스의 수장이 직접 밝혀 화제입니다.<br><br>
  CEO : 월요일은 월요병이라는 존재가 있어서 어떻게든 탓을하며 버틸수가 있지만<br>
  목요일은 그런게 없어요.<br>
  일주일의 반인 수요일이 지나가면서 체력도 의욕도 꺾이고 급속도로 하락하는데<br>
  목요일이 가장 심한 날이죠.<br>
  정신적으로는.. 내일이 금요일이다! 라는것보다 내일 금요일이 남아있어..라는 부정적인<br>
  생각을 가지게 되는것이 가장 크지 않을까 생각합니다.<br><br>
  여기에 있어서는 많은 의견들이 있습니다. 여러분의 생각은 어떠신가요?<br>
  남은 일주일의 의욕을 불태우기 위해서 세토웍스에 한번 와보시는건 어떨까요??
  ';
  $title2 = '내일이 금요일이라니!!!!';
  $cont2 = '그렇습니다. 내일이 금요일입니다<br>
  신나는 주말까지는 아직 하루가 남았습니다.<br>
  하지만 주말이 된들..눈 깜빡하면 월요일이죠.<br>
  그런의미에서 우리의 기분을 대변해 줄<br> 
  노래하나 보시고(?) 세토웍스에서 활기를 한번 얻어 가 보실까요??
  ';
  $yt = "";
  
  

  
  
// $res = sendMail("개발자","ctoachijun@naver.com","테스트입니당",$content);
// var_dump($res);
  
  
  
  
  $rnames = implode("|",$arr_name);
  $remails = implode("|",$arr_addr);
  
  
?>

<form id="mailcol">
<input type="hidden" name="today" value="<?=$today?>" />
<input type="hidden" name="title1" value="<?=$title1?>" />
<input type="hidden" name="title2" value="<?=$title2?>" />
<input type="hidden" name="cont1" value="<?=$cont1?>" />
<input type="hidden" name="cont2" value="<?=$cont2?>" />

<input type="hidden" name="arr_names" value="<?=$rnames?>" />
<input type="hidden" name="arr_emails" value="<?=$remails?>" />
<input type="hidden" name="content" />
</form>


<input type="button" id="sendmail" value="내용확인" onclick="viewmail()" />
<input type="button" id="sendmail" value="메일발송" onclick="sendmail()" />

<div class="view_div"></div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
  function viewmail(){
    let today = $("input[name=today]").val();
    let title1 = $("input[name=title1]").val();
    let title2 = $("input[name=title2]").val();
    let cont1 = $("input[name=cont1]").val();
    let cont2 = $("input[name=cont2]").val();
    
    let f = new FormData($("#mailcol")[0]);
    f.append("w_mode","viewmail");
    
    $.ajax({
      url : "../admin/ajax_admin.php",
      type: "post",
      data: f,
      processData: false,
      contentType: false,
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        $(".view_div").html(json.html);
        $("input[name=content").val(json.html);
        
      }
    })    
  }  


  function sendmail(){
    if( confirm("메일 보냅니다.") ){
      let f = new FormData($("#mailcol")[0]);
      f.append("w_mode","sendmail");
      
      $.ajax({
        url : "../admin/ajax_admin.php",
        type: "post",
        data: f,
        processData: false,
        contentType: false,
        success: function(result){
          console.log(result);
          let json = JSON.parse(result);
          console.log(json);
          console.log("state : "+json.status);
          console.log("msg : "+json.msg);
        }
      })    
    }
    
  }

</script>

