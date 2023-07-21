<?
include "header.php";


if(!$reg_type) $reg_type = "I";
$reg_type == "E" ? $rtxt = "수정": $rtxt = "등록";

$img_path = $noimg;


if($reg_type == "E"){
  $port = getPortpolioInfo($pidx);
  
  $title = $port['p_title'];
  $sub_title = $port['p_sub_title'];
  $img = $port['p_img'];
  $country = $port['p_country'];
  $platform = $port['p_funding'];
  $amount = $port['p_amount'];
  $currency = $port['p_currency'];
  $rate = $port['p_rate'];
  $desc = $port['p_desc'];
  $wdate = $port['p_wdate'];
  $open = $port['p_open'];

  if($open == "Y"){
    $yopen = "checked";
    $sely = "hpact";
  }else{
    $nopen = "checked";  
    $seln = "hpact";
  }
  $img_path = "../img/portpolio/{$img}";

  $platform_img = "<img src='../img/{$platform}.png' />";
  $amount_txt = $currency." ".number_format($amount);
  $rate_txt = number_format($rate)." %";
  
}else{
  $yopen = "checked";
  $nopen = "";
  $sely = "hpact";
  $seln = "";
}




?>


  <div id="portpolReg">
    <div class="content">
      <div class="page_title">
        <div>포트폴리오 <?=$rtxt?></div>
      </div>
      
      <div class="cont_wrap d-flex">
          <div class="cont_left">
              <form method="post" id="regForm" >
                  <input type='hidden' name='reg_type' value="<?=$reg_type?>" />
                  <input type='hidden' name='pidx' value="<?=$pidx?>" />
                  
                  <div class="row first_row">
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>썸네일</div>
                      <div class="row_cont">
                          <input type="button" class="btn btn-ok thumbtn" value="등록하기" />
                          <input type="file" id="thumbimg" name="thumbimg" onchange="setThumbnail(event,'thumb_div')" />
                      </div>
                    </div>
                  <? if($reg_type == "E") : ?>
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>등록일</div>
                      <div class="row_cont">
                        <?=$wdate?>
                      </div>
                    </div>
                    <? endif; ?>
                  </div>
                  <div class="row input1_row">
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>제품명</div>
                      <div class="row_cont">
                        <input type="text" class="txt-input" id="title" name="title" value="<?=$title?>" oninput="setCardData(1,this);" onchange="chkSpaceFe(this);" >
                      </div>
                    </div>
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>제품 종류(손톱깎이,줄자..)</div>
                      <div class="row_cont">
                        <input type="text" class="txt-input" id="shortd" name="shortd" value="<?=$sub_title?>" oninput="chkStrLength(this,30); setCardData(2,this);" onchange="chkSpaceFe(this)" >
                      </div>
                    </div>
                  </div>
                  <div class="row input2_row">
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>국가</div>
                      <div class="row_cont">
                        <select id="country" name="country" class="sel-select" onchange="setCardData(3,this);">
                          <option value="N" <? if($country == "N") echo "selected"; ?>>==선택==</option>
                          <option value="한국" <? if($country == "한국") echo "selected"; ?>>한국</option>
                          <option value="대만" <? if($country == "대만") echo "selected"; ?>>대만</option>
                          <option value="미쿸" <? if($country == "미쿸") echo "selected"; ?>>미쿸</option>
                          <option value="일본" <? if($country == "일본") echo "selected"; ?>>일본</option>
                        </select>
                      </div>
                    </div>
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>플랫폼</div>
                      <div class="row_cont">
                        <select id="platform" name="platform" class="sel-select"  onchange="setCardData(4,this);">
                          <option value="N" <? if($platform == "N") echo "selected"; ?>>==선택==</option>
                          <option value="wadiz" <? if($platform == "wadiz") echo "selected"; ?>>와디즈</option>
                          <option value="kick" <? if($platform == "kick") echo "selected"; ?>>킥스타터</option>
                          <option value="indie" <? if($platform == "indie") echo "selected"; ?>>인디고고</option>
                          <option value="maku" <? if($platform == "maku") echo "selected"; ?>>마쿠아케</option>
                          <option value="zeczec" <? if($platform == "zeczec") echo "selected"; ?>>젝젝</option>
                          <option value="modian" <? if($platform == "modian") echo "selected"; ?>>모디안</option>
                          <option value="pozible" <? if($platform == "pozible") echo "selected"; ?>>포지블</option>
                          <option value="crowdy" <? if($platform == "crowdy") echo "selected"; ?>>크라우디</option>
                          <option value="camp" <? if($platform == "camp") echo "selected"; ?>>캠프퐈이야</option>
                          <option value="machi" <? if($platform == "machi") echo "selected"; ?>>마치yo</option>
                          <option value="green" <? if($platform == "green") echo "selected"; ?>>그린펀딩</option>
                          <option value="flying" <? if($platform == "flying") echo "selected"; ?>>플라잉뷔</option>
                          <option value="taobao" <? if($platform == "taobao") echo "selected"; ?>>타오바오</option>
                          <option value="jd" <? if($platform == "jd") echo "selected"; ?>>JD</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row input3_row">
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>통화</div>
                      <div class="row_cont">
                        <select class="sel-select" id="currency" name="currency">
                          <option value="KRW" <? if($currency == "KRW") echo "selected"; ?>>원(￦)</option>
                          <option value="USD" <? if($currency == "USD") echo "selected"; ?>>달러($)</option>
                          <option value="TWD" <? if($currency == "TWD") echo "selected"; ?>>신대만달러(NT$)</option>
                          <option value="JPY" <? if($currency == "JPY") echo "selected"; ?>>엔(￥)</option>
                          <option value="CNY" <? if($currency == "CNY") echo "selected"; ?>>위안(￥)</option>
                        </select>
                      </div>
                    </div>
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>펀딩금액</div>
                      <div class="row_cont">
                        <input type="text" class="txt-input" id="amount" name="amount" value="<?=$amount?>" oninput="onlyNum(this);setCardData(5,this)" onchange="chkSpaceFe(this)" maxlength="13" >
                      </div>
                    </div>
                  </div>
                  <div class="row input4_row">
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>달성률</div>
                      <div class="row_cont">
                        <input type="text" class="txt-input" id="rate" name="rate" value="<?=$rate?>" oninput="onlyNum(this);setCardData(6,this)" onchange="chkSpaceFe(this)" maxlength="5" >
                      </div>
                    </div>
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>홈페이지 노출</div>
                      <div class="row_cont">
                        <label for="hv_y" class="sel_div hpy <?=$sely?>" onclick="setHpView(1)">노출</label>
                        <input type="radio" id="hv_y" name="open" value="Y" <?=$yopen?> />
                        <label for="hv_n" class="sel_div hpn <?=$seln?>" onclick="setHpView(2)">미노출</label>
                        <input type="radio" id="hv_n" name="open" value="N" <?=$nopen?> />
                      </div>
                    </div>
                  </div>
                  <div class="row input5_row">
                    <div class="row_wrap">
                      <div class="row_title"><span>●</span>간략 설명</div>
                      <div class="row_cont">
                        <textarea id="desc" class="txt-input" name="desc" oninput="chkStrLength(this,100)" onchange="chkSpaceFe(this)"><?=$desc?></textarea>
                        <span class="chkstr">0/100</span>
                      </div>
                    </div>
                  </div>

                  <div class="btn_row">
                    <!-- <? if($reg_type == "E"){ ?><input type="button" class="btn btn-no" value="삭제" onclick="delPortpolio(<?=$pidx?>)" /><? } ?> -->
                    <input type="button" class="btn btn-ok" value="<?=$rtxt?>" onclick="regPortpolio()" />
                    <input type="button" class="btn" value="취소" onclick="pageBack()" />
                  </div>
              </form>
          </div>
          <div class="cont_right d-flex">
              <div class="port_div">
                <div class="ptop_div">
                  <div class="country"><?=$country?></div>
                  <div class="platf"><?=$platform_img?></div>
                </div>
                <div class="thumb_div">
                </div>
                <div class="bottom_div"> 
                  <div class="bline1">
                    <div class="title"><?=$title?></div>
                    <div class="subt"><?=$sub_title?></div>
                  </div>
                  <div class="bline2">
                    <div class="amount"><?=$amount_txt?></div>
                    <div class="rate"><?=$rate_txt?></div>
                  </div>
                </div>
              </div>
          </div>

      </div>      
    </div>
  </div>
  
  
  <? include "footer.php"; ?>  
  
  <script>
    $(".thumbtn").click(function(){
      $("#thumbimg").click();
    });

    // 섬네일 이미지 세팅
    $('.thumb_div').css({"background": "url('<?=$img_path?>') 50% 50%"});
    $('.thumb_div').css({'background-repeat': 'no-repeat'});
    $('.thumb_div').css({'background-size': 'contain'});
      
  </script>


</body>

</html>