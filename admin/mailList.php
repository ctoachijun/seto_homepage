<?
include "header.php";



if(!$cur_page) $cur_page = 1;
if(!$end) $end = 20;
if(!$cur_page) $cur_page = 1;
if(!$type) $type = "subject";
if(!$tsort) $tsort = "all";


if($cur_page > 1){
  $start = $end * ($cur_page - 1);
  $number = $total_cnt - $start;
}else{
  $start = 0;
}

$where = "WHERE 1";

if($type == "subject"){
 $where .= " AND s.s_{$type} like '%{$sw}%'";
}else{
  $where .= " AND sl.sl_{$type} like '%{$sw}%'";
}

$join = "as s LEFT OUTER JOIN sthp_sendmail_log as sl ON s.s_idx = sl.sl_sidx";

$sql = "SELECT * FROM sthp_sendmail {$join} {$where} ORDER BY s_wdate DESC LIMIT {$start},{$end}";
$mlist = sql_query($sql);
// echo $sql;

$tsql = "SELECT * FROM sthp_sendmail {$join} {$where}";
$total_cnt = sql_num_rows($tsql);
if(!$number) $number = $total_cnt;


// 페이징을 위한 쿼리스트링
$pqs = $_SERVER['QUERY_STRING'];
if(!$pqs){
  $pqs = "&end={$end}&cur_page={$cur_page}&total_cnt={$total_cnt}";
}



