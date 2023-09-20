<?
  include "../lib/webapp.php";
     
  // 기준
  $ss_sql = "SELECT * FROM ex_wp1_sss";
  $ss_re = sql_query($ss_sql);
  $ss_count = count($ss_re);
    
  // 멤버
  $st_sql = "SELECT * FROM ex_wp1_stp";
  $st_re = sql_query($st_sql);
  
  // 합계
  $toyear = date("Y");
  $first_month = $toyear."-01";
  $last_month = $toyear."-12";
  $today = date("Y-m-d");

  // 출력 날짜 초기화
  if(!$sstart) $sstart = $first_month;
  if(!$send) $send = $last_month;
  
  
  $arr_txt = $arr_atxt;
  $arr_sum = array();
  $arr_mem_cnt = getSumMember($sstart,$send);
  
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>멤버 건수/금액관리</title>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <link href="../css/webapp.css" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="../js/webapp.js"></script>
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
          <div class="table_title">#기준</div>
          <div class="sss_table dflex">
            
            <div class="sss_th dflex jcai-center">
              <div class="dflex jcai-center">월차</div><div class=" dflex jcai-center">건수</div><div class="dflex jcai-center">금액</div>
            </div>
            
            <?
                foreach($ss_re as $v){ 
                  $ss_idx = $v['ews_idx'];
                  $step = $v['ews_step'];
                  $count = $v['ews_count'];
                  $amount = $v['ews_amount'];
                  

            ?>
                  <div class="sss_td">
                    <div class="title dflex jcai-center"><?=$step?></div>
                    <div class="count  dflex jcai-center"><input type="text" class="input_txt" name="ss_count<?=$ss_idx?>" value="<?=$count?>"></div>
                    <div class="amount  dflex jcai-center"><input type="text" class="input_txt" name="ss_amount<?=$ss_idx?>" value="<?=$amount?>"></div>
                  </div>

            <?  } ?>
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
            <div class="table_title">#멤버</div>
            <div class="step_div">
              <div class="add_step dflex jcai-center">
                <div class="input_name"><input type="text" class="input_txt" id="step_name" name="step_name" placeholder="이름" onchange="chkSpaceFe(this)"></div>
                <div class="input_month"><input type="text" class="input_txt" id="datepicker" name="step_month" placeholder="시작일" readonly></div>
                <div class="input_btn">
                  <input type="button" class="btn btn-add" value="추가" onclick="addStep()">

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
                                
                if($date > $today){
                  $diff_month = 0;
                }else{
                  $date1 = new DateTime($today);
                  $date2 = new DateTime($date);
                  $interval = date_diff($date1, $date2);
                  
                  $diff_year = $interval->y;
                  $diff_month = $interval->m+1;
                  
                  // 1년 이상 차이가 나면 12개월 더하기(연도가 바뀌는게 아닌 1년 차이상.)
                  if($diff_year > 0 ){
                    $diff_month += 12;
                  }
                }
                
                // echo "$today - $date = $diff_month 개월 차이<br>";
                
              ?>
              <div class="step_name dflex">
                
                <div class="name<?=$idx?> dflex jcai-center"><input type="text" class="input_txt" id="name<?=$idx?>" value="<?=$name?>" name="name<?=$idx?>"></div>
                <div class="date<?=$idx?> dflex jcai-center"><input type="text" class="input_txt" id="date<?=$idx?>" value="<?=$date?>" name="date<?=$idx?>"></div>
                <div class="month dflex jcai-center"><?=$diff_month?>개월차</div>
                <div class="btn_div bd<?=$idx?>">
                  <input type="button" class="btn btn-outline-edit" value='수정' onclick='editStep(<?=$idx?>)'>
                  <input type="button" class="btn btn-outline-delete" value='삭제' onclick='delStep(<?=$idx?>)'>
                </div>
              </div>              
              <?
              }
              ?>
              
              <input type="hidden" name="sumcnt" value="<?=$arr_cnt_txt?>" >
              <input type="hidden" name="sumamt" value="<?=$arr_amt_txt?>" >
            </div>
        </div>
      </div>
          
      <div class="rows">
        <div class="search_cont dflex fd-column">
          
          <div class="table_title dflex ai-center">#검색 범위</div>
          <div class="search_row dflex">
            <div class="start_div dflex jcai-center">
              <input type="text" class="input_txt" name="sstart" placeholder="시작일 ex) 2023-09" value="<?=$sstart?>" maxlength="7">
            </div> 
            <div class="pado dflex jcai-center">~</div>
            <div class="end_div dflex jcai-center">
              <input type="text" class="input_txt" name="send" placeholder="종료일 ex) 2023-09" value="<?=$send?>" maxlength="7">
            </div>
            <div class="sbtn_div dflex jcai-center"><input type="button" class="btn" value="검색" onclick="searchDate()" />
          </div>
        </div>
      </div>

      <div class="rows">
        <div class="memcnt_cont dflex fd-column">
          
          <div class="table_title dflex ai-center">#월별 멤버수</div>
          <div class="memcnt_row dflex">
            <div>
              <div class="memcnt_div_title dflex fd-column">
                <div class="memcnt_title"></div>
                <div class="memcnt_value">신규</div>
                <div class="memcnt_value">누적</div>
              </div>
            </div>
            <div>

            <?
                foreach($arr_mem_cnt as $k => $v):
                  $s = getSumMemberCount($k);    
                  if($v > 0){
                    $k = "<b>{$k}</b>";
                    $v = "<b>{$v}</b>";
                    $s = "<b>{$s}</b>";
                  }
  
            ?>
              <div class="memcnt_div dflex fd-column">
                <div class="memcnt_title"><?=$k?></div>
                <div class="memcnt_value"><?=$v?></div>
                <div class="memcnt_value"><?=$s?></div>
              </div>
            <?
              endforeach;
            ?>
            </div>
          </div>
        </div>
      </div>


      <div class="rows">
        <div class="sum_cont dflex fd-column">
          
          <div class="table_title dflex ai-center">#결과<input type="button" class="btn" value="엑셀" onclick="downExcel()"></div>
          <!-- <div class="year_title"><?=$toyear?>년(월차 아닙니다.)</div> -->
          <div class="month_row dflex">
            <div>
              <div class="memcnt_div_title dflex fd-column">
                <div class="memcnt_title">&nbsp;</div>
                <div class="memcnt_value">건수</div>
                <div class="memcnt_value">금액</div>
              </div>            
            </div>
            <div>
            <?

              // sumMonth($diff_month,$date);
              sumMonth($sstart,$send);
              foreach($arr_sum as $k => $v):
                $box = explode("|",$v);
                $sum_cnt = $box[0];
                $sum_amt = $box[1];
                
                $post_sum .= "$k/$v";
                $post_sum .= "#";
                
                if($sum_cnt > 0){
                  $sum_cnt = "<b>{$sum_cnt}</b>";
                  $sum_amt = "<b>{$sum_amt}</b>";
                }
                
            ?>  
                <div class="month_div">
                  <div class="month_title dflex jcai-center"><?=$k?></div>                        
                  <div class="month_value dflex jcai-center"><?=$sum_cnt?></div>
                  <div class="month_value dflex jcai-center"><?=$sum_amt?></div>
                </div>
            <?
              endforeach;
            ?>
            <form method="post">
              <input type="hidden" name="arr_sum" value="<?=$post_sum?>" >
            </form>
            </div>
          </div>
        </div>
      </div>

    
    
    
    
    </div>
  </div>

  <script>
    $( function() {
      
      $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        showMonthAfterYear: true,
        
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],        
        yearSuffix: '년'
      });
      
      $("#datepicker").datepicker({
        
      });
    })

    
    
      
  </script>
  
  
</body>
</html

