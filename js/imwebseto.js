$(function () {
  
    // nav바 배경
    $("#w20230808d713387d6df0d ul").hover(function(){
        $("#s2023080800e57504dc655").css("backgroundColor","rgba(0,0,0,0.4)");
        $("#dropdown_w20230808d713387d6df0d .plain_name").css("color","#fff");
    })
    $("#w20230808d713387d6df0d ul").mouseleave(function(){
      
      $("#s2023080800e57504dc655").css("backgroundColor","");
      $("#dropdown_w20230808d713387d6df0d .mega_dropdown_wrap").hover(function(){
        $("#s2023080800e57504dc655").css("backgroundColor","rgba(0,0,0,0.4)");
      })
      $("#dropdown_w20230808d713387d6df0d .mega_dropdown_wrap").mouseleave(function(){
        setTimeout(function(){
          $("#s2023080800e57504dc655").css("backgroundColor","");    
        },430);
      })
    })
    
    if($("#dropdown_w20230808d713387d6df0d").css("display") == "none"){
      $("#s2023080800e57504dc655").css("backgroundColor","");
    }else{
      $("#s2023080800e57504dc655").css("backgroundColor","rgba(0,0,0,0.4)");
    }
    
    // 메인 텍스트 오른쪽에 프로젝트 뷰 호버처리.
    $("#s20230817569ed54963a8f .sec_link").hover(function(){
      $(".sec_link").css({
        "width":"150px",  
        "height":"150px",
        "backgroundColor":"#fff",
        "top":"46%",
        "right":"18%"
      });
      $(".sec_link .link_cont").html("<span>view project</span><span>&gt;</span>");
      $(".sec_link .link_cont").css({
        "width":"90%",
        "font-size":"26px",
        "color":"#ff2f97",
        "text-align":"right",
        "padding-right":"40px",
        "line-height":"100%"
      })
    })

    $("#s20230817569ed54963a8f .sec_link").mouseleave(function(){
      $(".sec_link").css({
        "width":"70px",  
        "height":"70px",
        "backgroundColor":"",
        "top":"50%",
        "right":"20%"
      });
      $(".sec_link .link_cont").html(">");
      $(".sec_link .link_cont").css({
        "width":"",
        "font-size":"40px",
        "color":"",
        "text-align":"",
        "padding-right":"",
        "line-height":""
      })
      
    })
        
    
    // HOME 일때 숫자증가.
    if($("#s20230817569ed54963a8f #visual_s20230817569ed54963a8f").html()){
      
      // HOME - 숫자 증가 
      const $mcounter = document.querySelector(".crow_money");
      const $pcounter = document.querySelector(".crow_people");
      const $ucounter = document.querySelector(".crow_unit");
      let mmax = 240;
      let pmax = 26;
      let umax = 600;
      setTimeout(() => counter($mcounter, mmax), 50);
      setTimeout(() => counter($pcounter, pmax), 50);
      setTimeout(() => counter($ucounter, umax), 50);
    }



    // 스크롤시 이미지 등장
    $(window).scroll(function () {

      // top버튼 표시처리
      if( $(window).scrollTop() < 1000 ){
        $("#w20230825d156046a1b84d").css("opacity","0");
      }else{
        $("#w20230825d156046a1b84d").css("opacity","1");
      }
      
      let fwid = $(".fixed_left").width() + 30;
      
      
      // HOME 사업영역 표시 및 fixed 처리.
      $('#s2023081737ab0bc413365 .service_div').each(function () {
        var bottom_of_element = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        let b_service_div = $(".fixed_left").offset().top + $(".fixed_left").outerHeight();
        
            
        // console.log(bottom_of_element);
        // console.log(bottom_of_window);
        // console.log("-------------------");
        if (bottom_of_window > bottom_of_element) {
          $(this).animate({ 'opacity': '1' }, 1000);
        }

        // let fl = ($(window).width() - 1280) / 2;
        // if($(window).width() < 1280 ){
        //   fl = 0;
        // }
        let fl = 17.5;
        if($(window).width() > 991){
    
          if(bottom_of_window >= 1574 && bottom_of_window < 3100){
            $(".fixed_left").css("width",fwid+"px");
            // 좌측 여백 계산
            // fl += 16;
            $(".fixed_left").css("position","fixed");
            $(".fixed_left").css("top","170px");
            $(".fixed_left").css("left",fl+"%");
            // $(".fixed_left").css("bottom","auto");
          }else if(bottom_of_window < 1588){
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top","30px");
            $(".fixed_left").css("left","0px");
          }else if(bottom_of_window >= 3100){
            let fh = $(".service_wrap").height() - $(".fixed_left").height() + 54;
            
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top",fh+"px");
            $(".fixed_left").css("bottom","auto");
            $(".fixed_left").css("left","0px");
          }
          
        }else{
          // 이 부분은 400px 모바일에서 동작하므로 제외.
          
        }
      });
            
      // 글로벌 크라우드 펀딩 - PROCESS 동작
      if( $(window).scrollTop() > $("#text_w202308189b7d14baad0e8").offset().top){
        $(".pbox2").css("animation-name","pb2");        
        $(".pbox3").css("animation-name","pb3");        
        $(".pbox4").css("animation-name","pb4");        
        $(".pbox5").css("animation-name","pb5");        
        $(".pbox6").css("animation-name","pb6");        
      }
      
      
    });
    
    // 전화번호 입력시에는 전부 숫자만 입력되도록 처리
    $("input[type=tel]").keydown(function(){
      let val = this.value;
      this.value = val.replace(/[^0-9]/gi,"");
    })
    
    // 포트폴리오 이미지 호버시
    // ALL
    $("#s2023082320fd98796dfe1 .img_wrap").hover(function(){
      $(".black").css("width","100%");
      $(".black").css("height","100%");
      $(".black").css("backgroundColor","#000");
      $(".black").css("opacity","0.6");
      $(".black").css("z-index","400");
      $(".hover_txt").css("z-index","500");
    })
    $("#s2023082320fd98796dfe1 .img_wrap").mouseleave(function(){
      $(".overlay").css("background","");
      $(".overlay").css("opacity","");
    })
    
    // FUNDING
    $("#s202308230d965259c3f46 .img_wrap").hover(function(){
      $(".black").css("width","100%");
      $(".black").css("height","100%");
      $(".black").css("backgroundColor","#000");
      $(".black").css("opacity","0.6");
      $(".black").css("z-index","400");
      $(".hover_txt").css("z-index","500");
    })
    $("#s202308230d965259c3f46 .img_wrap").mouseleave(function(){
      $(".overlay").css("background","");
      $(".overlay").css("opacity","");
    })
    
    // VIDEO
    $("#s20230823817a716006e1a .img_wrap").hover(function(){
      $(".black").css("width","100%");
      $(".black").css("height","100%");
      $(".black").css("backgroundColor","#000");
      $(".black").css("opacity","0.6");
      $(".black").css("z-index","400");
      $(".hover_txt").css("z-index","500");
    })
    $("#s20230823817a716006e1a .img_wrap").mouseleave(function(){
      $(".overlay").css("background","");
      $(".overlay").css("opacity","");
    })
    
    // MARKETING
    $("#s20230823364a6a73bd0dd .img_wrap").hover(function(){
      $(".black").css("width","100%");
      $(".black").css("height","100%");
      $(".black").css("backgroundColor","#000");
      $(".black").css("opacity","0.6");
      $(".black").css("z-index","400");
      $(".hover_txt").css("z-index","500");
      $(".pwrap").css("z-index","500");
    })
    $("#s20230823364a6a73bd0dd .img_wrap").mouseleave(function(){
      $(".overlay").css("background","");
      $(".overlay").css("opacity","");
    })    
    
    // 피플 이미지 오버
    $("#s202308236afb6cf513ff9 .img_wrap").hover(function(){
      $(".pback").css("width","100%");
      $(".pback").css("height","100%");
      $(".pback").css("backgroundColor","#000");
      $(".pback").css("opacity","0.6");
      $(".pback").css("z-index","400");
      $(".hover_txt").css("z-index","500");
      $(".pwrap").css("z-index",500);
      
      $(".pwrap").slideDown();
      $(".pback").slideDown();
      
    })
    $("#s202308236afb6cf513ff9 .img_wrap").mouseleave(function(){
      $(".pwrap").slideUP();
      $(".pback").slideUp();
      $(".overlay").css("background","");
      $(".overlay").css("opacity","");
    })    
    
    // 연혁 swiper
    if($("#s20230822f09a252370e14 .mySwiper").html()){
      var swiper = new Swiper(".mySwiper", {
        scrollbar: {
          el: ".swiper-scrollbar",
          hide: true,
        },
      });        
    }
    
    // HOME 영역 포개기
    $(".left_div .more_btn").click(function(){
      if( $(".left_cont").css("display") == "none" ){
        $(".left_cont").animate({
          width: "toggle" 
        },400);
      }
    })
    $(".right_div .more_btn").click(function(){
      if( $(".right_cont").css("display") == "none" ){
        $(".right_cont").animate({
          width: "toggle"
        },400);
      }
    })
    $(".left_cont i").click(function(){
      $(".left_cont").animate({
        width: "toggle" 
      },400);
    })
    $(".right_cont i").click(function(){
      $(".right_cont").animate({
        width: "toggle" 
      },400);
    })
    
})
// load 끝



