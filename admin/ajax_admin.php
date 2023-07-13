<?
  include "../lib/seto.php";

  $aidx = $_SESSION['aidx'];
  $aid = $_SESSION['aid'];
  $aname = $_SESSION['aname'];
  
  switch($w_mode){
    
    case "chkAccount":
      $sql = "SELECT * FROM sthp_admin WHERE a_id = '{$id}'";
      $re = sql_fetch($sql);
      
      if($re){
        $db_pw = $re['a_passwd'];
        if(password_verify($pw,$db_pw)){
          $output['state'] = "Y";
          
          $_SESSION['aidx'] = $re['a_idx'];
          $_SESSION['aid'] = $re['a_id'];
          $_SESSION['aname'] = $re['a_name'];
          
          // 로그인 일시 입력처리
          $sql1 = "UPDATE sthp_admin SET a_login = now() WHERE a_idx = ".$re['a_idx'];
          $re1 = sql_exec($sql1);
          // 중복이라도 로그 체크
          $exec = "관리자 로그인";
          getLog($sql1,$exec,$re['a_name']);
          
          
        }else{
          $output['state'] = "W";
        }
      }else{
        $output['state'] = "N";
      }

      echo json_encode($output);
    break;
    
    case "chkEmail":
      $sql = "SELECT * FROM sthp_admin WHERE a_id = '{$email}'";
      $re = sql_num_rows($sql);
      
      $output['re'] = $re;
      if($re){
        $output['state'] = "N";
      }else{
        $output['state'] = "Y";
      }
      
      echo json_encode($output);
    break;
    
    case "regAccount" :
      $name = addslashes($name);
      $part = addslashes($part);
      $title = addslashes($title);

      if($reg_type == "I"){
        if(!$upw) $upw = "12341234";
        $passwd = password_hash($upw,PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO sthp_admin SET a_id = '{$uid}', a_passwd = '{$passwd}', a_name = '{$name}', a_tel = '{$tel}', 
                a_part = '{$part}', a_title = '{$title}', a_grade = '{$grade}', a_wdate = now()";
      }else{
        if(!empty($upw)){
          $passwd = password_hash($upw,PASSWORD_DEFAULT);
          $output['upw'] = $upw;
          $output['passwd'] = $passwd;
          $pw_col = "a_passwd = '{$passwd }', a_first = 'Y', ";
        }else{
          $pw_col = "";
        }

          $sql = "UPDATE sthp_admin SET {$pw_col} a_name = '{$name}', a_tel = '{$tel}', 
          a_part = '{$part}', a_title = '{$title}', a_grade = '{$grade}' WHERE a_id = '{$uid}'";
      }
      $re = sql_exec($sql);
      
      $output['sql'] = $sql;
      if($re){
        $output['state'] = "Y";
        
        //로그
        $reg_type == "I" ? $ratype = 1 : $ratype = 2;
        $ratype == 1 ? $type_txt = "추가" : $type_txt = "수정";
        $exec = "관리자 계정 [ {$name} ] {$type_txt}";
        $res = getLog($sql,$exec,$aname);
        $output['res'] = $res;
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "delAdmin" :
      $admin = getAdminInfo($idx);
      $name = $admin['a_name'];
      
      $sql = "DELETE FROM sthp_admin WHERE a_idx = {$idx}";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        // 로그
        $exec = "관리자 계정 [ {$name} ] 삭제";
        getLog($sql,$exec,$aname);
        
      }else{
        $output['state'] = "N";
      }
      echo json_encode($output);
    break;
  
    case "chkPw" :
      $sql = "SELECT * FROM sthp_admin WHERE a_idx = {$aidx}";
      $re = sql_fetch($sql);
      $output['sql'] = $sql;
      if($re){
        $db_pw = $re['a_passwd'];
        if(password_verify($cpw,$db_pw)){
          $output['state'] = "Y";
        }else{
          $output['state'] = "N";
        }
      }else{
        $output['state'] = "CN";
      }

      echo json_encode($output);
    break;
    
    case "chgPw":
      $passwd = password_hash($pw,PASSWORD_DEFAULT);
      $sql = "UPDATE sthp_admin SET a_passwd = '{$passwd}', a_first = 'N' WHERE a_idx = {$aidx}";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "첫 접속 비밀번호 변경";
        getLog($sql,$exec,$aname);
        
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);
    break;
    
    case "logOut" :
      
      //로그
      $exec = "[ {$aname} ] 로그아웃";
      getLog("버튼 클릭으로 로그아웃",$exec,$aname);
      
      session_destroy();
      $output['state'] = "Y";
      
      echo json_encode($output);
    break;
    
    case "setModal" :
      $sql = "UPDATE sthp_inquiry SET i_read = 'Y' WHERE i_idx = {$idx}";
      $re = sql_exec($sql);
      
      if($re){
        $mooni = getMooniInfo($idx);
        
        $output['comp'] = $mooni['i_company'];
        $output['name'] = $mooni['i_name'];
        $output['tel'] = $mooni['i_tel'];
        $output['email'] = $mooni['i_email'];
        $output['wdate'] = $mooni['i_wdate'];
        $output['subject'] = $mooni['i_subject'];
        $output['content'] = $mooni['i_content'];
        $output['read'] = $mooni['i_read'];
        $output['mtype'] = $mooni['it_type'];
        
        //로그
        $exec = $mooni['i_company']." (".$output['name'] = $mooni['i_name'].") 문의 확인";
        getLog($sql,$exec,$aname);
        
        $output['state'] = "Y";
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    

    case "showMtype" :
      $box = getMooniTypeList();
      foreach($box as $v){
        $idx = $v['it_idx'];
        $type = $v['it_type'];
        $html .= "
          <div class='mtype_row mtr{$idx}'>
            <span class='mtype mt{$idx}' onclick='setMtype({$idx})'>{$type}</span><span class='mticon' onclick='delMtype({$idx})' >X</span>
          </div>
        ";
      }
      $output['html'] = $html;
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "addMtype" :
      
      if($jud == "E"){
        $sql = "UPDATE sthp_inquiry_type SET it_type = '{$value}' WHERE it_idx = {$idx}";
        $jud_txt = "수정";
      }else{
        $sql = "INSERT INTO sthp_inquiry_type SET it_type = '{$value}'";
        $jud_txt = "등록";
      }
      
      $re = sql_exec($sql);
      $output['sql'] = $sql;
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "문의 유형 {$jud_txt}";
        getLog($sql,$exec,$aname);
        
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);  
    break;
    
    case "delMtype" :
      $sql = "DELETE FROM sthp_inquiry_type WHERE it_idx = {$idx}";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "문의 유형 삭제";
        getLog($sql,$exec,$aname);
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);
    break;
    
    case "regPortpolio" :
      
      
      $file = $_FILES['thumbimg'];
      $tmp = $file['tmp_name'];
      $name = $file['name'];
      
      if($name){
        // 파일이름 중복 체크
        $dir = "../img/portpolio/";
        $fname = getFilename($name,$dir);
        
        $res = move_uploaded_file($tmp, $dir.$fname);
        // $output['path'] = $dir.$fname; 
        if(!$res){
          $output['error'] = "파일업로드 실패";
        }
      }
      
      if($reg_type == "E"){
        $rt = "수정";
        if(!$fname){
          $img_col = "";
        }else{
          $img_col = "p_img = '{$fname}',";
        }
        
        $sql = "UPDATE sthp_portpolio SET
                  p_title = '{$title}',
                  p_sub_title = '{$shotd}',
                  {$img_col}
                  p_country = '{$country}',
                  p_funding = '{$platform}',
                  p_amount = '{$amount}',
                  p_currency = '{$currency}',
                  P_rate = '{$rate}',
                  p_desc = '{$desc}'
                WHERE
                  p_idx = {$pidx};
        ";
      }else{
        $rt = "등록";
        $sql = "INSERT INTO sthp_portpolio SET
                  p_title = '{$title}',
                  p_sub_title = '{$shotd}',
                  p_img = '{$fname}',
                  p_country = '{$country}',
                  p_funding = '{$platform}',
                  p_amount = '{$amount}',
                  p_currency = '{$currency}',
                  P_rate = '{$rate}',
                  p_desc = '{$desc}',
                  p_wdate = now();
        ";
      }
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "포트폴리오 {$rt} - {$title}";
        getLog($sql,$exec,$aname);
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "delPortpolio" :
      $sql = "UPDATE sthp_portpolio SET p_open = 'N' WHERE p_idx = {$idx}";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "포트폴리오 삭제";
        getLog($sql,$exec,$aname);
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);
    break;
    
    case "viewmail" :
      $post_string = http_build_query($_POST,'','&');
      
      $url = "https://setoworks.cafe24.com/test/template1.php";
      
      $ch = curl_init();                                 //curl 초기화
      curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0'); 

      // post_data
      // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);      
      
      $response = curl_exec($ch);
      curl_close($ch);

      $output['html'] = $response;      
      $output['post'] = $post_string;
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "sendmail" :
      // POST를 GET형태로 바꿔줌.
      $post_string = http_build_query($_POST,'','&');
      
      // 템플릿 HTML 코드 받아오기
      $url = "https://setoworks.cafe24.com/test/template1.php";
      
      $ch = curl_init();                                 //curl 초기화
      curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0'); 

      // post_data
      // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);      
      
      $response = curl_exec($ch);
      curl_close($ch);

      
      // 메일 발송
      include_once "../lib/directsend.php";
      
      // 넘어온 대상을 배열로 만들어 발송함수에 넘김
      $rnames = explode("|",$arr_names);
      $remails = explode("|",$arr_emails);
      $output['target'] = $arr_names;
      $res = sendMail($rnames,$remails,"3연속 가즈아!!!",$response);
      $output['res'] = $res;
      
      echo $res;
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    
    
    
    
    
    
    
    default :
      $output['error'] = "ajax error";
  }
  
  
?>