?>



  <div id="mailList">
    <div class="content">
      <div class="page_title">
        <div>뉴스레터 관리</div>
      </div>
      <form method="get" id="regForm" action="<?=$PHP_SELF?>" onsubmit="return chgCurPage();" >
          <input type='hidden' name='cur_page' value="<?=$cur_page?>" />
          <input type='hidden' name='end' value="<?=$end?>" />
          <input type='hidden' name='start' value="<?=$start?>" />
          <input type='hidden' name='total_cnt' value="<?=$total_cnt?>" />

          <div class="row top_div d-flex">
            <div class="rleft_div">
              <select id='stype' name='type' class="sel-select">
                <option value='subject' <? if($type == "subject") echo "selected"; ?>>제목</option>            
                <option value='tname' <? if($type == "tname") echo "selected"; ?>>수신자</option>
                <option value='tmail' <? if($type == "tmail") echo "selected"; ?>>수신메일</option>
                <option value='sdate' <? if($type == "sdate") echo "selected"; ?>>발송일시</option>
              </select>
              <input type='text' class='txt-input' name="sw" value="<?=$sw?>"/>
            </div>
            <div class="rright_div d-flex">
              <input type="submit" class='btn' value="검색" />
              <input type="button" class='btn btn-ok' value="메일 발송" onclick="goSend()"/>
            </div>
          </div>

          <div class="row table_div">
            <table>
              <? if($mlist): ?>
                <thead>
                  <tr>
                    <th>번호</th>
                    <th></th>
                    <th>제목</th>
                    <th>템플릿</th>
                    <th>수신자</th>
                    <th>발송일시</th>
                    <th>결과</th>
                  </tr>
                </thead>
                <tbody>
                <? foreach($mlist as $v) : 
                    $idx = $v['s_idx'];
                    $subject = $v['s_subject'];
                    $template = $v['s_template'];
                    $mainimg = $v['s_mainimg'];
                    $receiver_box = explode("|",$v['sl_tname']);
                    $send_count = $v['sl_count'];
                    $sdate = $v['sl_sdate'];
                    $status = $v['sl_status'];
                    $msg = $v['sl_msg'];
                    
                    if($template == "temp1"){
                      $temp_txt = "1번";
                    }else if($template == "temp2"){
                      $temp_txt = "2번";
                    }else{
                      $temp_txt = "3번";
                    }

                    $send_count -= 1;
                    $send_count > 0 ? $receiver = $receiver_box[0]."<br> 외 {$send_count}명" : $receiver = $receiver_box[0];
                    
                    if($status === "0"){
                      $status_txt = "정상";
                    }else{
                      $status_txt = "발송 실패";
                    }
                      
                    $date_box = explode("-",$v['s_wdate']);
                    $year = $date_box[0];
                    $img = "<img src='../img/nsletter/{$year}/{$mainimg}' />";
                                      
                ?>
                  <tr onclick="showMlDetail(<?=$idx?>)">
                    <td><?=$number?></td>
                    <td><div class='img_div'><?=$img?></div></td>
                    <td><?=$subject?></td>
                    <td><?=$temp_txt?></td>
                    <td><?=$receiver?></td>
                    <td><?=$sdate?></td>
                    <td><?=$status_txt?></td>
                  </tr>
                <? 
                  $number--;
                  endforeach;   
                ?>
                  <tr>
                    <td class="pagin" colspan="7"><? getPaging("setohp_mail_list", $pqs, $where)?></td>
                  </tr>
                                
                </tbody>
                <? else : ?>
                  <tr><td colspan="8" class="nadding">검색결과가 없습니다.</td></tr>
                <? endif; ?>
            </table>
          </div>
                  
          
          <div class="mobi_div d-flex">
            
            <? if($mlist): 
                foreach($mlist as $v) : 
                  $idx = $v['s_idx'];
                  $subject = $v['s_subject'];
                  $template = $v['s_template'];
                  $mainimg = $v['s_mainimg'];
                  $receiver_box = explode("|",$v['sl_tname']);
                  $send_count = $v['sl_count'];
                  $sdate = $v['sl_sdate'];
                  $status = $v['sl_status'];
                  $msg = $v['sl_msg'];
                  
                  if($template == "temp1"){
                    $temp_txt = "1번";
                  }else if($template == "temp2"){
                    $temp_txt = "2번";
                  }else{
                    $temp_txt = "3번";
                  }

                  $send_count -= 1;
                  $send_count > 0 ? $receiver = $receiver_box[0]."<br> 외 {$send_count}명" : $receiver = $receiver_box[0];
                  
                  if($status === "0"){
                    $status_txt = "정상";
                  }else{
                    $status_txt = "발송 실패";
                  }
                    
                  $date_box = explode("-",$v['s_wdate']);
                  $year = $date_box[0];
                  $img = "<img src='../img/nsletter/{$year}/{$mainimg}' />";
            ?>
            
                  <div class="news_div d-flex" onclick="showMlDetail(<?=$idx?>)">
                    <div class="line_1 d-flex">
                      <div>
                        <div class='img_div'><?=$img?></div>
                      </div>
                      <div>
                        <div><?=$subject?></div>
                        <div><?=$status_txt?></div>
                        <div><?=preg_replace("/<br>/","",$receiver)?></div>
                        <div><?=$sdate?></div>                  
                      </div>
                    </div>
                  </div>

              <? endforeach; ?>
            
              <div class="pagin_div"><? getPaging("setohp_mail_list", $pqs, $where)?></div>
            
            <? else: ?>
              <div class="nothing">검색결과가 없습니다.</div>
            <? endif; ?>
          </div>
          


        </div>
    </form>
    
    <div class="modal detail_div">
      <div class="modal_title">
        <div class="title_txt">발송 상세</div>
      </div>
      <div class="detail_row">
        <div class="detail_head">발송일</div>
        <div class="temp_wdate"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">템플릿 종류</div>
        <div class="detail_temp_num"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">발송 건수</div>
        <div class="detail_count"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">수신자</div>
        <div class="detail_receiv"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">수신메일</div>
        <div class="detail_receiv_mail"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">발송 결과</div>
        <div class="detail_result"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">코드-메세지</div>
        <div class="detail_code"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">메세지 상세</div>
        <div class="detail_etc"></div>
      </div>
      <div class="detail_row">
        <div class="detail_head">메일 보기</div>
        <div class="detail_show"></div>
      </div>
    </div>

  </div>
  
  <? include "footer.php"; ?>  
  
  <script>
    $(".backblack").click( function(){
      closeModal();
    })
  </script>