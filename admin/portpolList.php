<?
include "header.php";


if(!$cur_page) $cur_page = 1;
if(!$end) $end = 10;
if(!$cur_page) $cur_page = 1;
if(!$platform) $platform = "N";


if($cur_page > 1){
  $start = $end * ($cur_page - 1);
  $number = $total_cnt - $start;
}else{
  $start = 0;
}

$order = "DESC";
$where = "WHERE p_open = 'Y' ";


if($platform != "N"){
  $where = "WHERE p_funding = '{$platform}' ";
}

if($sw){
  $where .= "AND p_{$type} like '%{$sw}%'";
}

$sql = "SELECT * FROM sthp_portpolio {$where} ORDER BY p_wdate {$order} LIMIT {$start},{$end}";
$portp = sql_query($sql);
// echo $sql;
// echo "<br>";



// 페이징을 위한 쿼리스트링
$pqs = $_SERVER['QUERY_STRING'];
if(!$pqs){
  $pqs = "&end={$end}&cur_page={$cur_page}&total_cnt={$total_cnt}";
}


?>


<div id="portpolList">
    <div class="content">
      <form method="get" id="regForm" onsubmit="return chgCurPage()">
          <input type="hidden" name="total_cnt" value="<?=$total_cnt?>" />
          <input type="hidden" name="cur_page" value="<?=$cur_page?>" />
          <input type="hidden" name="end" value="<?=$end?>" />
          <input type="hidden" name="reg_type" />

          <div class="row">
            <select id="platform" name="platform" class="sel-select" onchange="sortColumn()">
                  <option value="N" <? if($platform == "N") echo "selected"; ?>>==선택==</option>
                  <option value="wadiz" <? if($platform == "wadiz") echo "selected"; ?>>와디즈</option>
                  <option value="kick" <? if($platform == "kick") echo "selected"; ?>>킥스타터</option>
                  <option value="indie" <? if($platform == "indie") echo "selected"; ?>>인디고고</option>
                  <option value="maku" <? if($platform == "maku") echo "selected"; ?>>마쿠아케</option>
                  <option value="zeczec" <? if($platform == "zeczec") echo "selected"; ?>>젝젝</option>
                  <option value="crowdy" <? if($platform == "crowdy") echo "selected"; ?>>크라우디</option>
                  <option value="camp" <? if($platform == "camp") echo "selected"; ?>>캠프퐈이야</option>
                  <option value="machi" <? if($platform == "machi") echo "selected"; ?>>마치yo</option>
                  <option value="green" <? if($platform == "green") echo "selected"; ?>>그린펀딩</option>
                  <option value="flying" <? if($platform == "flying") echo "selected"; ?>>플라잉뷔</option>
                  <option value="taobao" <? if($platform == "taobao") echo "selected"; ?>>타오바오</option>
                  <option value="jd" <? if($platform == "jd") echo "selected"; ?>>JD</option>
                  <option value="pozi" <? if($platform == "pozi") echo "selected"; ?>>포지블</option>
            </select>

            <select id='stype' name='type'>
              <option value='title' <? if($type == "title") echo "selected"; ?>>제목</option>            
              <option value='country' <? if($type == "country") echo "selected"; ?>>국가</option>
            </select>
            <input type='text' class='txt-input' name="sw" value="<?=$sw?>"/>
            <input type="submit" class='btn' value="검색" />
            <div class='add_div'><input type='button' class='btn btn-ok' value='포트폴리오 추가' onclick='goRegPortp()' /></div>
          </div>

          <div class="port_wrap">
          <? if($portp): 
                foreach($portp as $v):
                  $pidx = $v['p_idx'];
                  $title = $v['p_title'];
                  $sub_title = $v['p_sub_title'];
                  $img = $v['p_img'];
                  $country = $v['p_country'];
                  $funding = $v['p_funding'];
                  $amount = $v['p_amount'];
                  $currency = $v['p_currency'];
                  $rate = $v['p_rate'];
                  $desc = $v['p_desc'];
                  $wdate = $v['p_wdate'];
                  
                  if($currency == "KRW"){
                    $curcy = "￦";
                  }else if($currency == "USD"){
                    $curcy = "$";
                  }else if($currency == "TWD"){
                    $curcy = "NT$";
                  }else if($currency == "CNY"){
                    $curcy = "￥";
                  }else{
                    $curcy = "￥";
                  }
                  $img_path = "../img/portpolio/{$img}";
          ?>
                  <div class="port_div port<?=$pidx?> pcursor" onclick="goEditPortp(this)">
                    <div class="top_div">
                      <div class="country"><?=$country?></div>
                      <div class="platf"><?=$funding?></div>
                    </div>
                    <div class="thumb_div">
                      <img src="<?=$img_path?>" />
                    </div>
                    <div class="bottom_div">
                      <div class="bline1">
                        <div class="title"><?=$title?></div>
                        <div class="subt"><?=$sub_title?></div>
                      </div>
                      <div class="bline2">
                        <div class="amount"><?=$curcy?><?=number_format($amount)?></div>
                        <div class="rate"><?=number_format($rate)?>%</div>
                      </div>
                    </div>
                  </div>
 
                
                
            <?  endforeach; ?>
          <? else : ?>
              <tr><td colspan="9">검색결과가 없습니다.</td></tr>
          <? endif; ?>
            
          </div>
        </div>
    </form>
    

  </div>

  <? include "footer.php"; ?>  

  