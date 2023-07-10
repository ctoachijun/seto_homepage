<?
include "header.php";


// $arr_tel = array("01041961379","01091900223","010395820339","01039482939","01058203959","01029938829","01039482230");
// $arr_email = array("grandmoni@gmail.com","tjc48@naver.com","jtloger@daum.net","redarima@gmail.com","bimans@hanmail.net","oriring@kakao.com");
// $arr_name = array("문상용","김성용","최경환","전도영","강유나","전주영","장태하","김현욱","이현아","임경도","채선당","현성욱");
// $arr_title = array("문의드립니다.","견적 요청드려요","미팅 가능할까요?","얼마에요?","설명 좀 해주세요","문의요.","궁금합니다");
// $arr_cont = array("오늘 점심은 뭘 먹으면 좋을까요?","한달 식대를 포함해서 얼마쯤이면 되나요?0","3:3 아니면 4:4로 부탁드립니다.","그래서 얼맙니까?","뭐가 확 와닿지 않는데.. 자세한 설명 좀 해주세요.\n아니면 팜플렛 없나요?","연락 좀 주세요.","왜 로또가 맞지 않는걸까요??");
// $arr_comp = array("(주)도다리","한성","삼섬전자","LQ전자","SK하이낙스","트레일(주)","웹스","쿨스","학스","휴앤퀘어","(주)세스고","(주)세토윅스");


// for($i=0; $i<39; $i++){
//   $comp = $arr_comp[array_rand($arr_comp)];
//   $name = $arr_name[array_rand($arr_name)];
//   $email = $arr_email[array_rand($arr_email)];
//   $tel = $arr_tel[array_rand($arr_tel)];
//   $subj = $arr_title[array_rand($arr_title)];
//   $cont = $arr_cont[array_rand($arr_cont)];
//   $secret = rand(1000,9999);
  
//   $term = $i * 2;
//   $tstamp = strtotime("+{$term} seconds");
//   $now = date("Y-m-d H:i:s", $tstamp);

  
//   $sql = "INSERT INTO sthp_inquiry SET
//           i_company = '{$comp}', i_name = '{$name}', i_email = '{$email}', i_tel = '{$tel}', i_subject = '{$subj}', i_content = '{$cont}', 
//           i_secret = {$secret}, i_wdate = '{$now}'
//         ";
            
//   // echo "$sql <br>";
//   // sql_exec($sql);
//   // sleep(rand(1,3));
  
// }



if(!$cur_page) $cur_page = 1;
if(!$end) $end = 50;
if(!$cur_page) $cur_page = 1;
if(!$sort) $sort = "all";


if($cur_page > 1){
  $start = $end * ($cur_page - 1);
  $number = $total_cnt - $start;
}else{
  $start = 0;
}

$order = "DESC";

if($sort == "y"){
  $where = "WHERE i_admin != '' ";
}else if($sort == "n"){
  $where = "WHERE i_admin = '' ";
}else{
  $where = "WHERE 1 ";
}

if($sw){
  $where .= "AND i_{$type} like '%{$sw}%'";
}

$sql = "SELECT * FROM sthp_inquiry {$where} ORDER BY i_wdate {$order} LIMIT {$start},{$end}";
$mooni = sql_query($sql);
// echo $sql;


$tsql = "SELECT * FROM sthp_inquiry {$where}";
$total_cnt = sql_num_rows($tsql);
if(!$number) $number = $total_cnt;


// 페이징을 위한 쿼리스트링
$pqs = $_SERVER['QUERY_STRING'];
if(!$pqs){
  $pqs = "&end={$end}&cur_page={$cur_page}&total_cnt={$total_cnt}";
}


?>


