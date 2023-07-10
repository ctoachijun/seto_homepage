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
      <form method="get" id="regForm" >
          <input type='hidden' name='reg_type' value="<?=$reg_type?>" />

          <div class="row">
            <select id='stype' name='type'>
              <option value='id' <? if($type == "id") echo "selected"; ?>>ID</option>            
              <option value='name' <? if($type == "name") echo "selected"; ?>>이름</option>
              <option value='part' <? if($type == "part") echo "selected"; ?>>부서</option>
            </select>
            <input type='text' class='txt-input' name="sw" value="<?=$sw?>"/>
            <input type="submit" class='btn' value="검색" />
            <input type="button" class='btn btn-ok' value="등록" onclick="goReg()"/>
          </div>

          <div class="row">
            <table>
              <? if($alist): ?>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>이름</th>
                    <th>부서</th>
                    <th>직함</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <? foreach($alist as $v) : 
                    $idx = $v['a_idx'];
                    $id = $v['a_id'];
                    $name = $v['a_name'];
                    $part = $v['a_part'];
                    $title = $v['a_title'];
                    $grade = $v['a_grade'];
                    $grade == "A" ? $gtxt = "<div class='redcircle'></div>" : $gtxt = "";
                ?>
                  <tr>
                    <td><?=$id?></td>
                    <td><?=$name?></td>
                    <td><?=$part?></td>
                    <td><?=$title?></td>
                    <td><?=$gtxt?></td>
                    <td><span class='dtxt pcursor' onclick="goDetail(<?=$idx?>)">상세</span></td>
                    <td><input type='button' class='btn btn-no' onclick="delAdmin(<?=$idx?>)" value="삭제"></span></td>
                  </tr>
                <? endforeach; ?>
                </tbody>
                <? else : ?>
                  <tr><td colspan="7">검색결과가 없습니다.</td></tr>
                <? endif; ?>
            </table>
            
          </div>
        </div>
    </form>

  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
