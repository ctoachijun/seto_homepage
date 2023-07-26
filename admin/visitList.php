<?
include "header.php";


// 수퍼관리자만 접속할수 있는 페이지에 넣을 처리
if(!chkTopAdmin($aidx) || $aid != "bbangs"){
  alert_back("접근 권한이 없습니다.");
  exit;
}

if(!$cur_page) $cur_page = 1;
if(!$end) $end = 20;
if(!$cur_page) $cur_page = 1;


if($cur_page > 1){
  $start = $end * ($cur_page - 1);
  $number = $total_cnt - $start;
}else{
  $start = 0;
}


if(!$today) $today = date("Y-m-d");
$where = "WHERE vd_date like '{$today}%'";

if($sw == "bot"){
  $where .= " AND vd_agent LIKE '%+http%'";
  $bact = "act";
}else if($sw == "user"){
  $where .= " AND vd_agent NOT LIKE '%+http%'";
  $uact = "act";
}else{
  $aact = "act";
}
$sql = "SELECT * FROM sthp_visit_detail {$where} ORDER BY vd_idx DESC LIMIT {$start},{$end}";
$log = sql_query($sql);
// echo $sql;

$tsql = "SELECT * FROM sthp_visit_detail {$where}";
$total_cnt = sql_num_rows($tsql);
// var_dump($total_cnt);
if(!$number) $number = $total_cnt;

// 페이징을 위한 쿼리스트링
$pqs = $_SERVER['QUERY_STRING'];
if(!$pqs){
  $pqs = "&end={$end}&cur_page={$cur_page}&total_cnt={$total_cnt}";
}


// 그래프 데이터 - 날짜
$now = time();
$date = array();
for($i=6; $i>=1; $i--){
  array_push($date,"'".date("Y-m-d", strtotime($today."-{$i} day"))."'");
}
array_push($date,"'".$today."'");
$date_txt = implode(",",$date);


// 그래프 데이터
$count = $bot = $user = array();
foreach($date as $v){
  $val = preg_replace("/\'/","",$v);
  $sql = "SELECT * FROM sthp_visit_detail WHERE vd_date LIKE '{$val}%'";
  array_push($count,sql_num_rows($sql));
  
  $bsql = "SELECT * FROM sthp_visit_detail WHERE vd_date LIKE '{$val}%' AND vd_agent LIKE '%+http%';";
  array_push($bot,sql_num_rows($bsql));
  
  $usql = "SELECT * FROM sthp_visit_detail WHERE vd_date LIKE '{$val}%' AND vd_agent NOT LIKE '%+http%';";
  array_push($user,sql_num_rows($usql));
}
$count_txt = implode(",",$count);
$bot_txt = implode(",",$bot);
$user_txt = implode(",",$user);

?>



  <div id="logList">
    <div class="content">
      <div class="page_title">
        <div>방문자 로그</div>
      </div>
      <form method="get" id="regForm" onsubmit="return chgCurPage()">
          <input type="hidden" name="total_cnt" value="<?=$total_cnt?>" />
          <input type="hidden" name="cur_page" value="<?=$cur_page?>" />
          <input type="hidden" name="end" value="<?=$end?>" />
          <input type="hidden" name="sw" value="<?=$sw?>" />

          <div id="graph_div"></div>

          <div class="row dpicker">
            <div>
              <input type="text" name="today" id="datepicker" value="<?=$today?>" readonly onchange="chgToday()";/> 
            </div>
            <div>
              <input type="button" class="<?=$aact?>" value="전체" onclick="chgSort(1)" />
              <input type="button" class="<?=$bact?>" value="봇" onclick="chgSort(2)" />
              <input type="button" class="<?=$uact?>" value="방문자" onclick="chgSort(3)" />
            </div>
          </div>
          
          <div class="row table_div">
            <table>
              <? if($log): ?>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>IP주소</th>
                    <th>이전 페이지</th>
                    <th>접속환경</th>
                    <th>국가</th>
                  </tr>
                </thead>
                <tbody>
                <? foreach($log as $v) : 
                    $idx = $v['vd_idx'];
                    $ip = $v['vd_ipaddr'];
                    $ref = $v['vd_referer'];
                    $agent = $v['vd_agent'];
                    $code = $v['vd_code'];
                    $country_box = countryCodeNum($code);
                    $country = $country_box['name'];
                    if($ip == "61.82.106.54"){
                      $ip = "<b style='color:#E6002D'>{$ip}</b>";
                    }
                ?>
                  <tr>
                    <td><?=$number?></td>
                    <td><?=$ip?></td>
                    <td><?=$ref?></td>
                    <td><?=$agent?></td>
                    <td><?=$country?></td>
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
              $idx = $v['vd_idx'];
              $ip = $v['vd_ipaddr'];
              $ref = $v['vd_referer'];
              $agent = $v['vd_agent'];
              $code = $v['vd_code'];
              $country = countryCodeNum($code);
              $country = $country_box['name'];
              if(!$ref) $ref = "-";           
          ?>
            <div class="log_div">
              <div class="line_1"><div><?=$ip?></div></div>
              <div class="line_2"><div><?=$ref?></div></div>
              <div class="line_3"><div><?=$agent?></div></div>
              <div class="line_4"><div><?=$country?></div></div>
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js"></script>
  <script>
    $( function() {
      $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        changeMonth: true,
        showOtherMonths: true,
        showOn: "button",
        buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년',
        minDate: "-3Y",
        maxDate: "0D",
        showButtonPanel: true,
        gotoCurrent: false,
        currentText: "오늘",
        closeText: "닫기"
      });
      $( "#datepicker" ).datepicker();


    });
    
    
    var chartDom = document.getElementById('graph_div');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'cross',
          crossStyle: {
            color: '#999'
          }
        }
      },
      toolbox: {
        feature: {
          magicType: { show: true, type: ['line', 'bar'] },
          restore: { show: true }
        }
      },
      legend: {
        data: ['수집봇', '방문자', '총방문수']
      },
      xAxis: [
        {
          type: 'category',
          data: [
            <?=$date_txt?>
          ],
          axisPointer: {
            type: 'shadow'
          }
        }
      ],
      yAxis: [
        {
          type: 'value',
          // name: 'Precipitation',
          min: 0,
          // max: 250,
          interval: 10,
          axisLabel: {
            formatter: '{value}'
          }
        },
        {
          type: 'value',
          // name: 'Temperature',
          // min: 0,
          // max: 25,
          // interval: 5,
          axisLabel: {
            formatter: ''
          }
        }
      ],
      series: [
        {
          name: '수집봇',
          type: 'bar',
          tooltip: {
            valueFormatter: function (value) {
              return value;
            }
          },
          data: [
            <?=$bot_txt?>
          ]
        },
        {
          name: '방문자',
          type: 'bar',
          tooltip: {
            valueFormatter: function (value) {
              return value;
            }
          },
          data: [
            <?=$user_txt?>
          ]
        },
        {
          name: '총방문수',
          type: 'line',
          yAxisIndex: 1,
          tooltip: {
            valueFormatter: function (value) {
              return value;
            }
          },
          data: [
            <?=$count_txt?>
          ]
        }
      ]
    };

    option && myChart.setOption(option);

  </script>
  