<div id="mooniList">
    <div class="content">
      <form method="get" id="regForm" onsubmit="return chgCurPage()">
          <input type="hidden" name="total_cnt" value="<?=$total_cnt?>" />
          <input type="hidden" name="cur_page" value="<?=$cur_page?>" />
          <input type="hidden" name="end" value="<?=$end?>" />

          <div class="row">
            <select id='ssort' name='sort' onchange="sortAnswer()">
              <option value='all' <? if($sort == "all") echo "selected"; ?>>전체</option>
              <option value='n' <? if($sort == "n") echo "selected"; ?>>미답변</option>
              <option value='y' <? if($sort == "y") echo "selected"; ?>>답변</option>
            </select>
              
            <select id='stype' name='type'>
              <option value='company' <? if($type == "company") echo "selected"; ?>>회사명</option>            
              <option value='name' <? if($type == "name") echo "selected"; ?>>이름</option>            
              <option value='tel' <? if($type == "tel") echo "selected"; ?>>연락처</option>
              <option value='email' <? if($type == "email") echo "selected"; ?>>이메일</option>
              <option value='wdate' <? if($type == "wdate") echo "selected"; ?>>등록일</option>
            </select>
            <input type='text' class='txt-input' name="sw" value="<?=$sw?>"/>
            <input type="submit" class='btn' value="검색" />
          </div>

          <div class="row">
            <table>
              <? if($mooni): ?>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>회사명</th>
                    <th>이름</th>
                    <th>연락처</th>
                    <th>이메일</th>
                    <th>제목</th>
                    <th>내용</th>
                    <th>등록일</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <? foreach($mooni as $v) : 
                    $idx = $v['i_idx'];
                    $comp = $v['i_company'];
                    $name = $v['i_name'];
                    $email = $v['i_email'];
                    $tel = $v['i_tel'];
                    $subj = $v['i_subject'];
                    $cont = $v['i_content'];
                    $wdate = $v['i_wdate'];
                    $adate = $v['i_adate'];
                    !$adate ? $ans_txt = "<span class='noans'>미답변</span>" : $ans_txt = "<span class='yans'>답변</span>";
                  
                    
                    $cont = mb_strimwidth($cont,0,60,"...");
                ?>
                  <tr onclick="setModal(<?=$idx?>)">
                    <td><?=$number?></td>
                    <td><?=$comp?></td>
                    <td><?=$name?></td>
                    <td><?=$tel?></td>
                    <td><?=$email?></td>
                    <td><?=$subj?></td>
                    <td><?=$cont?></td>
                    <td><?=$wdate?></td>
                    <td><?=$ans_txt?></td>
                  </tr>
                <? 
                  $number--;
                  endforeach; 
                ?>

                <tr>
                  <td class="pagin" colspan="9"><? getPaging("setohp_moon", $pqs, $where)?></td>
                </tr>
                
                </tbody>
                <? else : ?>
                  <tr><td colspan="9">검색결과가 없습니다.</td></tr>
                <? endif; ?>
            </table>
            
          </div>
        </div>
    </form>
    
    
    <div class="modal modal_answer">
      <input type="hidden" name="seldata" />
      <div class="modal_row">
        <div class='row_1'><span class="modal_comp"></span><span class="modal_name"></span></div>
      </div>      
      <div class="modal_row">
        <div class="row_2"><span class="modal_tel"></span><span class="modal_email"></span></div>
      </div>      
      <div class="modal_row">
        <div class="row_3">
          <div>제목 : <span class="modal_subject"></span></div><div>작성일 : <span class="modal_wdate"></span></div>
        </div>
      </div>      
      <div class="modal_row">
        <span class="modal_content">날 좀 보소~</span>
      </div>      
      <div class="modal_row"><div class="modal_line"></div></div>      
      <div class="modal_row"><label class="modal_title">작성자 : </label><span class="modal_admin"><?=$aname?> (홈페이지에서는 담당자로 표시됩니다.)</span></div>      
      <div class="modal_row">
        <div class="row_6">
          <div><label class="modal_anstitle">답변</label><span class="modal_adate"></span></div>
          <textarea id="answerCont" onchange="chkSpaceFe(this)"></textarea>
        </div>
      </div>      
      <div class="modal_row">
        <input type="button" class="btn btn-ok" value="등록" onclick="regAnswer()" />
        <input type="button" class="btn btn-no" value="삭제" onclick="delAnswer()" />
        <input type="button" class="btn" value="취소" onclick="closeModal()" />
      </div>      
    </div>

  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
