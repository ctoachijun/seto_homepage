<?
include "header.php";


// 수퍼관리자만 접속할수 있는 페이지에 넣을 처리
if(!chkTopAdmin($aidx)){
  alert_back("접근 권한이 없습니다.");
  exit;
}



if(!$cur_page) $cur_page = 1;
if(!$end) $end = 10;
if(!$cur_page) $cur_page = 1;


if($cur_page > 1){
  $start = $end * ($cur_page - 1);
  $number = $total_cnt - $start;
}else{
  $start = 0;
}

if($sw){
  $where = "WHERE al_{$type} like '%{$sw}%'";
}else{
  $where = "WHERE 1";
}
$sql = "SELECT * FROM sthp_admin_log {$where} ORDER BY al_idx DESC LIMIT {$start},{$end}";
$log = sql_query($sql);
// echo $sql;

$tsql = "SELECT * FROM sthp_admin_log {$where}";
$total_cnt = sql_num_rows($tsql);
// var_dump($total_cnt);
if(!$number) $number = $total_cnt;

// 페이징을 위한 쿼리스트링
$pqs = $_SERVER['QUERY_STRING'];
if(!$pqs){
  $pqs = "&end={$end}&cur_page={$cur_page}&total_cnt={$total_cnt}";
}


?>



  <div id="logList">
    <div class="content">
      <div class="page_title">
        <div>관리자 로그</div>
      </div>
      <form method="get" id="regForm" onsubmit="return chgCurPage()">
          <input type="hidden" name="total_cnt" value="<?=$total_cnt?>" />
          <input type="hidden" name="cur_page" value="<?=$cur_page?>" />
          <input type="hidden" name="end" value="<?=$end?>" />

          <div class="row top_div d-flex">
            <div>
              <select id='stype' class="sel-select" name='type'>
                <option value='name' <? if($type == "name") echo "selected"; ?>>이름</option>            
                <option value='exec' <? if($type == "exec") echo "selected"; ?>>동작</option>
                <option value='wdate' <? if($type == "wdate") echo "selected"; ?>>실행일</option>
              </select>
            </div>
            <div class="d-flex">
              <input type='text' class='txt-input' name="sw" value="<?=$sw?>"/>
              <input type="submit" class='btn' value="검색" />
            </div>
          </div>

          <div class="row table_div">
            <table>
              <? if($log): ?>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>이름</th>
                    <th>동작</th>
                    <th>실행코드</th>
                    <th>실행일</th>
                  </tr>
                </thead>
                <tbody>
                <? foreach($log as $v) : 
                    $idx = $v['al_idx'];
                    $name = $v['al_name'];
                    $exec = $v['al_exec'];
                    $exsql = preg_replace("/\n/","<br>",$v['al_sql']);
                    $wdate = $v['al_wdate'];
                ?>
                  <tr>
                    <td><?=$number?></td>
                    <td><?=$name?></td>
                    <td><?=$exec?></td>
                    <td><?=$exsql?></td>
                    <td><?=$wdate?></td>
                  </tr>
                <? 
                  $number--;
                  endforeach; 
                ?>

                <tr>
                  <td class="pagin" colspan="5"><? getPaging("setohp_log", $pqs, $where)?></td>
                </tr>
                
                </tbody>
                <? else : ?>
                  <tr><td colspan="7">검색결과가 없습니다.</td></tr>
                <? endif; ?>
            </table>
          </div>
          
          <div class="mobi_div">
          <? 
          if($log):
            foreach($log as $v){
              $idx = $v['al_idx'];
              $name = $v['al_name'];
              $exec = $v['al_exec'];
              $exsql = $v['al_sql'];
              $wdate = $v['al_wdate'];              
          ?>
            <div class="log_div">
              <div class="line_1"><div></div><div><?=$wdate?></div></div>
              <div class="line_2"><div><?=$name?></div><div><b><?=$exec?></b></div></div>
              <div class="line_3"><div><?=$exsql?></div></div>
            </div>
          <? 
            }
          ?>
            <div class="pagin" ><? getPaging("setohp_log", $pqs, $where)?></div>

          <? else : ?>
            <div class="nothing">검색결과가 없습니다.</div>
          <? endif; ?>
            
          </div>
            
          
          
          
        </div>
    </form>

  </div>
  
  <? include "footer.php"; ?>  
