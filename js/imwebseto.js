$(function () {
  
    // nav바 배경
    
    // 메인 영역 호버시 배경,색상 변경
    $("#w2023090533b016edb5f36").mouseenter(function(){
        $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","rgba(0,0,0,0.4)");
        $("#w2023090533b016edb5f36 .plain_name").css("color","#fff");
        $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","#fff");

        // 이탈시 시간차로 메인 복원처리에 시간차때문에 여러 오류가 나서, 다 덮어씌움
        // setTimeout(function(){
        //   $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","rgba(0,0,0,0.4)");
        //   $("#w2023090533b016edb5f36 .plain_name").css("color","#fff");
        //   $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","#fff");
        // },450);
  
    })
    
    // 메인 영역에서 이탈시 배경,색상 복원
    $("#w2023090533b016edb5f36").mouseleave(function(){
      // setTimeout(function(){
        $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","");
        $("#w2023090533b016edb5f36 .plain_name").css("color","");
        $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","");
      // },450);

      // // 메인영역 이탈 후 서브영역 호버시 메인 유지
      // $("#dropdown_w2023090533b016edb5f36").mouseenter(function(){
      //   setTimeout(function(){
      //     $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","rgba(0,0,0,0.4)");
      //     $("#w2023090533b016edb5f36 .plain_name").css("color","#fff");
      //     $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","#fff");
      //   },450);
      // })
      
      // // 메인영역 이탈 후 서브영역 호버 후 서브영역 이탈시 메인 배경,색상 복원
      // $("#dropdown_w2023090533b016edb5f36 .mega_dropdown_wrap").mouseleave(function(){
      //   setTimeout(function(){
      //     $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","");
      //     $("#w2023090533b016edb5f36 .plain_name").css("color","");
      //     $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","");
      //   },450);
      // })

    })
   
    
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


    let any = false;

    
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
      $('#w202308243345d0fde1e26 .service_div').each(function () {
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
        let fl = 12.8;
        // fl = 140;
        // let cdw = $(".col-dz-1").width();
        // fl = cdw + 45;
        // console.log(fl);
        if($(window).width() > 991){
    
          if(bottom_of_window >= 1573 && bottom_of_window < 3300){
            $(".fixed_left").css("width",fwid+"px");
            // 좌측 여백 계산
            // fl += 16;
            $(".fixed_left").css("position","fixed");
            $(".fixed_left").css("top","120px");
            $(".fixed_left").css("left",fl+"%");
            // $(".fixed_left").css("bottom","auto");
          }else if(bottom_of_window < 1573){
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top","35px");
            $(".fixed_left").css("left","0px");
          }else if(bottom_of_window >= 3300){
            let fh = $(".service_wrap").height() - $(".fixed_left").height() - 35;
            
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top",fh+"px");
            $(".fixed_left").css("bottom","auto");
            $(".fixed_left").css("left","0px");
          }
        }else{
          // 이 부분은 400px 모바일에서 동작하므로 제외.
          
        }
        
        if(bottom_of_window > 3200 && any === false){
            any = true;
            console.log(any);

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
    

    // WORK에서만 동작
    if($("#s2023090616fb3cf432729").html()){
      let url = new URL(window.location.href);
      let param = url.searchParams.get('category');


      if(!param){
        $("#w2023090778a70f63ea705").hide();
      }else{
        
        let cnt;
        // 크라우드펀딩 카테고리.
        if(param == "mRg58T6185"){
          // 글 업로드 순서대로 플랫폼 및 액수를 추가.
          let arr_plf = new Array(
            "킥스타터", "킥스타터", "와디즈", "마쿠아케", "인디고고", "와디즈", "마쿠아케", "젝젝"
          )
          let arr_amt = new Array(
            "$1,560,000", "$980,000", "￦89,000,000", "￥3,389,000", "$560,000", "￦50,000", "￥850,000", "NT$350,000"
          );

          $("#w2023090778a70f63ea705 .list-style-card").each(function(index){
            $(this).mouseenter(function(){
              cnt = index + 1;
              $("#w2023090778a70f63ea705 .list-style-card:nth-of-type("+cnt+") .card-body").append("<div class='amount'>"+arr_amt[index]+"</div>");
              $("#w2023090778a70f63ea705 .list-style-card:nth-of-type("+cnt+") .card-body").prepend("<div class='plf'>[ "+arr_plf[index]+" ]</div>");
            })
            $(this).mouseleave(function(){
              cnt = index + 1;
              $("#w2023090778a70f63ea705 .list-style-card:nth-of-type("+cnt+") .card-body .amount").remove();
              $("#w2023090778a70f63ea705 .list-style-card:nth-of-type("+cnt+") .card-body .plf").remove();
            })
          })
        }else if(param == "7gZ2T111Hp"){
          $("#w2023090778a70f63ea705 .list-style-card").each(function(index){
            $(this).mouseenter(function(){
              cnt = index + 1;
              $("#w2023090778a70f63ea705 .list-style-card:nth-of-type("+cnt+") .card-body").prepend("<div class='plf'>[ 프리오더 ]</div>");
            })
            $(this).mouseleave(function(){
              cnt = index + 1;
              $("#w2023090778a70f63ea705 .list-style-card:nth-of-type("+cnt+") .card-body .plf").remove();
            })
          })
        }

      }
    }
      
})
// load 끝

const counter = ($counter, max) => {
  // console.log(max);
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
  let uname = $("#input_txt_3a5f3c9c46b4e").val();
  let uemail = $("#input_email_585cb3dbe09ab").val();
  
  
  SITE_FORM.confirmInputForm('w20230831f65b974c1a11c','N');
  if(uname && uemail){
    let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    if (re.test(uemail)) {
      window.open('about:blank').location.href="https://drive.google.com/file/d/1BcRJp_H3Uhu_dngur48j0LYFiJQQVpi7/view?usp=drive_link";
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
