<?php

function sendMail($rnames,$raddrs,$subject,$content){   // sendMail(array,array,text,html)
  
 /**
 * 치환 메일 발송
 */

/* 예약 API 사용시 여기서부터 삭제후 이용 하시기 바랍니다. */
$ch = curl_init();

/*
 * subject  : 받을 mail 제목, 치환 문자열 사용 가능.
 *   치환 문자열 : [$NAME] - 이름 (한글 10글자/영문 30byte 처리), [$EMAIL] - 이메일, [$MOBILE] - 휴대폰,
 *     [$NOTE1] - 비고1 (한글/영문 128자 처리), [$NOTE2] - 비고2 (한글/영문 128자 처리), [$NOTE3] - 비고3 (한글/영문 128자 처리), [$NOTE4] - 비고4 (한글/영문 128자 처리), [$NOTE5] - 비고5 (한글/영문 128자 처리)
 *   템플릿 사용시 템플릿에 입력된 메일 제목이 우선적으로 적용됩니다. 빌더로 템플릿을 저장할 경우 메일 제목은 저장되지 않으므로 subject값을 입력해주시기 바랍니다.
 * body  : 받을 mail 본문, 치환 문자열 사용 가능.
 *   치환 문자열 : [$NAME] - 이름 (한글 10글자/영문 30byte 처리), [$EMAIL] - 이메일, [$MOBILE] - 휴대폰,
 *     [$NOTE1] - 비고1 (한글/영문 128자 처리), [$NOTE2] - 비고2 (한글/영문 128자 처리), [$NOTE3] - 비고3 (한글/영문 128자 처리), [$NOTE4] - 비고4 (한글/영문 128자 처리), [$NOTE5] - 비고5 (한글/영문 128자 처리)
 * template : 사이트에 등록한 발송 할 템플릿 번호
 * sender : 발송자 메일주소
 * sender_name : 발송자 이름 (35자 제한)
 * username : directsend 발급 ID
 * receiver : 발송 할 고객 수신자 정보
 *   json array. ex)
 *      [
 *          {"name": "강길동", "email":"test1@directsend.co.kr", "mobile":"", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}
 *          , {"name": "홍길동", "email":"test2@directsend.co.kr", "mobile":"수신자번호", "note1":"다이렉트 센드 2", "note2":"다이렉트센드 2", "note3":"다이렉트센드 3", "note4":"다이렉트센드 4", "note5":"다이렉트센드 5"}
 *      ]
 * address_books : 사이트에 등록한 발송 할 주소록 번호 , 로 구분함 (ex. 0,1,2)
 * duplicate_yn : 수신자 정보가 중복될 경우 중복발송을 할지에 대한 여부
 * key : directsend 발급 api key
 *
 * 각 내용이 유효하지않을 경우에는 발송이 되지 않습니다.
 * 비고 내용이 최대 길이(한글/영문 128자 처리)를 넘는 경우 최대 길이 만큼 잘려서 치환 됩니다.
 * 상업성 광고 메일이나 업체 홍보 메일을 발송하는 경우, 제목에 (광고) 문구를 표기해야 합니다.
 * 영리광고 발송 시, 명시적인 사전 동의를 받은 이에게만 광고 메일 발송이 가능합니다.
 * 수신동의 여부에 대한 분쟁이 발생하는 경우 이에 대한 입증책임은 광고성 정보 전송자에게 있습니다.
 * 수신자가 수신거부 또는 수신동의 철회 의사를 쉽게 표시할 수 있는 안내문을 명시해야 합니다.
 * 스팸 메일 발송 용도로 악용하실 경우 이용에 제한이 있을 수 있으니 이용 시 주의 부탁 드립니다.
 * 불법 스팸 메일 발송 시 예고없이 서비스 이용이 정지될 수 있으며 이용정지 시 해당 아이디의 주소록과 잔액은 소멸되며, 환불되지 않으니 서비스 이용에 주의를 부탁드립니다.
 *
 * API 연동 발송시 다량의 주소를 한번에 입력하여도 수신자에게는 1:1로 보내는 것으로 표기되며, 동일한 내용의 메일을 한건씩 발송하는 것보다 다량으로 한번에 보내는 것이 발송 효율이 더 높습니다.
 * 동일한 내용의 메일을 일부 글자만 변경하여 다수에게 발송하시는 경우 수신자 정보를 Json Array [{...}, {...}]로 구분하시어 한번에 발송하시는 것을 권장 드립니다.
 */

/* 여기서부터 수정해주시기 바랍니다. */
// $subject = '[$NAME]님 환영합니다. ';   //필수입력(템플릿 사용시 17 line 설명 참조)
// $body = '[$NAME]님 환영합니다. 치환 문자 입니다. 수신 이메일 : [$EMAIL] 수신번호 : [$MOBILE] 비고1 : [$NOTE1] 비고2 : [$NOTE2] 비고3 : [$NOTE3] 비고4 : [$NOTE4] 비고5 : [$NOTE5]';     //필수입력, 템플릿 사용시 빈값을 입력 하시기 바랍니다. 예시) $body = '';
$body = $content;
// $body = "바디테스트";
$sender = "support@setoworks.com";          //필수입력
$sender_name = "세토웍스 고객센터";
$username = "setoworks";                //필수입력
$key = "5uYGutBrtLVcNbx";           //필수입력

//수신자 정보 추가 - 필수 입력(주소록 미사용시), 치환문자 미사용시 치환문자 데이터를 입력하지 않고 사용할수 있습니다.
//치환문자 미사용시 {"email":"aaaa@directsend.co.kr"} 이메일만 입력 해주시기 바랍니다.
// $receiver = '{"name":"강길동", "email":"수신자이메일", "mobile":"", "note1":"", "note2":"", "note3":"", "note4":"", "note5":""}'
//     .',{"name":"홍길동", "email":"수신자이메일", "mobile":"수신자번호", "note1":"다이렉트센드 1", "note2":"다이렉트센드 2", "note3":"다이렉트센드 3", "note4":"다이렉트센드 4", "note5":"다이렉트센드 5"}'
// ;

// if(count($raddrs) == 1){
//   $receiver .= '{"name":"'.$rnames[0].'", "email":"'.$raddrs[0].'"}';
// }else{
  for($i=0; $i<count($raddrs); $i++){
    $receiver .= '{"name":"'.$rnames[$i].'", "email":"'.$raddrs[$i].'"}';
    if($i < count($raddrs)-1){
      $receiver .= ",";
    }
  }
// }
$receiver = '['.$receiver.']';      //JSON 데이터

// var_dump($receiver);

//템플릿을 사용하길 원하실 경우 아래 주석을 해제하신후, 사이트에 등록한 템플릿 번호를 입력해주시기 바랍니다.
// $template = 4;        //발송 할 템플릿 번호

// 주소록을 사용하길 원하실 경우 아래 주석을 해제하신 후, 사이트에 등록한 주소록 번호를 입력해주시기 바랍니다.
//$address_books = "0,1,2";      //발송 할 주소록 번호 , 로 구분함 (ex. 0, 1, 2)

//수신자 정보가 중복이고 내용이 다를 경우 아래 주석을 해제하시고 발송해주시기 바랍니다.
//$duplicate_yn = 1;

// 실제 발송성공실패 여부를 받기 원하실 경우 아래 주석을 해제하신 후, 사이트에 등록한 URL 번호를 입력해주시기 바랍니다.
$return_url = 1;
//open, click 등의 결과를 받기 원하실 경우 아래 주석을 해제하신 후, 사이트에 등록한 URL 번호를 입력해주시기 바랍니다.
//등록된 도메인이 http://domain 와 같을 경우, http://domain?type=[click | open | reject]&mail_id=[MailID]&email=[Email]&sendtime=[SendTime]&mail_reserve_id=[MailReserveID] 과 같은 형식으로 request를 보내드립니다.
$option_return_url = 0;

$open = 1;	// open 결과를 받으려면 아래 주석을 해제 해주시기 바랍니다.
$click = 1;	// click 결과를 받으려면 아래 주석을 해제 해주시기 바랍니다.
$check_period = 7;	// 트래킹 기간을 지정하며 3 / 7 / 10 / 15 일을 기준으로 지정하여 발송해 주시기 바랍니다. (단, 지정을 하지 않을 경우 결과를 받을 수 없습니다.)


//필수안내문구 추가
$agreement_text = '';
$deny_text = "메일 수신을 원치 않으시면 [" . '$DENY_LINK' . "]를 클릭하세요.\\nIf you don't want this type of information or e-mail, please click the [".'$EN_DENY_LINK'."]";
$sender_info_text = "사업자 등록번호:141-81-31588 소재지:서울시 강남구 삼성로 554 TEL:070-8849-8904\\nEmail: <a href='mailto:support@setoworks.com'>support@setoworks.com</a>";
$logo_state = 1; // logo 사용시 1 / 사용안할 시 0
$logo_path = 'https://setoworks.cafe24.com/img/seto_logo.png';  //사용하실 로고 이미지를 입력하시기 바랍니다.
$logo_sort = 'LEFT';      //로고 정렬 LEFT - 왼쪽 정렬 / CENTER - 가운데 정렬 / RIGHT - 오른쪽 정렬
$footer_sort = 'LEFT';      //메일내용, 풋터(수신옵션) 정렬 LEFT - 왼쪽 정렬 / CENTER - 가운데 정렬 / RIGHT - 오른쪽 정렬

// 첨부파일의 URL을 보내면 DirectSend에서 파일을 download 받아 발송처리를 진행합니다. 첨부파일은 전체 10MB 이하로 발송을 해야 하며, 파일의 구분자는 '|(shift+\)'로 사용하며 5개까지만 첨부가 가능합니다.
// $file_url = 'https://directsend.co.kr/test.png|https://directsend.co.kr/test1.png';
// 첨부파일의 이름을 지정할 수 있도록 합니다.
// 첨부파일의 이름은 순차적(https://directsend.co.kr/test.png - image.png, https://directsend.co.kr/test1.png - image2.png) 와 같이 적용이 되며, file_name을 지정하지 않은 경우 마지막의 파일의 이름으로 메일에 보여집니다.
// $file_name = 'image.png|image2.png';

/* 여기까지 수정해주시기 바랍니다. */

$postvars = '"subject":"'.$subject.'"';
$postvars = $postvars.', "body":"'.$body.'"';
$postvars = $postvars.', "sender":"'.$sender.'"';
$postvars = $postvars.', "sender_name":"'.$sender_name.'"';
$postvars = $postvars.', "username":"'.$username.'"';
$postvars = $postvars.', "receiver":'.$receiver;

// $postvars = $postvars.', "template":"'.$template.'"';                 //템플릿 사용할 경우 주석 해제
//$postvars = $postvars.', "address_books":"'.$address_books.'"';       //주소록 사용할 경우 주석 해제
//$postvars = $postvars.', "duplicate_yn":"'.$duplicate_yn.'"';         //중복 발송을 허용할 경우 주석 해제

// 예약 관련 정보 사용할 경우 주석 해제
//$postvars = $postvars.', "mail_type":"'.$mail_type.'"';
//$postvars = $postvars.', "start_reserve_time":"'.$start_reserve_time.'"';
//$postvars = $postvars.', "end_reserve_time":"'.$end_reserve_time.'"';
//$postvars = $postvars.', "remained_count":"'.$remained_count.'"';

// 필수 안내문구를 추가할 경우 주석 해제
// $postvars = $postvars.', "agreement_text":"'.$agreement_text.'"';
// $postvars = $postvars.', "deny_text":"'.$deny_text.'"';
// $postvars = $postvars.', "sender_info_text":"'.$sender_info_text.'"';
$postvars = $postvars.', "logo_state":"'.$logo_state.'"'; // 이게 없으면 일정 컨텐츠 이하로 숨김처리가 된다.
// $postvars = $postvars.', "logo_path":"'.$logo_path.'"';
// $postvars = $postvars.', "logo_sort":"'.$logo_sort.'"';

// 메일내용, 풋터(수신옵션) 정렬 사용할 경우 주석 해제
$postvars = $postvars.', "footer_sort":"'.$footer_sort.'"';

// 메일 발송결과를 받고 싶은 URL 사용할 경우 주석 해제
// $postvars = $postvars.', "return_url_yn":'.TRUE;       //return_url 사용시 필수 입력
// $postvars = $postvars.', "return_url":"'.$return_url.'"';       //return_url 사용시 필수 입력

// 발송결과 옵션 측정 항목을 사용할 경우 주석 해제
//$postvars = $postvars.', "option_return_url":"'.$option_return_url.'"';
//$postvars = $postvars.', "open":"'.$open.'"';
//$postvars = $postvars.', "click":"'.$click.'"';
//$postvars = $postvars.', "check_period":"'.$check_period.'"';

// 첨부파일이 있는 경우 주석 해제
//$postvars = $postvars.', "file_url":"'.$file_url.'"';
//$postvars = $postvars.', "file_name":"'.$file_name.'"';

$postvars = $postvars.', "key":"'.$key.'"';
$postvars = '{'.$postvars.'}';      //JSON 데이터

// var_dump($postvars);
// URL
$url = "https://directsend.co.kr/index.php/api_v2/mail_change_word";

//헤더정보
$headers = array(
    "cache-control: no-cache",
    "content-type: application/json; charset=utf-8"
);

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);		//JSON 데이터
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
curl_setopt($ch,CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);

