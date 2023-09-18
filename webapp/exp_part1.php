<?
  include "../lib/seto.php";
  include "../lib/PHPExcel/Classes/PHPExcel.php";
   
  // 생산성
  $ss_sql = "SELECT * FROM ex_wp1_sss";
  $ss_re = sql_query($ss_sql);
  $ss_count = count($ss_re);
  
  
  // 스태프
  $st_sql = "SELECT * FROM ex_wp1_stp";
  $st_re = sql_query($st_sql);
  
  // 합계
  $toyear = date("Y");
  $today = date("Y-m-d");

  
  // 배열 준비
  for($i=1; $i<13; $i++){
    $arr_sum[$i] = 0;
  }
  $arr_txt;
  
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>생산성</title>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <link href="./webapp.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="./webapp.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  

  <style>

  </style>
</head>

<body>
  
  <div id="exp1">
    <div class="cont">
      
      <div class="rows">
        <div class="sss_cont">
          <div class="sss_table dflex">
            <div class="sss_th dflex jcai-center">
              <div class="dflex jcai-center">월차</div><div class=" dflex jcai-center">생산성</div>
            </div>
            
            <?
                foreach($ss_re as $v){ 
                  $ss_idx = $v['ews_idx'];
                  $step = $v['ews_step'];
                  $value = $v['ews_value'];
                  

            ?>
                  <div class="sss_td">
                    <div class="title dflex jcai-center"><?=$step?></div>
                    <div class="value  dflex jcai-center"><input type="text" class="input_txt" name="ss_value<?=$ss_idx?>" value="<?=$value?>"></div>
                  </div>

            <?  } ?>
            </tr>

            </div>
            <div class="input_div">
              <input type="button" class="btn btn-outline-edit" value="수정" onclick="editSaengsan()" >
              <!-- <input type="button" class="btn btn-outline-add" value="추가" onclick="addSaengsan()" > -->
              <input type="hidden" name="ss_count" value="<?=$ss_count?>" >
              <input type="hidden" name="years" value="<?=$toyear?>" >
            </div> 
          </div>
        </div>  

      <div class="rows">
        <div class="step_cont">
            <div class="step_div">
              <div class="add_step dflex jcai-center">
                <div class="input_name"><input type="text" class="input_txt" id="step_name" name="step_name" placeholder="이름" onchange="chkSpaceFe(this)"></div>
                <div class="input_month"><input type="text" class="input_txt" id="datepicker" name="step_month" placeholder="시작일" readonly></div>
                <div class="input_btn">
                  <input type="button" class="btn btn-add" value="추가" onclick="addStep()">
                  <input type="button" class="btn" value="엑셀" onclick="downExcel()">
                </div>
                <div></div>
              </div>
              <div class="step_title dflex">
                <div class="name_title">이름</div>
                <div class="date_title">시작일</div>
                <div class="date_title">개월차</div>
                <div></div>
              </div>              
              <? 
              foreach($st_re as $v){
                $idx = $v['ewstp_idx'];
                $name = $v['ewstp_name'];
                $date = $v['ewstp_date'];
                                
                $date1 = new DateTime($today);
                $date2 = new DateTime($date);
                $interval = date_diff($date1, $date2);
                $diff_month = $interval->m;
                
                // echo "$today - $date = $diff_month 개월 차이<br>";
                
                sumMonth($diff_month,$date);
                $arr_txt = implode("|",$arr_sum);
              ?>
              <div class="step_name dflex">
                
                <div class="name<?=$idx?> dflex jcai-center"><input type="text" class="input_txt" id="name<?=$idx?>" value="<?=$name?>" name="name<?=$idx?>"></div>
                <div class="date<?=$idx?> dflex jcai-center"><input type="text" class="input_txt" id="date<?=$idx?>" value="<?=$date?>" name="date<?=$idx?>"></div>
                <div class="month dflex jcai-center"><?=$diff_month+1?>개월차</div>
                <div class="btn_div bd<?=$idx?>">
                  <input type="button" class="btn btn-edit" value='수정' onclick='editStep(<?=$idx?>)'>
                  <input type="button" class="btn btn-delete" value='삭제' onclick='delStep(<?=$idx?>)'>
                </div>
              </div>              
              <?
              }
              ?>
              
              <input type="hidden" name="sumsum" value="<?=$arr_txt?>" >
            </div>
        </div>
      </div>
          
      <div class="rows">
        <div class="sum_cont dflex fd-column">
          <div class="year_title"><?=$toyear?>년(월차 아닙니다.)</div>
          <div class="month_row dflex">
            <?
              for($i=1; $i<13; $i++):
            ?>
              <div class="month_title"><?=$i?>월</div>                        
            <?
              endfor;
            ?>
          </div>
          <div class="month_value_row dflex">
            <?
              // for($i=1; $i<13; $i++):
                foreach($arr_sum as $v):
            ?>
              <div class="month_value"><?=$v?></div>
            <?
              // endfor;
                endforeach;
            ?>

        </div>
        </div>
      </div>

    
    
    
    
    </div>
  </div>

  <script>
    $( function() {
      $("#datepicker").datepicker();
    })
    $.datepicker.setDefaults({
      dateFormat: 'yy-mm-dd',
      prevText: '이전 달',
      nextText: '다음 달',
      monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
      monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
      dayNames: ['일', '월', '화', '수', '목', '금', '토'],
      dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
      dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
      showMonthAfterYear: true,
      yearSuffix: '년'
    });
      
  </script>
  
  
</body>
</html


<?

function sumMonth($diff,$date){
  for($i=$diff,$a=1; $i>-1; $i--,$a++){
    global $arr_sum,$today,$arr_txt;

    $after_month = date("Y-m-d",strtotime("+{$a} months", strtotime($date)));
    // 다음달이 오늘보다 작으면 배열 해당월 칸에 값을 더한다.
    if($today > $after_month){
      $box = explode("-",$after_month);
      $index = (int)$box[1];
      $sum = $arr_sum[$index];
      $add = getSssValue($a);
      $total = $sum + $add;
      $arr_sum[$index] = $total;
      
      // echo "기준월 $date / $a 개월 뒤 $after_month / index : $index / sum : $sum / add : $add / total : $total<br>";
    }
  }
  
}


function getSssValue($num){
  $sql = "SELECT * FROM ex_wp1_sss WHERE ews_step = '{$num}'";
  $re = sql_fetch($sql);
  
  return $re['ews_value'];
}

?>

