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
                <textarea id="cont1" class="txt-input" oninput="chkWall(this);" onchange="chkSpaceFe(this)"></textarea>
              </div>
            </div>
            <div class="row_wrap wv-4">
              <div class="row_title">내용2</div>
              <div class="row_cont">
                <textarea id="cont2" class="txt-input" oninput="chkWall(this);" onchange="chkSpaceFe(this)"></textarea>
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
              <div class="show_div"></div>
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
            <div class="row_wrap wv-42">
              <input type="button" class="btn btn-ok" value="전송" onclick="sendSetoMail()" />
            </div>
          </div>
          
        </div>
    </form>


  
  
    <div id="preview1">
      <div id='temp1' border='1' style='width:100%;padding:20px;background:#000'>      
        <table border='0' cellpadding='0' cellspacing='0' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; min-height:100%; padding:5px; width:100%'>
          <tbody>
            <tr>
              <td id='builder_box' style='vertical-align:top'>
              <table border='0' cellpadding='0' cellspacing='0' id='logoyn' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; display:block; padding-bottom:15px; padding-left:15px; padding-right:15px; padding-top:15px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:left'><a builder-name='upd_img' href='https://setoworks.cafe24.com/img/seto_logo.png' style='display:inline-block;vertical-align:middle;' target='_new'><img alt='' border='0' name='upd_img' src='https://directsend.co.kr/upload_images/logo_64ae67c05e8e2setoworks039228' style='display:inline-block; max-width:100%; vertical-align:middle' width='165' /> </a></td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table border='0' cellpadding='0' cellspacing='0' style='display:block; padding-top:5px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                      <tbody>
                        <tr>
                          <td name='border-type' style='border-color:#dddddd; border-top-style:solid; border-top-width:2px; font-size:1px; line-height:1px'></td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table border='0' cellpadding='0' cellspacing='0' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; display:block; padding-left:15px; padding-right:15px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center'>
                          <p name='text_box' class='pre_head' style='color:#fff; font-family:Helvetica,sans-serif; font-size:24px; font-weight:bold; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table border='0' cellpadding='0' cellspacing='0' style='display:block; padding-top:5px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                      <tbody>
                        <tr>
                          <td name='border-type' style='border-color:#dddddd; border-top-style:solid; border-top-width:2px; font-size:1px; line-height:1px'></td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table border='0' cellpadding='0' cellspacing='0' style='display:block; padding-top:5px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center'>
                              <div class="premain" style="width:500px;height:200px;"></div>
                          </td>
                        </tr>
                        <tr>
                          <td style='padding-left:15px; padding-right:15px; width:100%;text-align:center; padding-top:10px;'>
                          <p name='text_box' class='pre_title1' style='color:#fff; font-family:Helvetica,sans-serif; font-size:45px; font-weight:bold; line-height:1.4; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$title1?></p>
                          </td>
                        </tr>
                        <tr>
                          <td style='padding-left:15px; padding-right:15px; width:100%;text-align:center;'>
                          <p name='text_box' class='pre_cont1'  style='color:#fff; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; line-height:1.4; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$cont1?></p>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table border='0' cellpadding='0' cellspacing='0' id='btnyn' style='display:block; padding-bottom:15px; padding-top:25px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='border:0px; table-layout:fixed; width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center; width:100%'>
                          <table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate; display:inline-block; vertical-align:middle'>
                            <tbody>
                              <tr>
                                <td name='button_box' style='-webkit-box-sizing:border-box; background-color:#ffffff; border-color:#ffffff; border-radius:100px; border-style:solid; border-width:1px; box-sizing:border-box; padding-bottom:15px; padding-left:15px; padding-right:15px; padding-top:15px; text-align:center; width:140px; word-break:break-all'>
                                  <a href='https://setoworks.cafe24.com' style='text-decoration:none;' target='_new'>
                                    <font style='color:#000; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; text-align:center'>세토웍스 바로가기 </font> 
                                  </a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              

              <table border='0' cellpadding='0' cellspacing='0' style='-moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; display:block; padding-bottom:10px; padding-left:15px; padding-right:15px; padding-top:15px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center; width:50%'>
                            <div class="preimg1" style="width:200px;height:200px;"></div>
                          </td>
                          <td style='padding-left:15px; padding-right:15px; width:50%'>
                          <p name='text_box' class='pre_title2' style='color:#fff; font-family:Helvetica,sans-serif; font-size:25px; font-weight:bold; line-height:1.4; margin-bottom:10px; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$title2?></p>
                          <p name='text_box' class='pre_cont2' style='color:#fff; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; line-height:1.4; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; word-break:break-all'><?=$cont2?></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table border='0' cellpadding='0' cellspacing='0' id='btnyn' style='display:block; padding-bottom:15px; padding-top:15px; width:100%'>
                <tbody>
                  <tr>
                    <td style='width:100%'>
                    <table border='0' cellpadding='0' cellspacing='0' style='border:0px; table-layout:fixed; width:100%'>
                      <tbody>
                        <tr>
                          <td style='text-align:center; width:100%'>
                          <table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate; display:inline-block; vertical-align:middle'>
                            <tbody>
                              <tr>
                                <td name='button_box' style='-webkit-box-sizing:border-box; background-color:#ffffff; border-color:#ffffff; border-radius:100px; border-style:solid; border-width:1px; box-sizing:border-box; padding-bottom:15px; padding-left:15px; padding-right:15px; padding-top:15px; text-align:center; width:240px; word-break:break-all'><a href='https://setoworks.cafe24.com' style='text-decoration:none;' target='_new'><font style='color:#000; font-family:Helvetica,sans-serif; font-size:15px; font-weight:normal; text-align:center'>세토웍스 바로가기 </font> </a></td>
                              </tr>
                            </tbody>
                          </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </td>
                  </tr>
                </tbody>
              </table>

              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> 
  
  </div>
  
  
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="./js/admin.js"></script>
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