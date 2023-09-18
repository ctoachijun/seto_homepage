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

    
    // HOME일때 실행
    if($("#s20230817569ed54963a8f #visual_s20230817569ed54963a8f").html()){
     
      // 메인 텍스트 애니메이션 
      // 우선 첫번째 가로폭 설정. 넉넉하게 40 추가.
      let wkw = $("#visual_s20230817569ed54963a8f .txt1").width() + 40;
      $("#visual_s20230817569ed54963a8f .txt_waku").css("width",wkw);
      
      let left_pok;
      
      // 1~4까지 루프 판단을 위한 변수.
      let jud = 1;

      // 일정 시간마다 테두리 이동. 단, 766 사이즈 이상에서만.
      if($(window).width() > 414){

        setInterval( ()=>{      
          moveWaku(jud);
          jud++;
          if(jud == 4) jud = 1;
        },3000);
      }
      // 모바일 사이즈. 메인 글자 크기와 사이즈가 다르므로 별도 동작
      if($(window).width() <= 414){
 
        $("#visual_s20230817569ed54963a8f .txt_waku").css("width",wkw-20);
        setInterval( ()=>{      
          moveWakuMobi(jud);
          jud++;
          if(jud == 4) jud = 1;
        },3000);
      }
    }


    // 스크롤시 한번만 동작하기위한 변수
    let any = jum1 = false;

    // 스크롤시 이미지 등장
    $(window).scroll(function () {

      // top버튼 표시처리
      if( $(window).scrollTop() < 1000 ){
        $("#w20230825d156046a1b84d").css("opacity","0");
      }else{
        $("#w20230825d156046a1b84d").css("opacity","1");
      }
      
      // let fwid = $(".fixed_left").width() + 30;
      // HOME 사업영역 표시 및 fixed 처리.
      $('#w202308243345d0fde1e26 .service_div').each(function () {
        var bottom_of_element = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        
        // 카운트 시작점을 위한 좌표구하기
        let count_top = $("#s20230906862a64f70b718").offset().top + $("#s20230906862a64f70b718").outerHeight() - 200;    
        // console.log($(window).scrollTop());
        // console.log($("#last_sd").offset().top);
        // console.log(bottom_of_window);
        // console.log(count_top);
        // console.log("-------------------");

        if($(window).width() > 991){
            
          // 점 애니메이션
          if(jum1 == false){
            jum1 = true;
            
            // 중간에 잠시 멈춤 효과를 위해 callback 함수를 통해 delay로 전부 개별 동작
            TweenMax.to('.tweenbox', 2, {
              bezier: [
                {top:117, right:9},
                {top:300, right:-50},
                {top:414, right:186},
            ], 
              ease: Power1.easeInOut, 
              repeat: 0,
              onComplete:nextMove1()
            });
          }

          if(bottom_of_window >= 1706 && bottom_of_window < 3440){
            // $(".fixed_left").css("width",fwid+"px");
            // 좌측 여백 계산
            $(".fixed_left").css("position","fixed");
            $(".fixed_left").css("top","124px");
            $(".fixed_left").css("left","16.2%");
          }else if(bottom_of_window < 1706){
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top","38px");
            $(".fixed_left").css("left","0px");
          }else if(bottom_of_window >= 3440){
            let fh = $(".service_wrap").height() - $(".fixed_left").height() - 25;
            
            $(".fixed_left").css("position","absolute");
            $(".fixed_left").css("top",fh+"px");
            // $(".fixed_left").css("bottom","auto");
            $(".fixed_left").css("left","0px");
          }
        }else{
          // 이 부분은 400px 모바일에서 동작하므로 제외.
          
        }

        if (bottom_of_window > bottom_of_element) {
          $(this).animate({ 'opacity': '1' }, 1000);
        }

        
        // if(bottom_of_window > 3200 && any === false){
        if(bottom_of_window > count_top && any === false){
            any = true;
            // console.log(any);

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

      });
      
      // HOME 뉴스룸 게시판 클릭시 무효화
      $("#w2023091254e53d77f1943 .post_link_wrap").click(function(){
          location.href="/about?#w2023091229ebe142df7ae";
        return false;
      })
      
    });
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
        


    // 연혁 swiper
    if($("#w202309113b812d6fb921e .mySwiper").html()){
      var swiper = new Swiper(".mySwiper", {
        scrollbar: {
          el: ".swiper-scrollbar",
          hide: false,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
          // nextEl: ".prev_btn",
          // prevEl: ".next_btn",
        },
        // effect: 'coverflow',
        // slidesPerView: 'auto',
        // coverflow: {
        //   rotate: 0,
        //   stretch: 100,
        //   depth: 150,
        //   modifier: 1.5,
        //   slideShadows: true,
        // }
        breakpoints: {
        
          200: {
            slidesPerView: 1,
            spaceBetween: 50,
          },
          768: {
            slidesPerView: 1.3,
          },
        },
                
      });        
    }
    
    // 연혁 넘기기 버튼
    $("#s202309116b4fa1ce7069c .custom_btn .prev_btn").click(function(){
      $(".swiper-button-prev").click();
    })
    $("#s202309116b4fa1ce7069c .custom_btn .next_btn").click(function(){
      $(".swiper-button-next").click();
    })
    
    
    // 피플 모바일에서 클릭시 호버효과 나오게
    if($(window).width() < 991){
      $("#s20230913d2cba4c85dfe6 .img_wrap").click(function(){
      
        if($(this).children(".txt._txt_wrap").css("display") == "none"){
          $(".txt._txt_wrap").css("display","block");
          $(".hover_overlay").css({
            "opacity" : "0"
          });
          $(".hover_txt").css({
            "z-index" : "1",
            "opacity" : "0"
          })
        }else{
          $(".txt._txt_wrap").css("display","block");
          // 기존 nametag 부분 숨기기
          $(this).children(".txt._txt_wrap").css("display","none");
    
          // 호버시 배경 검은색
          $(this).children(".hover_overlay").css({
            "opacity" : "1"
          });
    
          //호버시 나오는 설명글
          $(this).children(".hover_txt").css({
            "z-index" : "10",
            "opacity" : "1"
          })
        }
        
      })
    }
    
    // 피플 이미지 오버
    $("#people_wrap .img_div").mouseenter(function(){
      $("#people_wrap .pbackg").animate({
        width:"100%",
        height:"100%",
        opacity:"0.6"
      },500,function(){
        $("#people_wrap .hov_cont").fadeIn();
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
    
    
    // ABOUT - 뉴스룸 메뉴 클릭시 앵커 처리
    $("#w2023091280f06dfc4dd1d ul li").click(function(){
      console.log($(this).children('a').attr("href"));
      let param = $(this).children('a').attr("href")+"&#w2023091229ebe142df7ae";
      location.href = param;
      
      return false;
    })
    
    // ABOUT - 뉴스룸 게시글 클릭시 주소 처리
    $("#w2023091221648344c2ec5 .post_link_wrap").click(function(){
      
      let category = $(this).find(".title.title-block span em").html();
      if(category == "PRESS RELEASE"){
        // 첫줄 가져오기
        let fline = $(this).find(".text.text-block span").html().replace(/#/g,'');
        console.log(fline);
        // 첫줄가져와서 링크 대신을 하면,게시글 작성 후 뉴스는 수정이 불가 ;;
        // window.open('about:blank').location.href=fline
        // return false;
      }
    })
    
    

    // WORK에서만 동작
    if($("#s2023090616fb3cf432729").html()){
      
      // 호버시가 아닌 그냥 있을때에도 정보 표시      
      $("#w2023090778a70f63ea705 .card").each(function(){
        
        // 카테고리 이름 세팅
        let cate_name = $(this).find(".title > span > em").html();
        cate_name = cate_name.replace("[","");
        cate_name = cate_name.replace("]","");
        $(this).find(".post_link_wrap").prepend("<div class='category_name'>"+cate_name+"</div>");
        
        let title_name = $(this).find(".title").text();
        let box = title_name.replace(/\s/g,"");
        let box2 = box.split("]");
        title_name = box2[1];
        
        // 각 이미지 세팅. 크라우드 펀딩일 경우 첫줄로 이미지를 판단.
        let img_name = amount = "";
        
        if(cate_name == "글로벌 크라우드 펀딩"){
          // let first_line = $(this).find(".text.text-block span").text().replace(/[^ㄱ-ㅎ가-힣]/g,"");
          let first_line = $(this).find(".text.text-block span").text();
          let first_box = first_line.split("-");
          let plf = first_box[0].replace(/[^ㄱ-ㅎ가-힣]/g,"");
          amount = first_box[1];
          console.log(plf+"/"+amount);
          
          if(plf == "킥스타터"){
            img_name = "https://cdn.imweb.me/thumbnail/20230914/091cbc71c1929.png";
          }else if(plf == "인디고고"){
            img_name = "https://cdn.imweb.me/thumbnail/20230914/70e1212b39e13.png";
          }else if(plf == "젝젝"){
            img_name = "";
          }else if(plf == "모디안"){
            img_name = "";
          }else if(plf == "마쿠아케"){
            img_name = "https://cdn.imweb.me/thumbnail/20230914/477cee78eefdf.png";
          }else if(plf == "모디안"){
            img_name = "";
          }else if(plf == "포지블"){
            img_name = "";
          }else if(plf == "와디즈"){
            img_name = "";
          }
        }else if(cate_name == "글로벌 프리오더"){
          img_name = "";
        }else if(cate_name == "글로벌 컨텐츠 마케팅"){
          img_name = "";
        }else if(cate_name == "글로벌 디지털 마케팅"){
          img_name = "";
        }else if(cate_name == "글로벌 커머스"){
          img_name = "https://cdn.imweb.me/thumbnail/20230914/269d4323c01c4.png";
        }else if(cate_name == "전시회 / 팝업스토어"){
          img_name = "https://cdn.imweb.me/thumbnail/20230914/1f3aa556e4287.png";
        }
        $(this).find(".post_link_wrap").append("<div class='title_div'><div class='img_row'><div class='title_img'><img src='"+img_name+"' alt=''></div><div class='amount'>"+amount+"</div></div><div class='title_name'>"+title_name+"</div></div>");
        
      })
    }
    
    // footer 언어 버튼
    $("#w20230828387546295e2ef .current_country").click(function(){
      $(".sub_countmenu").toggle();
    })
    
    
    if($(window).width() < 600){
      // ABOUT 애니메이션
      $("#about_div .left_div").css("animation-name","mleft-move");
      $("#about_div .right_div").css("animation-name","mright-move");
    }else{
      // ABOUT 애니메이션
      $("#about_div .center_div").css("animation-name","center-move");
      $("#about_div .right_div").css("animation-name","right-move");
    }

    
    // ABOUT 해외 지사 구글맵 부분 - 클릭시 표시, 클릭시 닫음.
    $(".addr_div").click(function(){
      let box = this.className.split(" ");
      let target = box[1];
      let dp = $(".addr_iframe_div").css("display");
      $(".addr_iframe_div").slideUp();
    
      if($(".i"+target).css("display") == "block"){
        setTimeout(function(){
          $("#about_addr_div").css("height","300px");
        },500);
      }else{
        if($("#about_addr_div").css("height") == "300px"){
          $("#about_addr_div").css("height","600px");
          $(".i"+target).slideDown();
        }else{
          $(".i"+target).slideDown();
        }
      }
    })

    // 요거는 호버시 구글맵 나오게하던거
    // $("#about_addr_div").mouseleave(function(){
    //   $(".addr_iframe_div").slideUp();
    //   setTimeout(function(){
    //     $("#about_addr_div").css("height","300px");
    //   },500);

    // });
    
    // $(".addr_div").mouseleave(function(){
    //   $(".addr_iframe_div").mouseenter(function(){
    //     let box = this.className.split(" ");
    //     let target = box[1];
    //     $("."+target).show();
    //     $("#about_addr_div").css("height","600px");
    //   })
    // })

    // $(".addr_iframe_div").mouseleave(function(){
    //   $(".addr_iframe_div").slideUp();
    //   setTimeout(function(){
    //     $("#about_addr_div").css("height","300px");
    //   },500);
    // })
    
    
      

    
    
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


// 문의하기 입력폼 처리

// 유형 클릭시 체크박스 세팅
function chk_tgroup(group,num){
  let val;
  if(group == 1){
    val = $(".chk_tgroup:nth-of-type("+num+")").html();
    $("input[name='type_check[]']").each(function(index){
      if($(this).val() == val){
        if($(this).prop("checked") === false){
          $(this).prop("checked",true);
          $(".chk_tgroup:nth-of-type("+num+")").addClass("active");
        }else{
          $(this).prop("checked",false);
          $(".chk_tgroup:nth-of-type("+num+")").removeClass("active");
        }
      }
    })
  }else{
    val = $(".chk_smok:nth-of-type("+num+")").html();
    $("input[name='smok[]']").each(function(index){
      if($(this).val() == val){
        if($(this).prop("checked") === false){
          $(this).prop("checked",true);
          $(".chk_smok:nth-of-type("+num+")").addClass("active");
        }else{
          $(this).prop("checked",false);
          $(".chk_smok:nth-of-type("+num+")").removeClass("active");
        }
      }
    })
  }
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

function onlyNum(obj){
  let val = obj.value;

  obj.value = val.replace(/[^0-9]/gi,"");
}

function downDoc(){
  let uname = $("#input_txt_3a5f3c9c46b4e").val();
  let uemail = $("#input_email_585cb3dbe09ab").val();
  let chk = chkbox_chk();
  
  SITE_FORM.confirmInputForm('w20230831f65b974c1a11c','N');
  if(uname && uemail){
    let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    if (re.test(uemail) && chk) {
      setTimeout(function(){
        window.open('about:blank').location.href="https://drive.google.com/file/d/1BcRJp_H3Uhu_dngur48j0LYFiJQQVpi7/view?usp=drive_link";
      },2000);
    }
  }
}

function setData(num,obj){
  let val = obj.value;
  
  if(num == 1){
    $("#input_txt_3a5f3c9c46b4e").val(val);
  }else if(num == 2){
    $("#input_email_585cb3dbe09ab").val(val);
  }else if(num == 3){
    $("#input_txt_04l6hl1261").val(val);
  }else if(num == 4){
    $("input[name=phonenumber1_1810a1a792d2f]").val(val);
  }else if(num == 5){
    $("input[name=phonenumber2_1810a1a792d2f]").val(val);
  }else if(num == 6){
    $("input[name=phonenumber3_1810a1a792d2f]").val(val);
  }
}

function chkbox_chk(){
  let chk = $("#chk_agree").prop("checked");
  $("input[name='checkbox_5504of1lg1[]']").prop("checked",chk);
  return chk;
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
  
  // 이동은 1~3까지. 4가 되었다면 1로 변경
  if(jud == 4) jud = 1; 
  
  // 포커스 글자의 너비
  let wkw = $("#visual_s20230817569ed54963a8f .txt"+jud).width() + 40;
  
  // 다음 이동대상의 너비를 알기위해 다음 번호를 지정.
  let judp = jud + 1;
  
  // 애니메이션 효과 부여
  $("#visual_s20230817569ed54963a8f .txt_waku").css("animation-name","move"+jud);
  
  // 만약, 마지막 4번째라면 다음은 첫번째 블럭을 지정하기 위한 설정.
  if(jud == 3) judp= 1;
  let wkw2 = $("#visual_s20230817569ed54963a8f .txt"+judp).width() + 40;
  let cha = 0;

  
  // 다음 블럭의 너비와 비교해 어느쪽이 더 넒은지에 따라 계산법 적용 후 너비 적용.
  if(wkw > wkw2){
    cha = wkw - wkw2;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 1){
      $("#visual_s20230817569ed54963a8f .txt3").animate({
        "margin-left": "20px"
      },2000);
     
      $("#visual_s20230817569ed54963a8f .sec_link").animate({
        "margin-left" : "25px"
      },3000);
    }else if(jud == 3){
      $("#visual_s20230817569ed54963a8f .txt3").animate({
        "margin-left": "0px"
      },2000);
      $("#visual_s20230817569ed54963a8f .sec_link").animate({
        "margin-left" : "0px"
      },3000);

    }

    $("#visual_s20230817569ed54963a8f .txt_waku").animate({
      "width": wkw-cha+"px"
    },2000);
  }else{
    cha = wkw2 - wkw;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 2){

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
  // 이동은 1~3까지. 4가 되었다면 1로 변경
  if(jud == 4) jud = 1; 
  
  // 포커스 글자의 너비
  let wkw = $("#visual_s20230817569ed54963a8f .txt"+jud).width() + 20;

  // 애니메이션 효과 부여
  $("#visual_s20230817569ed54963a8f .txt_waku").css("animation-name","mmove"+jud);
  
  // 다음 이동대상의 너비를 알기위해 다음 번호를 지정.
  let judp = jud + 1;
  
  // 만약, 마지막 4번째라면 다음은 첫번째 블럭을 지정하기 위한 설정.
  if(jud == 3) judp= 1;
  let wkw2 = $("#visual_s20230817569ed54963a8f .txt"+judp).width() + 24;
  let cha = 0;
  
  // 다음 블럭의 너비와 비교해 어느쪽이 더 넒은지에 따라 계산법 적용 후 너비 적용.
  if(wkw > wkw2){
    cha = wkw - wkw2;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 1){
      $("#visual_s20230817569ed54963a8f .txt3").animate({
        "margin-left": "0px"
      },2000);
      $("#visual_s20230817569ed54963a8f .sec_link").animate({
        "margin-left" : "15px"
      },3000);

    }else if(jud == 3){
      $("#visual_s20230817569ed54963a8f .txt3").animate({
        "margin-left": "-10px"
      },2000);
      $("#visual_s20230817569ed54963a8f .sec_link").animate({
        "margin-left" : "0px"
      },3000);
    }

    $("#visual_s20230817569ed54963a8f .txt_waku").animate({
      "width": wkw-cha+"px"
    },2000);
  }else{
    cha = wkw2 - wkw;
    
    // 움직임에 맞춰 글자 이동.
    if(jud == 2){
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


function nextMove1(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:414, right:186},
      {top:594, right:-20},
      {top:705, right:7}
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 3,
    onComplete:nextMove2()
  });
}
function nextMove2(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:705, right:7},
      {top:888, right:-50},
      {top:993, right:187}
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 6,
    onComplete:nextMove3()
  });
}
function nextMove3(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:993, right:187},
      {top:1182, right:-20},
      {top:1284, right:7}
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 9,
    onComplete:nextMove4()
  });
}
function nextMove4(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:1284, right:7},
      {top:1394, right:-50},
      {top:1576, right:186}
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 12,
    onComplete:nextMove5()
  });
}
function nextMove5(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:1576, right:186},
      {top:1690, right:-20},
      {top:1863, right:7}
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 15,
    onComplete:nextRMove6()
  });
}
function nextRMove6(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:1863, right:7},
      {top:1690, right:-20},
      {top:1576, right:186},
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 18,
    onComplete:nextRMove5()
  });
}
function nextRMove5(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:1576, right:186},
      {top:1394, right:-50},
      {top:1284, right:7},
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 21,
    onComplete:nextRMove4()
  });
}
function nextRMove4(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:1284, right:7},
      {top:1182, right:-20},
      {top:993, right:187},
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 24,
    onComplete:nextRMove3()
  });
}
function nextRMove3(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:993, right:187},
      {top:888, right:-50},
      {top:705, right:7},
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 27,
    onComplete:nextRMove2()
  });
}
function nextRMove2(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:705, right:7},
      {top:594, right:-20},
      {top:414, right:186},
    ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 30,
    onComplete:nextRMove1()
  });
}
function nextRMove1(){
  TweenMax.to('.tweenbox', 2, {
    bezier: [
      {top:414, right:186},
      {top:300, right:-50},
      {top:117, right:9},
      ], 
    ease: Power1.easeInOut, 
    repeat: 0,
    delay: 33,
    
  });
}
