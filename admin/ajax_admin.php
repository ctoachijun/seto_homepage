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
      $mooni = getMooniInfo($idx);
      
      $output['comp'] = $mooni['i_company'];
      $output['name'] = $mooni['i_name'];
      $output['tel'] = $mooni['i_tel'];
      $output['email'] = $mooni['i_email'];
      $output['wdate'] = $mooni['i_wdate'];
      $output['subject'] = $mooni['i_subject'];
      $output['content'] = $mooni['i_content'];
      $output['admin'] = $mooni['i_admin'];
      $output['answer'] = $mooni['i_answer'];
      $output['adate'] = $mooni['i_adate'];
      
      $output['curadmin'] = $aname;
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);
    break;
    
    case "regAnswer" :
      $sql = "UPDATE sthp_inquiry SET i_admin = '{$aname}', i_answer = '{$cont}', i_adate = now() WHERE i_idx = {$idx}";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "문의에 답변 등록";
        getLog($sql,$exec,$aname);
        
      }else{
        $output['state'] = "N";
      }
      $output['sql'] = $sql;
      
      echo json_encode($output);      
    break;
    
    case "delAnswer" :
      $sql = "UPDATE sthp_inquiry SET i_admin = '', i_answer = '', i_adate = NULL WHERE i_idx = {$idx}";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
        
        //로그
        $exec = "문의 답변 삭제";
        getLog($sql,$exec,$aname);
        
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);
    break;

    
    
    
    
    
    default :
      $output['error'] = "ajax error";
  }
  
  
?>