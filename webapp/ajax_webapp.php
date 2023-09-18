<?
  include "../lib/seto.php";

  switch($w_mode){
    
    case "editSeangsan":
      $jud = 1;
      $box = explode("|",$data);
      for($i=0; $i<count($box); $i++){
        $value = $box[$i];
        if(empty($value)) $value = 0;
        
        $sql = "UPDATE ex_wp1_sss SET ews_value = '{$value}' WHERE ews_step = '$i'";
        $re = sql_exec($sql);
        
        if(!$re) $jud++;
      }
      
      if($jud == 1){
        $output['state'] = 'Y';
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output);
    break;
    
    case "addStep" :
      $sql = "INSERT INTO ex_wp1_stp SET ewstp_name = '{$name}', ewstp_date = '{$date}'";
      $re = sql_exec($sql);
      
      if($re){
        $output['state'] = "Y";
      }else{
        $output['state'] = "N";
      }
      
      echo json_encode($output,JSON_UNESCAPED_UNICODE);      
    break;
    
    case "editStep" :
      $sql = "UPDATE ex_wp1_stp SET ewstp_name = '{$name}', ewstp_date = '{$date}' WHERE ewstp_idx = {$idx}";
      $re = sql_exec($sql);
            
      if($re){
        $output['state'] = "Y";
      }else{
        $output['state'] = "N";
      }
      echo json_encode($output);
    break;
    
    case "delStep" :
      $sql = "DELETE FROM ex_wp1_stp WHERE ewstp_idx = {$idx}";
      $re = sql_exec($sql);

      if($re){
        $output['state'] = "Y";
      }else{
        $output['state'] = "N";
      }
      echo json_encode($output);
    break;
    
    
    default :
      echo "ajax error";
  }
  

?>