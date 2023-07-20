<?
include "header.php";



?>
  <div id="mailSend">
    <div class="content">
      <div class="page_title">
        <div>뉴스레터 발송</div>
      </div>
      <form method="post" id="sendForm" >
          <div class="row news_title">
            <div class="row_wrap">
              <div class="row_title">내용 입력</div>
            </div>
          </div>
          <div class="row notice">
            <div class="row_wrap">
              <div class="row_title">※주의사항</div>
              <div class="row_cont">
                <h4><b>모든 항목이 필수</b>입니다. <span>미리보기</span>를 통해 내용 확인을 반드시 해 주세요.</h4>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>제목</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="subject" name="subject" value="<?=$title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>머릿글</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="head" name="head" value="<?=$title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row temp_div">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>템플릿</div>
              <div class="row_cont">
              <label for="templ1" class="templabel seltemp1 pcursor selact">템플릿1</label><input type="radio" id="templ1" class="pcursor" name="template" value="temp1" onclick="setTemp(1)" checked />
              <label for="templ2" class="templabel seltemp2 pcursor">템플릿2</label><input type="radio" id="templ2" class="pcursor" name="template" value="temp2" onclick="setTemp(2)" />
              <label for="templ3" class="templabel seltemp3 pcursor">템플릿3</label><input type="radio" id="templ3" class="pcursor" name="template" value="temp3" onclick="setTemp(3)" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>타이틀1</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="title1" name="title1" value="<?=$title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>내용1</div>
              <div class="row_cont">
                <textarea id="cont1" name="cont1" class="txt-input" oninput="chkWall(this);" onchange="chkSpaceFe(this)"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>타이틀2</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="title2" name="title2" value="<?=$sub_title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>내용2</div>
              <div class="row_cont">
                <textarea id="cont2" name="cont2" class="txt-input" oninput="chkWall(this);" onchange="chkSpaceFe(this)"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap">
              <div class="row_title"><span>●</span>이미지</div>
              <div class="row_cont img_box">
                
                <div class="img_row">
                  <div class="row_wrap d-flex main_div">
                    <div class="row_title"><span>-</span>메인사진</div>
                    <div class="row_cont">
                      <div>
                      <input type="file" id="mainimg" name="mainimg" class="input_file" onchange="setThumbnail(event,'premain');setImgname(3)" />
                      <input type="button" class="btn mainbtn" value="+" />
                      </div>
                      <p class='mainimg_name'></p>
                    </div>
                  </div>
                  <div class="row_wrap d-flex img1_div">
                    <div class="row_title"><span>-</span>사진1</div>
                    <div class="row_cont">
                      <input type="file" id="img1" name="img1" class="input_file" onchange="setImgname(1); setThumbnail(event,'preimg1')" />
                      <input type="button" class="btn img1btn" value="+" />
                      <p class='img1_name'></p>
                    </div>
                  </div>
                  <div class="row_wrap d-flex img_div img2_div">
                    <div class="row_title"><span>-</span>사진2</div>
                    <div class="row_cont">
                      <input type="file" id="img2" name="img2" class="input_file" onchange="setImgname(2); setThumbnail(event,'preimg2')"/>
                      <input type="button" class="btn img2btn" value="+" />
                      <p class='img2_name'></p>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
          <div class="row preview_div">
            <input type="button" class="btn btn-info" value="미리보기" onclick="showTempl()" />
          </div>
          
          <div class="section_line"></div>
          
          <div class="row news_title">
            <div class="row_wrap">
              <div class="row_title">발송 지정</div>
            </div>
          </div>          
          <div class="row sendtype">
            <div class="row_wrap">
              <div class="row_cont d-flex">
                <div class="send_select_btn d-flex one sendact" onclick="setTargetAdd(1)">개별 추가</div>
                <div class="send_select_btn d-flex all" onclick="setTargetAdd(2)">일괄 추가</div>
              </div>              
            </div>
          </div>
          
          <div class="one_up_div d-flex">
            <div class="row">
              <div class="row_wrap">
                <div class="row_title"><span>▣</span>이름</div>
                <div class="row_cont">
                  <input type="text" class="txt-input" id="name" name="name" onchange="chkSpaceFe(this)" >
                </div>
              </div>
              <div class="row_wrap">
                <div class="row_title"><span>▣</span>메일주소</div>
                <div class="row_cont">
                  <input type="text" class="txt-input" id="email" name="email" onchange="chkSpaceFe(this)" >
                </div>
              </div>
            </div>
            <div class="row">
              <input type="button" class="btn" value="+" onclick="addEmailTarget()" />
            </div>
          </div>


          <div class="all_up_div">
            <div class="all_up">
              <div class="row_wrap">
                <div class="txt_box">
                  <ul>
                    <li>샘플받기 버튼을 눌러 엑셀파일을 받습니다.</li>
                    <li>받은 엑셀 파일의 양식에 맞춰 이름과 이메일을 입력합니다.</li>
                    <li>리스트 업로드 버튼을 눌러 준비 하신 엑셀파일을 업로드 합니다.(20MB 제한)</li>
                  </ul>
                </div>
              </div>
              <div class="row_wrap">
                <div class="excel_div d-flex">
                  <a href="../files/sample.xlsx"><input type="button" class="btn" value="샘플받기" /></a>
                  <input type="button" class="btn btn-warning" value="리스트 업로드" onclick="listUp()" />
                  <input type="file" id="list" class="input_file" name="list"  onchange="setList(this)" />
                </div>
              </div>
            </div>
          </div>
   
          
          <div class="row target_row">
            <div class="row_wrap">
              <input type='hidden' name='rnames' />
              <input type='hidden' name='remails' />
              <div class="target_div">
              </div>
            </div>
            <div class="row_wrap">
              <input type="button" class="btn btn-ok sendbtn" value="전송" onclick="sendSetoMail()" />
            </div>
          </div>
          
        </div>
    </form>

    <? include "previewDiv.php"; ?>
  
  
  
  </div>
  
  
  <? include "footer.php"; ?>  
  <script>
    $(".mainbtn").click( function(){
      $("#mainimg").click();
    });  
    $(".img1btn").click( function(){
      $("#img1").click();
    });  
    $(".img2btn").click( function(){
      $("#img2").click();
    });  
    $(".backblack").click( function(){
      $("#preview1").hide();
      $("#preview2").hide();
      $("#preview3").hide();
      $(".backblack").hide();
    });  
    
  </script>

</body>

</html>