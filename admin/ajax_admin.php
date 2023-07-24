<?
  include "../lib/seto.php";
  include "../lib/PHPExcel/Classes/PHPExcel.php";

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
          $_SESSION['agrade'] = $re['a_grade'];
          
          // 로그인 일시 입력처리
          $sql1 = "UPDATE sthp_admin SET a_login = now() WHERE a_idx = ".$re['a_idx'];
          $re1 = sql_exec($sql1);
          
          // // 중복이라도 로그 체크
          // $exec = "관리자 로그인";
          // getLog($sql1,$exec,$re['a_name']);
          
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
        session_destroy();
        
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);
    break;
    
    case "logOut" :
      
      //로그
      // $exec = "[ {$aname} ] 로그아웃";
      // getLog("버튼 클릭으로 로그아웃",$exec,$aname);
      
      session_destroy();
      $output['state'] = "Y";
      
      echo json_encode($output);
    break;
    
    case "setModal" :
      $mooni = getMooniInfo($idx);
      $read = $mooni['i_read'];
      
      // 안읽은 경우에만 읽음표시 후 로그 기록.
      if($read == "N"){
        $sql = "UPDATE sthp_inquiry SET i_read = 'Y' WHERE i_idx = {$idx}";
        $re = sql_exec($sql);
        
        if($re){
          //로그
          $exec = $mooni['i_company']." (".$mooni['i_name'].") 문의 확인";
          getLog($sql,$exec,$aname);
          
          $output['state'] = "Y";
        }else{
          $output['state'] = "N";
        }
      }

      $output['comp'] = $mooni['i_company'];
      $output['name'] = $mooni['i_name'];
      $output['tel'] = $mooni['i_tel'];
      $output['email'] = $mooni['i_email'];
      $output['wdate'] = $mooni['i_wdate'];
      $output['subject'] = $mooni['i_subject'];
      $output['content'] = preg_replace("/\\n/","<br>",$mooni['i_content']);
      $output['read'] = $mooni['i_read'];
      $output['mtype'] = $mooni['it_type'];
      
      
      $output['sql'] = $sql;
      
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
                  p_sub_title = '{$shortd}',
                  {$img_col}
                  p_country = '{$country}',
                  p_funding = '{$platform}',
                  p_amount = '{$amount}',
                  p_currency = '{$currency}',
                  P_rate = '{$rate}',
                  p_desc = '{$desc}',
                  p_open = '{$open}'
                WHERE
                  p_idx = {$pidx};
        ";
      }else{
        $rt = "등록";
        $sql = "INSERT INTO sthp_portpolio SET
                  p_title = '{$title}',
                  p_sub_title = '{$shortd}',
                  p_img = '{$fname}',
                  p_country = '{$country}',
                  p_funding = '{$platform}',
                  p_amount = '{$amount}',
                  p_currency = '{$currency}',
                  P_rate = '{$rate}',
                  p_desc = '{$desc}',
                  p_open = '{$open}',
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
    
    case "addEmailTarget" :
      empty($rnames) ? $rnames = $name : $rnames .= "|{$name}";
      empty($remails) ? $remails = $email : $remails .= "|{$email}";
      
      $arr_name = explode("|",$rnames);
      $arr_email = explode("|",$remails);
      
      for($i=0; $i<count($arr_name); $i++){
        $rname = $arr_name[$i];
        $remail = $arr_email[$i];
        $html .= "
          <div class='line_div ld{$i}'><p class='pname'>{$rname}</p><p class='pmail'>{$remail}</p><p class='exicon pcursor' onclick='removeLine({$i})'>X</p></div>
        ";
      }
      
      $output['html'] = $html;     
      $output['rnames'] = implode("|",$arr_name); 
      $output['remails'] = implode("|",$arr_email); 
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "delEmailTarget" :
      $arr_name = explode("|",$rnames);
      $arr_email = explode("|",$remails);
      
      unset($arr_name[$num]);
      unset($arr_email[$num]);
      
      $arr_name = array_values($arr_name);
      $arr_email = array_values($arr_email);
      
      for($i=0; $i<count($arr_name); $i++){
        $rname = $arr_name[$i];
        $remail = $arr_email[$i];
        $html .= "
          <div class='line_div ld{$i}'><p class='pname'>{$rname}</p><p class='pmail'>{$remail}</p><p class='exicon pcursor' onclick='removeLine({$i})'>X</p></div>
        ";
      }
      
      $output['html'] = $html;     
      $output['rnames'] = implode("|",$arr_name); 
      $output['remails'] = implode("|",$arr_email); 
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "sendSetoMail":
      
      // 폴더 체크후 생성
      $img_root = "../img/nsletter/";
      $tyear = date("Y");
      $img_path = $img_root.$tyear;
      
      // 년단위로 디렉토리 생성
      if( !is_dir($img_path) ){
        mkdir($img_path,0777);
      }
      
      // 파일 업로드
      // 메인이미지
      $mfile = $_FILES['mainimg'];
      $mtmp = $mfile['tmp_name'];
      $mname = $mfile['name'];
            
      $mainname = getFilename($mname,$img_path);
      move_uploaded_file($mtmp,$img_path."/".$mainname);
      $_POST['mainimg'] = $mainname;

      // 사진1
      $i1file = $_FILES['img1'];
      $i1tmp = $i1file['tmp_name'];
      $i1name = $i1file['name'];
            
      $img1name = getFilename($i1name,$img_path);
      move_uploaded_file($i1tmp,$img_path."/".$img1name);
      $_POST['img1'] = $i1name;
      
      
      if($template == "temp2"){
        // 사진2
        $i2file = $_FILES['img2'];
        $i2tmp = $i2file['tmp_name'];
        $i2name = $i2file['name'];
        
        $img2name = getFilename($i2name,$img_path);
        move_uploaded_file($i2tmp,$img_path."/".$img2name);
        $_POST['img2'] = $i2name;
        $i2col = "s_img2 = '{$i2name}',";
        
      }else if($template == "temp3"){
        // 사진3
        $i3file = $_FILES['img3'];
        $i3tmp = $i3file['tmp_name'];
        $i3name = $i3file['name'];
        
        $img3name = getFilename($i3name,$img_path);
        move_uploaded_file($i3tmp,$img_path."/".$img3name);
        $_POST['img3'] = $i3name;
        $i3col = "s_img3 = '{$i3name}',";
      }

      /*
        우선 DB에 입력. 그 후 idx를 이용해 템플릿에 데이터 적용된 HTML을 리턴받도록 한다.
      */
      $title_txt = $title1."|".$title2;
      $cont_txt = $cont1."|".$cont2;
      
      $sql = "INSERT INTO sthp_sendmail SET
                s_template = '{$template}',
                s_subject = '{$subject}',
                s_head = '{$head}',
                s_title = '{$title_txt}',
                s_cont = '{$cont_txt}',
                s_mainimg = '{$mainname}',
                s_img1 = '{$i1name}',
                {$i2col}
                {$i3col}
                s_wdate = now();
      ";
      $sidx = sql_last_id($sql);
      
      /* 
        POST 데이터를 템플릿에 적용시켜서 HTML 리턴 
      */
      
      // 템플릿 HTML 코드 받아오기
      if($template == "temp1"){
        $url = "https://setoworks.cafe24.com/admin/template/template1.php?sidx={$sidx}";
      }else if($template == "temp2"){
        $url = "https://setoworks.cafe24.com/admin/template/template2.php?sidx={$sidx}";
      }
      
      $ch = curl_init();                                 //curl 초기화
      curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0'); 

      $response = curl_exec($ch);
      curl_close($ch);

      
      // /*
      //   데이터 준비해서 대망의 메일발송!  
      // */
      
      include_once "../lib/directsend.php";
    
      // 넘어온 대상을 배열로 만들어 발송함수에 넘김
      $rtnames = explode("|",$rnames);
      $rtemails = explode("|",$remails);
      $output['rtnames'] = $rtnames;
      $output['rtemails'] = $rtemails;

      $res = sendMail($rtnames,$rtemails,$subject,$response);
      
      $res = preg_replace("/\\n/","",$res);
      $jdbox = json_decode($res,true);
      $status = $jdbox['status'];
      $msg = $jdbox['msg'];
      $detail = $jdbox['msg_detail'];
      $mcount = count($rtemails);
      
      if($status === "0"){
        // 정상
        $output['state'] = "Y";
      }else{
        // 비정상
        $output['state'] = "N";
      }
      $output['stauts'] = $status;
      $output['msg'] = $msg;
      
      $lsql = "INSERT INTO sthp_sendmail_log SET
                sl_sidx = {$sidx},
                sl_tname = '{$rnames}',
                sl_tmail = '{$remails}',
                sl_sdate = now(),
                sl_status = '{$status}',
                sl_msg = '{$msg}',
                sl_msg_detail = '{$detail}',
                sl_count = {$mcount}
      ";
      $lre = sql_exec($lsql);
      
        
      // 로그
      $exec = ("메일 발송");
      $sql_txt = "{$sql}\n{$lsql}";
      getLog($sql_txt,$exec,$aname);
      
      $output['sql'] = $sql;
      $output['lsql'] = $lsql;
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "showMlDetail" :
      $info = getSendMailInfo($idx);
      
      // 템플릿 종류 텍스트 생성
      $temp = $info['s_template'];
      if($temp == "temp1"){
        $temp_txt = "1번 템플릿";
        $url = "https://setoworks.cafe24.com/admin/template/template1.php?sidx=".$info['s_idx'];
      }else if($temp == "temp2"){
        $temp_txt = "2번 템플릿";
        $url = "https://setoworks.cafe24.com/admin/template/template2.php?sidx=".$info['s_idx'];
      }else{
        $temp_txt = "3번 템플릿";
        $url = "https://setoworks.cafe24.com/admin/template/template3.php?sidx=".$info['s_idx'];
      }
      
      // 수신자 span으로 개별 생성
      $rbox = explode("|",$info['sl_tname']);
      foreach($rbox as $v){
        $r_txt .= "<span>{$v}</span>";
      }
      
      // 수신메일 span으로 개별 생성
      $rmbox = explode("|",$info['sl_tmail']);
      foreach($rmbox as $v){
        $rm_txt .= "<span>{$v}</span>";
      }
      
      // 결과 텍스트 생성
      if($info['sl_status'] === "0"){
        $res_txt = "정상";
      }else{
        $res_txt = "<span class='detail_err'>오류<span>";
      }
      
      // 코드 - 메세지 텍스트 생성
      if(empty($info['sl_status'])){
        $code_txt = "-";
      }else{
        $code_txt = $info['sl_status'];
      }
      
      // 메세지가 있을때만 뒤에 [ - 메세지]를 붙임.
      if($info['sl_msg']){
       $code_txt .= " - ".$info['sl_msg']; 
      }
      
      // 메세지 상세 텍스트 생성
      if(empty($info['sl_msg_detail'])){
        $etc_txt = "-";
      }else{
        $etc_txt = $info['sl_msg_detail'];
      }
      
      // 새창으로 보기 템플릿 링크
      $show = "<a href='{$url}' target='_blank'>새창으로 보기</a>";
      
      $output['sdate'] = $info['sl_sdate'];
      $output['temp_num'] = $temp_txt;
      $output['receiv'] = $r_txt;
      $output['receiv_mail'] = $rm_txt;
      $output['result'] = $res_txt;
      $output['code'] = $code_txt;
      $output['etc'] = $etc_txt;
      $output['count'] = $info['sl_count']." 건";
      $output['show'] = $show;
      
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
  
    case "setList" :
      
      // 1. 파일업로드
      // 2. 업로드 된 파일에서 데이터 추출
      // 3. html 코드로 생성 후 파일 닫기.
      // 4. 파일 삭제 후 html 코드 반환
      
      $file = $_FILES['list'];
      $tmp = $file['tmp_name'];
      $name = $file['name'];
      
      $path = "../files/tmp_{$name}";
      $res = move_uploaded_file($tmp, $path);  
        
        
      // 엑셀데이터 읽기.
      $phpexcel = new PHPExcel();
      $efiles = $path;
      $output['efiles'] = $efiles;
        
      try{

        $Exreader = PHPExcel_IOFactory::createReaderForFile($efiles);
        $Exreader->setReadDataOnly(true);
        $objExcel = $Exreader->load($efiles);

        $objExcel->setActiveSheetIndex(0);
        $sheet1 = $objExcel->getActiveSheet();
        $garo = $sheet1->getRowIterator();
        
        foreach($garo as $row){
          $cell = $row->getCellIterator();
          $cell->setIterateOnlyExistingCells(false);
        }

        $sero = $sheet1->getHighestRow();
        // $sero = 5;

        for($i=4,$a=0; $i<=$sero; $i++,$a++){

          $name = $sheet1->getCell('A'.$i)->getValue();
          $email = $sheet1->getCell('B'.$i)->getValue();
    
          $html .= "
            <div class='line_div ld{$a}'><p class='pname'>{$name}</p><p class='pmail'>{$email}</p><p class='exicon pcursor' onclick='removeLine({$a})'>X</p></div>
          ";
          
          $arr_name[$a] = $name;
          $arr_email[$a] = $email;
        }
      }catch(exception $e){
        $output['error'] = "엑셀파일 읽는도중 에러가 발생!!!!!";
      }

      $output['html'] = $html;
      $output['arr_name'] = implode("|",$arr_name);      
      $output['arr_email'] = implode("|",$arr_email);      
      
      unlink($path);
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "sendTempPw" :
      $sql = "SELECT * FROM sthp_admin WHERE a_id = '{$id}'";
      $re = sql_fetch($sql);
      // $output['sql'] = $sql;
      // ID가 존재하지 않는경우
      if(!$re){
        $output['state'] = "IN";
      }else{
        $tmp_count = $re['a_tpw_count'];
        $tmp_date = $re['a_tpw_sdate'];
        $today = date("Y-m-d");
        $today_ts = date("Y-m-d H:i:s");
        $name = $re['a_name'];
        
        
        if($tmp_count == 3 && $today == $tmp_date){
          // 일 인증횟수 초과인 경우
          $output['state'] = "O";
        }else{
          // 아무 문제없는 경우 임시비번으로 변경, 카운트 +1, 인증날짜 갱신.
          $today == $tmp_date ? $tmp_count += 1 : $tmp_count = 1;
          $create = passwordGenerator();
          $tmp_pw = password_hash($create,PASSWORD_DEFAULT);
          $usql = "UPDATE sthp_admin SET a_passwd = '{$tmp_pw}', a_first = 'Y', a_tpw_count = {$tmp_count}, a_tpw_sdate = '{$today}' WHERE a_id = '{$id}'";
          $ure = sql_exec($usql);
          
          if($ure){
            // DB입력 되었을경우, 메일 전송.
            $cont = "
            <div style='width:100%;height:80vh;text-align:left'>
              <div style='width:600px;height:550px;border-left:1px solid #CECECE;border-right:1px solid #CECECE;border-radius:10px;'>
                  <div style='width:100%;height:50px;background:#020000;border-top-left-radius:10px;border-top-right-radius:10px;'>
                    <img style='width:200px;height:35px;margin-left:10px;margin-top:6px;' src='https://setoworks.cafe24.com/img/seto_logo.png' />
                  </div>
                  <div style='height:50px;border-bottom:2px solid #020000;margin-left:20px;width:550px;padding-top:15px;padding-bottom:30px;'>
                    <p style='font-size:20px;'>요청하신 <span style='color:#020000;font-weight:700;text-decoration:underline;'>임시비밀번호</span>가 발급되었습니다.</p>
                  </div>
                  <div style='width:580px;margin-left:20px;margin-top:25px;border-bottom:1px solid #999;padding-bottom:20px;'>
                    <div style='display:flex;margin-bottom:20px;'>
                        <div style='width:150px;'>임시비밀번호 :</div>
                        <div style='width:200px;'><span style='color:#E6002D;font-weight:700;'>{$create}</span></div>
                    </div>
                    <div style='display:flex;margin-bottom:20px;'>
                        <div style='width:150px'>접수 시각 :</div>
                        <div style='width:150px'>{$today_ts}</div>
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
                    <a style='' href='https://setoworks.cafe24.com/admin' target='_blank'><p style='margin:0;color:#fff;font-weight:700;font-size:24px;text-decoration:underline;'>관리자 로그인 하러가기</p></a>
                  </div>
              </div>
            </div>
            ";
            
            include_once("../lib/directsend.php");
            $id_arr = explode("|",$id);
            $name_arr = explode("|",$name);
            $res = sendMail($name_arr,$id_arr,"[세토웍스 관리자] 임시비밀번호 발급입니다.",$cont);

            $res = preg_replace("/\\n/","",$res);
            $jdbox = json_decode($res,true);
            $status = $jdbox['status'];
            $msg = $jdbox['msg'];
            $detail = $jdbox['msg_detail'];
            $mcount = count($rtemails);
            
            $lsql = "INSERT INTO sthp_sendmail_log SET
                      sl_sidx = 0,
                      sl_tname = '{$name}',
                      sl_tmail = '{$id}',
                      sl_sdate = now(),
                      sl_status = '{$status}',
                      sl_msg = '{$msg}',
                      sl_msg_detail = '{$detail}',
                      sl_count = {$mcount}
            ";
            $lre = sql_exec($lsql);
            
            // 로그
            $exec = "{$name} / {$id} - 임시비밀번호 메일 발송";
            $sql_txt = "{$usql}\n{$lsql}";
            getLog($sql_txt,$exec,"system");
            
            $output['state'] = "Y";
            
          }else{
            $output['state'] = "N";
          }
        }
      }
      
      echo json_encode($output);
    break;
    
    
    
    default :
      $output['error'] = "ajax error";
      echo json_encode($output);
    
  }
  
  
?>