<?
include "header.php";



?>
  <div id="mailSend">
    <div class="content">
      <form method="post" id="sendForm" >
          <div class="row">
            <div class="row_wrap wv-2">
              <div class="row_title">제목</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="subject" name="subject" value="<?=$title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap wv-2">
              <div class="row_title">머릿글</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="head" name="head" value="<?=$title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap wv-2">
              <div class="row_title">템플릿</div>
              <div class="row_cont">
                <input type="radio" id="templ1" class="pcursor" name="template" value="temp1" onclick="setTemp(1)" checked /><label for="templ1" class="pcursor">템플릿1</label>
                <input type="radio" id="templ2" class="pcursor" name="template" value="temp2" onclick="setTemp(2)" /><label for="templ2" class="pcursor">템플릿2</label>
                <input type="radio" id="templ3" class="pcursor" name="template" value="temp3" onclick="setTemp(3)" /><label for="templ3" class="pcursor">템플릿3</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap wv-4">
              <div class="row_title">타이틀1</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="title1" name="title1" value="<?=$title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
            <div class="row_wrap wv-4">
              <div class="row_title">타이틀2</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="title2" name="title2" value="<?=$sub_title?>" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap wv-4">
              <div class="row_title">내용1</div>
              <div class="row_cont">
                <textarea id="cont1" name="cont1" class="txt-input" oninput="chkWall(this);" onchange="chkSpaceFe(this)"></textarea>
              </div>
            </div>
            <div class="row_wrap wv-4">
              <div class="row_title">내용2</div>
              <div class="row_cont">
                <textarea id="cont2" name="cont2" class="txt-input" oninput="chkWall(this);" onchange="chkSpaceFe(this)"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="row_wrap wv-6 main_div">
              <div class="row_title">메인사진</div>
              <div class="row_cont">
                <input type="file" id="mainimg" name="mainimg" class="input_file" onchange="setImgname(3); setThumbnail(event,'premain')" />
                <input type="button" class="btn mainbtn" value="찾기" />
                <p class='mainimg_name'></p>
              </div>
            </div>
            <div class="row_wrap wv-6 img1_div">
              <div class="row_title">사진1</div>
              <div class="row_cont">
                <input type="file" id="img1" name="img1" class="input_file" onchange="setImgname(1); setThumbnail(event,'preimg1')" />
                <input type="button" class="btn img1btn" value="찾기" />
                <p class='img1_name'></p>
              </div>
            </div>
            <div class="row_wrap wv-6 img_div img2_div">
              <div class="row_title">사진2</div>
              <div class="row_cont">
                <input type="file" id="img2" name="img2" class="input_file" onchange="setImgname(2); setThumbnail(event,'preimg2')"/>
                <input type="button" class="btn img2btn" value="찾기" />
                <p class='img2_name'></p>
              </div>
            </div>
          </div>

          <div class="row">
            <input type="button" class="btn btn-ok" value="미리보기" onclick="showTempl()" />
          </div>
          
          <div class="row">
            <div class="row_wrap wv-2">
              <div class="excel_div">
                <a href="../files/sample.xlsx"><input type="button" class="btn" value="샘플받기" /></a>
                <input type="button" class="btn" value="리스트 업로드" onclick="listUp()" />
                <input type="file" id="list" class="input_file" name="list"  onchange="setList(this)" />
              </div>
            </div>
          </div>
   
          <div class="row">
            <div class="row_wrap wv-4">
              <div class="row_title">이름</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="name" name="name" onchange="chkSpaceFe(this)" >
              </div>
            </div>
            <div class="row_wrap wv-4">
              <div class="row_title">메일주소</div>
              <div class="row_cont">
                <input type="text" class="txt-input" id="email" name="email" onchange="chkSpaceFe(this)" >
              </div>
            </div>
          </div>
          <div class="row">
            <input type="button" class="btn" value="추가" onclick="addEmailTarget()" />
          </div>
          <div class="row">
            <div class="row_wrap wv-2">
              <input type='hidden' name='rnames' />
              <input type='hidden' name='remails' />
              <div class="target_div">
              </div>
            </div>
            <div class="row_wrap wv-4">
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