const counter = ($counter, max) => {
  console.log(max);
  let now = max;
  const handle = setInterval(() => {
    $counter.innerHTML = Math.ceil(max - now);
  
    // 목표수치에 도달하면 정지
    if (now < 1) {
      clearInterval(handle);
    }
    
    // 증가되는 값이 계속하여 작아짐
    const step = now / 10;
    
    // 값을 적용시키면서 다음 차례에 영향을 끼침
    now -= step;
  }, 50);
}

function downSg() {
  if (!$("#input_txt_2b1f1ffdc08a1").val()) {
    alert("이름을 입력 해 주세요");
    return false;
  }
  if (!$("#input_email_58604975b635b").val()) {
    alert("이메일을 입력 해 주세요");
    return false;
  }

  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (!re.test($("#input_email_58604975b635b").val())) {
    alert("이메일 형식을 확인 해 주세요.");
    return false;
  }

  SITE_FORM.confirmInputForm('w20230817253577ddd5205', 'N');
  location.href = "/admin/ajax/shop/download_prod_digital_file.cm?target_code=s202308179f2fc24db7397";

}


// 문의에 입력된 데이터를 기존 폼에 세팅 후 전송
function setContactFormData(){
  let uname = $("input[name=contact_name]").val();
  let tel1 = $("input[name=tel1]").val();
  let tel2 = $("input[name=tel2]").val();
  let tel3 = $("input[name=tel3]").val();
  let uemail = $("input[name=contact_email]").val();
  let ucomp = $("input[name=contact_comp").val();
  let ucheck1 = chk1 = ucheck2 = "";
  let uposition = $("input[name=contact_position").val();
  
  // 필수 체크
  if(!ucomp){
    alert("회사명을 입력 해 주세요.");
    return false;
  }
  if(!uname){
    alert("이름을 입력 해 주세요.");
    return false;
  }
  if( !tel1 || !tel2 || !tel3 ){
    alert("연락처를 입력 해 주세요.");
    return false;
  }
  if(!uemail){
    alert("이메일을 입력 해 주세요.");
    return false;
  }

  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (!re.test(uemail)) {
    alert("이메일 형식을 확인 해 주세요.");
    return false;
  }
  
  // 체크 된 값을 원래 폼의 체크박스에 체크하기
  // 유형
  $("input[name='type_check[]']").each(function(index){
    if($(this).is(":checked") == true){
      ucheck1 = $(this).val();
      chk1 = "Y";
      
      $("input[name='checkbox_1k2T3sr7E3[]']").each(function(index){
        if($(this).val() == ucheck1){
          console.log($(this).val());
          $(this).prop("checked",true);
        }
      })
    }
  })
  
  if(chk1 != "Y"){
    alert("유형은 하나이상 선택 해 주세요.");
    return false;
  }
  
  // 목적
  $("input[name='smok[]']").each(function(index){
    if($(this).is(":checked") == true){
      ucheck2 = $(this).val();
      
      $("input[name='checkbox_t49C58l505[]']").each(function(index){
        if($(this).val() == ucheck2){
          console.log($(this).val());
          $(this).prop("checked",true);
        }
      })
    }
  })
  
  // 각 항목 세팅
  $("#input_txt_X3xXA267i9").val(ucomp);
  $("#input_txt_67eccd2dc4655").val(uname);
  $("input[name=phonenumber1_b0f51fbf67589]").val(tel1);
  $("input[name=phonenumber2_b0f51fbf67589]").val(tel2);
  $("input[name=phonenumber3_b0f51fbf67589]").val(tel3);
  $("#input_email_K33b013KUJ").val(uemail);
  $("#input_txt_04F04v0APP").val(uposition);
  
  $("#input_select_P835cUAu78").val($("#contact_money").val());
  $("#input_select_18db537785633").val($("#contact_sche").val());
  $("#input_text_area_820380Ls56").val($("#contact_cont").val());
  
  SITE_FORM.confirmInputForm('w2023082153415106e6bcb','N');
  
}

