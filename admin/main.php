<?
  include "header.php";
  
  $today = date("Y-m-d");
  $now = time();

  
  // 일 방문 그래프 데이터 - 날짜
  $date = array();
  for($i=6; $i>=1; $i--){
    array_push($date,"'".date("Y-m-d", strtotime($today."-{$i} day"))."'");
  }
  array_push($date,"'".$today."'");
  $date_txt = implode(",",$date);
  
  
  // 일 방문 그래프 데이터
  $count = array();
  foreach($date as $v){
    $val = preg_replace("/\'/","",$v);
    $sql = "SELECT v_total FROM sthp_visit WHERE v_date LIKE '{$val}'";
    $re = sql_fetch($sql);
    $total = $re['v_total'];
    array_push($count,$total);
  }
  $count_txt = implode(",",$count);
  
  
  // 시간별
  $hour = array();
  for($i=0; $i<25; $i++){
    $htxt = "'{$i}시'";
    array_push($hour,$htxt);
  }
  $hour_txt = implode(",",$hour);
  
  // 시간별 데이터
  $sql = "SELECT * FROM sthp_visit WHERE v_date = '{$today}'";
  $re = sql_fetch($sql);
  $hdata = array();
  for($i=0; $i<25; $i++){
    $col = "H".sprintf('%02d',$i);
    $cnt = $re[$col];
    array_push($hdata,$cnt);
  }
  $hdata_txt = implode(",",$hdata);  


  // 오늘 총 방문수
  $day_total = end($count);

  // 오늘 등록된 문의
  $reginq = getReginqToday($today);
  // echo "오늘 등록 문의 : $reginq <br>";
  
  // 미확인 문의
  $noread = getNoReadInq();
  // echo "미확인 문의 : $noread";


?>


<div id="dash">
  <div class="content">
      <div class="row d-flex">
        <div class="row_title wv-1">
          <div class="title">타이틀1</div>
        </div>
        <div class="row_cont wv-1 d-flex">
          <div class="wv-1 d-flex">
            <div class="tcard tc1">
              <div class="tctop">오늘 방문</div>
              <div class="tccont">
                <i class="fa-regular fa-user"></i>
                <span><?=$day_total?></span>
              </div>
            </div>
            <div class="tcard tc2">
              <div class="tctop">등록 문의</div>
              <div class="tccont">
                <i class="fa-regular fa-circle-down"></i>
                <span><?=$reginq?></span>
              </div>
            </div>
            <div class="tcard tc3">
              <div class="tctop">미확인 문의</div>
              <div class="tccont">
                <i class="fa-regular fa-envelope"></i>
                <span><?=$noread?></span>
              </div>
            </div>
          </div>
        </div> 
      </div> 
      <div class="row d-flex">
        <div class="row_title wv-1">
          <div class="title">방문자 통계</div>
        </div>
        <div class="row_cont wv-1 d-flex vgraph">
          <div class="visit1_div"><div id="visit1"></div></div>
          <div class="visit2_div"><div id="visit2"></div></div>
        </div> 
      </div> 
  </div>
</div>





<? include "footer.php"; ?>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js"></script>
  <script>
    $( function() {

    });
    
    var chartDom = document.getElementById('visit1');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
      grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
      },
      xAxis: {
        type: 'category',
        data: [ <?=$date_txt?> ]
      },
      yAxis: {
        type: 'value'
      },
      series: [
        {
          data: [ <?=$count_txt?> ],
          type: 'line'
        }
      ]
    };

    option && myChart.setOption(option);
    
    var chartDom = document.getElementById('visit2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'shadow'
        }
      },
      grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
      },
      xAxis: [
        {
          type: 'category',
          data: [ <?=$hour_txt?> ],
          axisTick: {
            alignWithLabel: true
          }
        }
      ],
      yAxis: [
        {
          type: 'value'
        }
      ],
      series: [
        {
          name: '방문자',
          type: 'bar',
          barWidth: '60%',
          data: [ <?=$hdata_txt?> ]
        }
      ]
    };

    option && myChart.setOption(option);

  </script>
  