<?
   include "../lib/seto.php";
   var_dump(passwordGenerator());
?>

<div style='width:100%;height:80vh;'>
   <div style='width:600px;height:550px;border-left:1px solid #CECECE;border-right:1px solid #CECECE;border-radius:10px;'>
      <div style='width:100%;height:50px;background:#020000;border-top-left-radius:10px;border-top-right-radius:10px;'>
         <img style='width:200px;height:35px;margin-left:10px;margin-top:6px;' src='https://setoworks.cafe24.com/img/seto_logo.png' />
      </div>
      <div style='height:50px;border-bottom:2px solid #020000;margin-left:20px;width:550px;padding-top:35px;padding-bottom:15px;'>
         <p style='font-size:20px;'>요청하신 <span style='color:#020000;font-weight:700;text-decoration:underline;'>임시비밀번호</span>가 발급되었습니다.</p>
      </div>
      <div style='width:580px;margin-left:20px;margin-top:25px;border-bottom:1px solid #999;padding-bottom:20px;'>
         <div style='display:flex;margin-bottom:20px;'>
            <div style='width:150px;'>임시비밀번호 :</div>
            <div style='width:200px;'><span style='color:#E6002D;font-weight:700;'>jd9Ule3@</span></div>
         </div>
         <div style='display:flex;margin-bottom:20px;'>
            <div style='width:150px'>접수 시각 :</div>
            <div style='width:150px'>2023-07-24 10:24:36</div>
         </div>
         <div style='display:flex;'>
            <div style='width:150px'>주의사항 :</div>
            <div style='width:390px;'>
               임시비밀번호 발급은 <span style='color:#E6002D;'>일 3회</span> 발송 가능합니다. 횟수가 초과 되었을 경우, 관리자에게 문의 해 주세요.
            </div>
         </div>
      </div>
      <div style='margin-left:20px;margin-top:20px;padding-top:20px;padding-bottom:40px;'>
         <p style='margin-bottom:10px;'><span style='font-size:10px'>●</span> 임시비밀번호를 포함 해 비밀번호는 암호화 되어 관리자도 알 수 없습니다.<br>비밀번호 관리에 유의 해 주세요.</p>
         <p style=''><span style='font-size:10px'>●</span> 임시비밀번호를 이용해 로그인 하시면 비밀번호 변경 화면이 표시되니 변경 후 사용해 주시길 바랍니다.</p>
      </div>
      <div style='height:70px;width:100%;border-bottom-left-radius:10px;border-bottom-right-radius:10px;background:#020000;text-align:center;padding-top:30px;'>
         <a style='' href='https://setoworks.cafe24.com/admin' target='_blank'><p style='color:#fff;font-weight:700;font-size:24px;text-decoration:underline;'>관리자 로그인 하러가기</p></a>
      </div>
   </div>
</div>