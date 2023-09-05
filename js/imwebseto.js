$(function () {
  
    // nav바 배경
    $("#w2023090533b016edb5f36 ul").hover(function(){
        $("#s2023080800e57504dc655").css("backgroundColor","rgba(0,0,0,0.4)");

        if($("#dropdown_w2023090533b016edb5f36").css("display") == "none"){
          // HOME 이외에 표시 될 작업들
          $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","");
          $("#w2023090533b016edb5f36 .plain_name").css("color","#fff");
          $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","#fff");
        }else{
        }
        
    })
    $("#w2023090533b016edb5f36 ul").mouseleave(function(){
      
      $("#s2023080800e57504dc655").css("backgroundColor","");
      $("#s2023080800e57504dc655 .section_bg_color").css("");
      $("#w2023090533b016edb5f36 .plain_name").css("color","#000");

      
      $("#dropdown_w2023090533b016edb5f36 .mega_dropdown_wrap").hover(function(){
        $("#s2023080800e57504dc655").css("backgroundColor","rgba(0,0,0,0.4)");
        $("#w2023090533b016edb5f36 .plain_name").css("color","#fff");
        $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","#fff");

      })

      $("#dropdown_w2023090533b016edb5f36 .mega_dropdown_wrap").mouseleave(function(){

        setTimeout(function(){
          $("#s2023080800e57504dc655").css("backgroundColor","");    
        },430);
        
        if($("#dropdown_w2023090533b016edb5f36").css("display") == "none"){
        }else{
          // HOME 이외에 표시 될 작업들
          $("#s2023080800e57504dc655 .section_bg_color").css("");
          $("#w2023090533b016edb5f36 .plain_name").css("color","");
        }

      })
    })
    
    if($("#dropdown_w2023090533b016edb5f36").css("display") == "none"){
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
    $(".sec_link").click(function(){
      location.href="/ourwork";
    })
        
    
    // HOME일때 실행
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
      
      // 메인 텍스트 애니메이션 
      // 우선 첫번째 가로폭 설정. 넉넉하게 40 추가.
      let wkw = $("#visual_s20230817569ed54963a8f .txt1").width() + 40;
      $("#visual_s20230817569ed54963a8f .txt_waku").css("width",wkw);
      
      // 1~4까지 루프 판단을 위한 변수.
      let jud = 1;

      // 일정 시간마다 테두리 이동. 단, 766 사이즈 이상에서만.
      if($(window).width() > 400){
        setInterval( ()=>{      
          moveWaku(jud);
          jud++;
          if(jud == 5) jud = 1;
        },3000);
      }
      // 모바일 사이즈. 메인 글자 크기와 사이즈가 다르므로 별도 동작
      if($(window).width() <= 400){
        $("#visual_s20230817569ed54963a8f .txt_waku").css("width",wkw-20);
        setInterval( ()=>{      
          moveWakuMobi(jud);
          jud++;
          if(jud == 5) jud = 1;
        },3000);
      }
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
        // let b_service_div = $(".fixed_left").offset().top + $(".fixed_left").outerHeight();
        
            
        // console.log($(window).scrollTop());
        // console.log($("#last_sd").offset().top);
        // console.log(bottom_of_window);
        // console.log($("#w20230828d674990848ee8").offset().top);
        // console.log("-------------------");
        if (bottom_of_window > bottom_of_element) {
          $(this).animate({ 'opacity': '1' }, 1000);
        }

        // let fl = ($(window).width() - 1280) / 2;
        // if($(window).width() < 1280 ){
        //   fl = 0;
        // }
        let fl = 17.5;
        fl = 9.2;
        if($(window).width() > 991){
    
          if(bottom_of_window >= 1936 && bottom_of_window < 3730){
            $(".fixed_left").css("width",fwid+"px");
            // 좌측 여백 계산
            // fl += 16;
            $(".fixed_left").css("position","fixed");
            $(".fixed_left").css("top","170px");
            $(".fixed_left").css("left",fl+"%");
            // $(".fixed_left").css("bottom","auto");
          }else if(bottom_of_window < 1936){
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top","0px");
            $(".fixed_left").css("left","0px");
          }else if(bottom_of_window >= 3730){
            let fh = $(".service_wrap").height() - $(".fixed_left").height() + 5;
            
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top",fh+"px");
            $(".fixed_left").css("bottom","auto");
            $(".fixed_left").css("left","0px");
          }
          
        }else{
          // 이 부분은 400px 모바일에서 동작하므로 제외.
          
        }

        // 크라우드펀딩 애니메이션인데 안쓸듯
        // if( $(window).scrollTop() > $("#text_w202308189b7d14baad0e8").offset().top){
        //   $(".pbox2").css("animation-name","pb2");        
        //   $(".pbox3").css("animation-name","pb3");        
        //   $(".pbox4").css("animation-name","pb4");        
        //   $(".pbox5").css("animation-name","pb5");        
        //   $(".pbox6").css("animation-name","pb6");        
        // }
        
        
      });
      
      
      // $("#w20230901dc20c8406d406 .post_link_wrap").prop("href","");
      $("#w20230901dc20c8406d406 .post_link_wrap").click(function(){
        return false;
      })
      
      
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
    $("#people_wrap .img_div").mouseenter(function(){
      $("#people_wrap .pbackg").animate({
        width:"100%",
        height:"100%",
        opacity:"0.6"
      },500,function(){
        $("#people_wrap .hov_cont").fadeIn(300);
      });
    })
    
    $("#people_wrap .img_div").mouseleave(function(){
      $("#people_wrap .hov_cont").fadeOut(300,function(){
        $("#people_wrap .pbackg").animate({
          width:"1px",
          height:"1px",
          opacity:"0"
        },500);
      });
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
  
  SITE_FORM.confirmInputForm('w20230831f65b974c1a11c','N');
  
  if(comp && uname && tel1 && tel2 && tel3 && uemail){
    let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    if (re.test(uemail)) {
      location.href="https://protoseto.imweb.me/form_file_download.cm?c=YTo0OntzOjEwOiJib2FyZF9jb2RlIjtzOjIyOiJiMjAyMzA4MzEzNTIyNWE5ZjA5NDEyIjtzOjk6ImZvcm1fY29kZSI7czoyMjoiZjIwMjMwODMxMjdhOTkwM2IxYjhkMSI7czo5OiJmaWxlX2NvZGUiO3M6MjI6ImYyMDIzMDgzMWY0OWQ2MWJhYTY0MDMiO3M6MTQ6ImZpbGVfaXRlbV9jb2RlIjtzOjEzOiJkYTFlNzI4M2EzZjQ5Ijt9";
      // SITE_SHOP_DETAIL.digitalFileDownload('202308313563283');
      // location.href="https://protoseto.imweb.me/admin/ajax/shop/download_prod_digital_file.cm?target_code=s202308179f2fc24db7397";
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
  
  SITE_FORM.confirmInputForm('w20230831e970237b02466','N');
}

function moveWaku(jud){
  // 이동은 1~4까지. 5가 되었다면 1로 변경
  if(jud == 5) jud = 1; 
  
  // 포커스 글자의 너비
  let wkw = $("#visual_s20230817569ed54963a8f .txt"+jud).width() + 40;
  
  // 다음 이동대상의 너비를 알기위해 다음 번호를 지정.
  let judp = jud + 1;

  // 애니메이션 효과 부여
  $("#visual_s20230817569ed54963a8f .txt_waku").css("animation-name","move"+jud);
  
  // 만약, 마지막 4번째라면 다음은 첫번째 블럭을 지정하기 위한 설정.
  if(jud == 4) judp= 1;
  let wkw2 = $("#visual_s20230817569ed54963a8f .txt"+judp).width() + 40;
  let cha = 0;
  // console.log(jud+" / "+judp);
  // console.log(wkw+" / "+wkw2);
  
  // 다음 블럭의 너비와 비교해 어느쪽이 더 넒은지에 따라 계산법 적용 후 너비 적용.
  if(wkw > wkw2){
    cha = wkw - wkw2;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 1){
    }else if(jud == 3){

    }else if(jud == 4){
      $("#visual_s20230817569ed54963a8f .txt2").animate({
        "margin-left": "20px"
      },2000);
      $("#visual_s20230817569ed54963a8f .txt4").animate({
        "margin-left": "0px"
      },2000);
    }

    $("#visual_s20230817569ed54963a8f .txt_waku").animate({
      "width": wkw-cha+"px"
    },2000);
  }else{
    cha = wkw2 - wkw;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 2){
      $("#visual_s20230817569ed54963a8f .txt2").animate({
        "margin-left": "0px"
      },2000);

      $("#visual_s20230817569ed54963a8f .txt4").animate({
        "margin-left": "20px"
      },2000);
    }

    $("#visual_s20230817569ed54963a8f .txt_waku").animate({
      "width": wkw+cha+"px"
    },2000);
  }
  
  // 하단 서브텍스트 동작
  setTimeout(function(){
    $("#visual_s20230817569ed54963a8f .st1").hide();  
    $("#visual_s20230817569ed54963a8f .st2").hide();  
    $("#visual_s20230817569ed54963a8f .st3").hide();  
    $("#visual_s20230817569ed54963a8f .st4").hide();  
    $("#visual_s20230817569ed54963a8f .st"+judp).fadeIn();
  },500)
  

  return jud;
}

function moveWakuMobi(jud){
  // 이동은 1~4까지. 5가 되었다면 1로 변경
  if(jud == 5) jud = 1; 
  
  // 포커스 글자의 너비
  let wkw = $("#visual_s20230817569ed54963a8f .txt"+jud).width() + 20;

  // 애니메이션 효과 부여
  $("#visual_s20230817569ed54963a8f .txt_waku").css("animation-name","mmove"+jud);
  
  // 다음 이동대상의 너비를 알기위해 다음 번호를 지정.
  let judp = jud + 1;
  
  // 만약, 마지막 4번째라면 다음은 첫번째 블럭을 지정하기 위한 설정.
  if(jud == 4) judp= 1;
  let wkw2 = $("#visual_s20230817569ed54963a8f .txt"+judp).width() + 24;
  let cha = 0;
  
  // 다음 블럭의 너비와 비교해 어느쪽이 더 넒은지에 따라 계산법 적용 후 너비 적용.
  if(wkw > wkw2){
    cha = wkw - wkw2;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 1){
    }else if(jud == 3){

    }else if(jud == 4){
      $("#visual_s20230817569ed54963a8f .txt2").animate({
        "margin-left": "0px"
      },2000);
      $("#visual_s20230817569ed54963a8f .txt4").animate({
        "margin-left": "-10px"
      },2000);
    }

    $("#visual_s20230817569ed54963a8f .txt_waku").animate({
      "width": wkw-cha+"px"
    },2000);
  }else{
    cha = wkw2 - wkw;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 2){
      $("#visual_s20230817569ed54963a8f .txt2").animate({
        "margin-left": "-10px"
      },2000);

      $("#visual_s20230817569ed54963a8f .txt4").animate({
        "margin-left": "0px"
      },2000);
    }

    $("#visual_s20230817569ed54963a8f .txt_waku").animate({
      "width": wkw+cha+"px"
    },2000);
  }
    
  // 하단 서브텍스트 동작
  setTimeout(function(){
    $("#visual_s20230817569ed54963a8f .st1").hide();  
    $("#visual_s20230817569ed54963a8f .st2").hide();  
    $("#visual_s20230817569ed54963a8f .st3").hide();  
    $("#visual_s20230817569ed54963a8f .st4").hide();  
    $("#visual_s20230817569ed54963a8f .st"+judp).fadeIn();
  },500)
  

  return jud;
}

function setSizeIframe(){
  window.addEventListener('message', function(e){
    if(e.data.ifheight > 0){
      $("#carr").css("height",e.data.ifheight+50);
      // $("#carr").css("height","3000px");
      // $("#carr").attr('src','https://setoworks.cafe24.com/test/test.php');
      // $("#carr").attr('src','https://makestarrecruit.oopy.io');
      // sendMessageIframeRe();
    }
  })
  // sendMessageIframe();
}

function sendMessageIframe(){
  let ifm = document.getElementById('carr').contentWindow;
  ifm.postMessage({ "parentData" : 'goheight' }, 'https://setoworks.cafe24.com');
}
function sendMessageIframeRe(){
  let ifm = document.getElementById('carr').contentWindow;
  ifm.postMessage({ "parentData" : 'chgCont' }, 'https://setoworks.cafe24.com');
}

function goPage(pg){
  location.href="/"+pg;
}