/*
  * response의 실패
  * {"status":101, "msg":"UTF-8 인코딩이 아닙니다."}
  * 실패 코드번호, 내용
*/

/*
  * response 성공
  * {"status":0}
  * 성공 코드번호 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
  *
  * 잘못된 이메일 주소가 포함된 경우
  * {"status":0, "msg":"유효하지 않는 이메일을 제외하고 발송 완료 하였습니다.", "msg_detail":"error email : test2@test2, test3@test"}
  * 성공 코드번호 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.), 내용, 잘못된 데이터
  *
*/

/*
    status code
    0   : 정상발송 (성공코드는 다이렉트센드 DB서버에 정상수신됨을 뜻하며 발송성공(실패)의 결과는 발송완료 이후 확인 가능합니다.)
    100 : POST validation 실패
    101 : 회원정보가 일치하지 않음
    102 : Subject, Body 정보가 없습니다.
    103 : Sender 이메일이 유효하지 않습니다.
    104 : receiver 이메일이 유효하지 않습니다.
    105 : 본문에 포함되면 안되는 확장자가 있습니다.
    106 : body validation 실패
    107 : 받는사람이 없습니다.
    108 : 예약정보가 유효하지 않습니다.
    109 : return_url이 없습니다.
    110 : 첨부파일이 없습니다.
    111 : 첨부파일의 개수가 5개를 초과합니다.
    112 : 파일의 총Size가 10 MB를 넘어갑니다.
    113 : 첨부파일이 다운로드 되지 않았습니다.
    114 : utf-8 인코딩 에러 발생
    115 : 템플릿 validation 실패
    200 : 동일 예약시간으로는 200회 이상 API 호출을 할 수 없습니다.
    201 : 분당 300회 이상 API 호출을 할 수 없습니다.
    202 : 발송자명이 최대길이를 초과 하였습니다.
    205 : 잔액부족
    999 : Internal Error.
 */

//curl 에러 확인
if(curl_errno($ch)){
    // echo 'Curl error: ' . curl_error($ch);
    return "Curl error";
}else{
    // print_R($response);
    return $response;
    
}

curl_close ($ch);


}

?>
