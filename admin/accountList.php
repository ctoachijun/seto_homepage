<?
include "header.php";


// 수퍼관리자만 접속할수 있는 페이지에 넣을 처리
if(!chkTopAdmin($aidx)){
  alert_back("접근 권한이 없습니다.");
  exit;
}

$alist = getAdminList($type,$sw);


?>

<div id="accountList">
    <div class="content">
      <div class="page_title">
        <div>계정 관리</div>
      </div>
      <form method="get" id="regForm" >
          <input type='hidden' name='reg_type' value="<?=$reg_type?>" />

          <div class="row top_div d-flex">
            <div>
              <select id='stype' class="sel-select" name='type'>
                <option value='id' <? if($type == "id") echo "selected"; ?>>ID</option>            
                <option value='name' <? if($type == "name") echo "selected"; ?>>이름</option>
                <option value='part' <? if($type == "part") echo "selected"; ?>>부서</option>
              </select>
            </div>
            <div class="sw_div d-flex">
              <input type='text' class='txt-input' name="sw" value="<?=$sw?>"/>
              <input type="submit" class='btn' value="검색" />
              <input type="button" class='btn btn-ok' value="등록" onclick="goReg()"/>
            </div>
            <div>
            </div>
          </div>

          <div class="row table_div d-flex">
            <table>
              <? if($alist): ?>
                <thead>
                  <tr>
                    <th>권한</th>
                    <th>ID</th>
                    <th>이름</th>
                    <th>연락처</th>
                    <th>부서</th>
                    <th>직함</th>
                    <th>로그인</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <? foreach($alist as $v) : 
                    $idx = $v['a_idx'];
                    $id = $v['a_id'];
                    $name = $v['a_name'];
                    $tel = $v['a_tel'];
                    $part = $v['a_part'];
                    $title = $v['a_title'];
                    $grade = $v['a_grade'];
                    $grade == "A" ? $gtxt = "<div class='redcircle'></div>" : $gtxt = "";
                    $login = $v['a_login'];
                ?>
                  <tr onclick="goDetail(<?=$idx?>)">
                    <td><?=$gtxt?></td>
                    <td><?=$id?></td>
                    <td><?=$name?></td>
                    <td><?=$tel?></td>
                    <td><?=$part?></td>
                    <td><?=$title?></td>
                    <td><?=$login?></td>
                    <td><input type='button' class='btn btn-no' onclick="delAdmin(<?=$idx?>)" value="삭제"></span></td>
                  </tr>
                <? endforeach; ?>
                </tbody>
                <? else : ?>
                  <tr><td colspan="7" class="nadding">검색결과가 없습니다.</td></tr>
                <? endif; ?>
            </table>
            
          </div>
        </form>
        
        <div class="view_mobi">
        <? if($alist): ?>
          <? foreach($alist as $v) : 
              $idx = $v['a_idx'];
              $id = $v['a_id'];
              $name = $v['a_name'];
              $tel = $v['a_tel'];
              $part = $v['a_part'];
              $title = $v['a_title'];
              $grade = $v['a_grade'];
              $grade == "A" ? $gtxt = "<div class='redcircle'></div>" : $gtxt = "";
              $grade == "A" ? $bcolr = "topadm" : $bcolr = "";
              $login = $v['a_login'];
          ?>
              <div class="mobiv_div <?=$bcolr?>" onclick="goDetail(<?=$idx?>)">
                <div class="m_line1">
                  <div class="m_cont1 wv-1"><?=$gtxt?><?=$name?></div>
                </div>
                <div class="m_line2">
                  <div class="m_cont1 wv-1"><?=$id?></div>
                </div>
                <div class="m_line3">
                  <div class="m_cont1 wv-1"><?=$tel?></div>
                </div>
                <div class="m_line4">
                  <div class="m_cont1 wv-2"><?=$part?></div><div class="m_cont2 wv-2"><?=$title?></div>
                </div>
                <div class="m_line5">
                  <div class="m_cont1 wv-1"><?=$login?> (최종 로그인)</div>
                </div>
                <div class="m_line6">
                  <div class="m_cont1 wv-1"><input type='button' class='btn btn-no' onclick="delAdmin(<?=$idx?>)" value="삭제"></span></div>
                </div>
          
                <td></td>
              </div>
            <? endforeach; ?>
          <? else : ?>
            <div class="nadding">검색결과가 없습니다.</div>
          <? endif; ?>
        </div>
    </div>
</div>
  
  <? include "footer.php"; ?>