function chkSpaceFe(obj){
  let id = obj.id;
  let val = obj.value;
  val = val.replace(/(^\s+)|(\s*$)/gi,"");

  $("#"+id).val(val);
}

function downDoc(){
  let comp = $("#input_txt_04l6hl1261").val();
  let uname = $("#input_txt_3a5f3c9c46b4e").val();
  let tel1 = $("input[name=phonenumber1_1810a1a792d2f]").val();
  let tel2 = $("input[name=phonenumber2_1810a1a792d2f]").val();
  let tel3 = $("input[name=phonenumber3_1810a1a792d2f]").val();
  let uemail = $("#input_email_585cb3dbe09ab").val();
  
  SITE_FORM.confirmInputForm('w20230821b61681f246a16','N');
  
  if(comp && uname && tel1 && tel2 && tel3 && uemail){
    let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (re.test(uemail)) {
      location.href="/admin/ajax/shop/download_prod_digital_file.cm?target_code=s202308179f2fc24db7397";
    }
  }
}

function openModal(){
  SITE.openModalMenu('m20230817ba9b448f069b6', 'm20230817674de0a084d43');
}

function regNewsletter(){
  let input_email = $("input[name=homemail").val();
  if(!input_email){
    alert("이메일 주소를 입력 해 주세요.");
    return false;
  }
  
  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (!re.test(input_email)) {
    alert("이메일 주소 형식을 확인 해 주세요.");
    return false;
  }
  
  let chkval = $("#mktok").prop("checked");
  if(!chkval){
    alert("마케팅 활용 동의를 해 주세요.");
    return false;
  }

  
  // 원래 폼에 값 세팅.
  $("#input_email_1f1a2545c2f24").val(input_email);
  if(chkval){
    $("input[name='checkbox_b25a25bfc43a6[]'").prop("checked",true);
  }
  
  SITE_FORM.confirmInputForm('w20230823399063f2e1413','N');
}
