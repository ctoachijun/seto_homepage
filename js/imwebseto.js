$(function () {
    

    // nav바 배경
    // 메인 영역 호버시 배경,색상 변경
    $("#w2023090533b016edb5f36").mouseenter(function(){
        $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","rgba(0,0,0,0.4)");
        $("#w2023090533b016edb5f36 .plain_name").css("color","#fff");
        $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","#fff");
    })
    
    // 메인 영역에서 이탈시 배경,색상 복원
    $("#w2023090533b016edb5f36").mouseleave(function(){
        $("#s2023080800e57504dc655 .section_bg_color").css("backgroundColor","");
        $("#w2023090533b016edb5f36 .plain_name").css("color","");
        $("#dropdown_w2023090533b016edb5f36 .plain_name").css("color","");
    })

    
    // HOME일때 실행
    if($("#s20230817569ed54963a8f #visual_s20230817569ed54963a8f").html()){
     
      // 메인 텍스트 애니메이션 
      // 우선 첫번째 가로폭 설정. 넉넉하게 40 추가.
      // let wkw = $("#visual_s20230817569ed54963a8f .txt1").width() + 40;
      // $("#visual_s20230817569ed54963a8f .txt_waku").css("width",wkw);
      
      // let left_pok;
      
      // // 1~4까지 루프 판단을 위한 변수.
      // let jud = 1;

      // // 일정 시간마다 테두리 이동. 단, 766 사이즈 이상에서만.
      // if($(window).width() > 415){
      //   setInterval( ()=>{      
      //     moveWaku(jud);
      //     jud++;
      //     if(jud == 4) jud = 1;
      //   },3000);
      // }
      // // 모바일 사이즈. 메인 글자 크기와 사이즈가 다르므로 별도 동작
      // if($(window).width() <= 415){
      //   $("#visual_s20230817569ed54963a8f .txt_waku").css("width",wkw-20);
      //   setInterval( ()=>{      
      //     moveWakuMobi(jud);
      //     jud++;
      //     if(jud == 4) jud = 1;
      //   },3000);
      // }
      
      
      // service 슬라이드
      let sswiper = new Swiper(".sslide_cont", {
        slidesPerView:3,
        centeredSlides: false,
        spaceBetween:30,
        loop:false,
        navigation:{
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        on:{
          reachEnd: function(){
          }
        }
    });

      // swiper.mousewheel.enable();
      
            
      // 파트너스 클릭처리
      if(chkMobile()){
        $("#s202309062f95dfb0d65e7 .img_wrap").click(function(){
          $("#s202309062f95dfb0d65e7 .img_wrap img").css("opacity","1");
          $("#s202309062f95dfb0d65e7 .img_wrap .hover_img").css("opacity","0");
          $(this).children("img").css("opacity","0");
          $(this).children(".hover_img").css("opacity","1");
        });
        $("#s20230926bea3aa6cc25a8 .img_wrap").click(function(){
          $("#s20230926bea3aa6cc25a8 .img_wrap img").css("opacity","1");
          $("#s20230926bea3aa6cc25a8 .img_wrap .hover_img").css("opacity","0");
          $(this).children("img").css("opacity","0");
          $(this).children(".hover_img").css("opacity","1");
        });
      }
      
      // 클라이언트 스크롤링
      setFlowBanner();

      
      
    }


    // 스크롤시 한번만 동작하기위한 변수
    let any = jum1 = false;

    // 스크롤시 이미지 등장
    $(window).scroll(function () {
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      
      // 카운트 섹션의 html이 있는 경우에만 작업. offset top 때문에 에러나서 about 애니메이션이 동작 안함.
      if($("#s20230906862a64f70b718").html()){
        // 카운트 시작점을 위한 좌표구하기
        let count_top = $("#s20230906862a64f70b718").offset().top + $("#s20230906862a64f70b718").outerHeight() - 200;    
        // console.log(bottom_of_window);
        // console.log(count_top);
        // console.log("-----------------");
  
        
        if(bottom_of_window > count_top && any === false){
            any = true;
  
            // HOME - 숫자 증가 
            const $mcounter = document.querySelector(".crow_money");
            const $pcounter = document.querySelector(".crow_exp");
            const $ucounter = document.querySelector(".crow_unit");
            let mmax = 240;
            let pmax = 370;
            let umax = 600;
            setTimeout(() => counter($mcounter, mmax), 50);
            setTimeout(() => counter($pcounter, pmax), 50);
            setTimeout(() => counter($ucounter, umax), 50);
        }
      }  
      
      // 회사소개서 버튼 투명처리 및 복원처리(가로폭 별 별도지정)
      if($(window).width() > 991){
        if(bottom_of_window > 1000){
          $("#main_down").css("background","rgba(100,100,100,0.6)");
        }else{
          $("#main_down").css("background","#060000");
        }
      }else if($(window).width() < 992){
        if(bottom_of_window > 850){
          $("#main_down").css("background","rgba(100,100,100,0.6)");
        }else{
          $("#main_down").css("background","#060000");
        }
      }
      
      // 상단 바로가기
      if(bottom_of_window > 3500){
        $("#w20230825d156046a1b84d").css("opacity","1");
        $("#w20230914dc538db5a14fa").css("opacity","1");
        
      }else{
        $("#w20230825d156046a1b84d").css("opacity","0");
        $("#w20230914dc538db5a14fa").css("opacity","0");
      }
      
      
      // ABOUT 애니메이션 스타트
      let about_top = $("#s202309210bb5ee44410ad").offset().top;
      // console.log(bottom_of_window);
      // console.log(about_top);
      // console.log("-----------------");

      if(about_top <= bottom_of_window){
        if($(window).width() < 600){
          // ABOUT 애니메이션
          $("#about_div .left_div").css("animation-name","mleft-move");
          $("#about_div .right_div").css("animation-name","mright-move");
        }else{
          // ABOUT 애니메이션
          $("#about_div .center_div").css("animation-name","center-move");
          $("#about_div .right_div").css("animation-name","right-move");
        }
      }
      
      
      
      
    });

    // HOME 뉴스룸 게시판 클릭시 무효화
    $("#w2023091254e53d77f1943 .post_link_wrap").click(function(){
      location.href="/about?#w2023091229ebe142df7ae";
      return false;
    })

        
    // SERVICE - 내비 버튼
    let garo_sum = 0;
    if($("#w20231005a2428ce56e89b").html()){
        garo_sum += $("#w20231005a2428ce56e89b > div > div > div > div:nth-child(1)").width();
      $("#w20231005a2428ce56e89b").scrollLeft(garo_sum);
    }
    if($("#w20231005dafb1b8885a94").html()){
      for(let i=1; i<=2; i++){
        garo_sum += $("#w20231005dafb1b8885a94 > div > div > div > div:nth-child("+i+")").width();
        console.log(i+"번째 "+$("#w20231005dafb1b8885a94 > div > div > div > div:nth-child("+i+")").width());
      }
      console.log("sum = "+garo_sum);
      $("#w20231005dafb1b8885a94").scrollLeft(garo_sum);
    }
    if($("#w202310053a8927cd30a6e").html()){
      for(let i=1; i<=3; i++){
        garo_sum += $("#w202310053a8927cd30a6e > div > div > div > div:nth-child("+i+")").width();
        console.log(i+"번째 "+$("#w202310053a8927cd30a6e > div > div > div > div:nth-child("+i+")").width());
      }
      console.log("sum = "+garo_sum);

      $("#w202310053a8927cd30a6e").scrollLeft(garo_sum);
    }
    if($("#w202310053fd982aa0756f").html()){
      for(let i=1; i<=4; i++){
        garo_sum += $("#w202310053fd982aa0756f > div > div > div > div:nth-child("+i+")").width();
        console.log(i+"번째 "+$("#w202310053fd982aa0756f > div > div > div > div:nth-child("+i+")").width());
      }
      console.log("sum = "+garo_sum);

      $("#w202310053fd982aa0756f").scrollLeft(garo_sum);
    }
    if($("#w20231005c0c327c28fc53").html()){
      for(let i=1; i<=5; i++){
        garo_sum += $("#w20231005c0c327c28fc53 > div > div > div > div:nth-child("+i+")").width();
        console.log(i+"번째 "+$("#w20231005c0c327c28fc53 > div > div > div > div:nth-child("+i+")").width());
      }
      console.log("sum = "+garo_sum);

      $("#w20231005c0c327c28fc53").scrollLeft(garo_sum);
    }
    if($("#w202310055922395b48388").html()){
      for(let i=1; i<=6; i++){
        garo_sum += $("#w202310055922395b48388 > div > div > div > div:nth-child("+i+")").width();
        console.log(i+"번째 "+$("#w202310055922395b48388 > div > div > div > div:nth-child("+i+")").width());
      }
      console.log("sum = "+garo_sum);

      $("#w202310055922395b48388").scrollLeft(garo_sum);
    }
    
    // SERVICE - 펀딩 PROCESS
    // 펀딩 모바일에서 클릭시 호버효과 나오게
    if($(window).width() < 991){
      $("#s20230921030b17bf29cb1 .img_wrap").click(function(){
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
      
      // 프리오더 PROCESS
      $("#s20230921cc07d9d02f270 .img_wrap").click(function(){
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
          // console.log(plf+"/"+amount);
          
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
// 유형 클릭시 라디오버튼 세팅
function chk_tgroup(num){
  let rclass = "rtype"+num;
  $("."+rclass).prop("checked",true);
  $(".chk_tgroup").removeClass("active");
  $(".chk_tgroup:nth-of-type("+num+")").addClass("active");

  // 기존 입력폼 라디오버튼에 바로 체크 처리.
  let now;
  $("input[name=radio_1k2T3sr7E3]").each(function(index){
    now = num-1;
    if(now == index){
      $(this).prop("checked",true);
    }
  })
  setInqForm(num);  
}

// 문의하기 양식 세팅
function setInqForm(num){
  let txt;
  
  txt = "아래 양식에 맞게 입력 해 주세요.\n\n";
  if(num == 1){
    txt += "제품명 : \n타겟 국가 : \n참고 URL : \n내용 : \n";
  }else if(num == 2){
    txt += "제품명 : \n타겟 국가 : \n예상 광고비용 : \n내용 : \n";
  }else if(num == 3){
    txt += "제품명 : \n타겟 국가 : \n예상 광고비용 : \n내용 : \n";
  }else if(num == 4){
    txt += "제품명 : \n타겟 국가 : \n예상 광고비용 : \n내용 : \n";
  }else if(num == 5){
    txt += "제품명 : \n희망 플랫폼 : \n참고 URL : \n내용 : \n";
  }else if(num == 6){
    txt += "제품명 : \n타겟 국가 : \n예산 : \n내용 : \n";
  }else if(num == 7){
    txt += "희망지원사업 : \n목적 : \n내용 : \n";
  }else if(num == 8){
    txt += "제품명 : \n내용 : \n";
  }
  
  $("#contact_cont").val(txt);
}


// 문의에 입력된 데이터를 기존 폼에 세팅 후 전송
function setContactFormData(num){
  let uname = $("input[name=contact_name]").val();
  let tel1 = $("input[name=tel1]").val();
  let tel2 = $("input[name=tel2]").val();
  let tel3 = $("input[name=tel3]").val();
  let uemail = $("input[name=contact_email]").val();
  let ucomp = $("input[name=contact_comp").val();
  // let uboon = $("#contact_boon").val();
  let chk1 = "N";
  let cont = $("#contact_cont").val();

  
  
  // 필수 체크
  if(!ucomp){
    alert("회사명을 입력 해 주세요.");
    $("#contact_comp").focus();
    $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }
  if(!uname){
    alert("이름을 입력 해 주세요.");
    $("#contact_name").focus();
    $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }
  if(!uemail){
    alert("이메일을 입력 해 주세요.");
    $("#contact_email").focus();
    $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }
  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (!re.test(uemail)) {
    alert("이메일 형식을 확인 해 주세요.");
    $("#contact_email").focus();
    $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }


  // if( !tel1 ){
  //   alert("연락처를 입력 해 주세요.");
  //   $("#tel1").focus();
  //   $(window).scrollTop($("#contact_comp").offset().top);
  //   return false;
  // }
  // if( !tel2 ){
  //   alert("연락처를 입력 해 주세요.");
  //   $("#tel2").focus();
  //   $(window).scrollTop($("#contact_comp").offset().top);
  //   return false;
  // }
  // if( !tel3 ){
  //   alert("연락처를 입력 해 주세요.");
  //   $("#tel3").focus();
  //   $(window).scrollTop($("#contact_comp").offset().top);
  //   return false;
  // }
  

  // 체크 된 값을 원래 폼의 체크박스에 체크하기
  // 유형
  $("input[name=radio_1k2T3sr7E3]").each(function(index){
      if($(this).is(":checked")){
        chk1 = "Y";
        console.log("체크한게 있음!");
      }
  })
  
  if(chk1 == "N"){
    alert("문의 유형을 선택 해 주세요.");
    return false;
  }
  
  if(!$("#privacy").prop("checked")){
    alert("개인정보 수집/이용에 동의 해 주세요.");
    $("input[name='checkbox_A1Q8az4o3f[]']").prop("checked",false);
    return false;
  }else{
    $("input[name='checkbox_A1Q8az4o3f[]']").prop("checked",true);
  }
  
  if(!$("#marketing").prop("checked")){
    $("input[name='checkbox_4O1WT92x80[]'").prop("checked",false);
  }else{
    $("input[name='checkbox_4O1WT92x80[]'").prop("checked",true);
  }  
  
  $(".regbtn").prop("disabled",true);
  // 각 항목 세팅
  $("#input_txt_X3xXA267i9").val(ucomp);
  $("#input_txt_67eccd2dc4655").val(uname);
  $("input[name=phonenumber1_b0f51fbf67589]").val(tel1);
  $("input[name=phonenumber2_b0f51fbf67589]").val(tel2);
  $("input[name=phonenumber3_b0f51fbf67589]").val(tel3);
  $("#input_email_K33b013KUJ").val(uemail);
  // $("#input_select_71w7e352f3").val(uboon);
  $("#input_text_area_820380Ls56").val(cont);
  
  
  if(num == 1){
    SITE_FORM.confirmInputForm('w20230922d39e998c04ab7','N');
  }else if(num == 2){
    SITE_FORM.confirmInputForm('w20231006357cc284b6fb4','N');    
  }
  
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
  
  $(".down-btn").attr("disabled",true);
  setTimeout(function(){
    SITE_FORM.confirmInputForm('w20230831f65b974c1a11c','N');
  },1000);
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
        "margin-left": "20px",
      },2000);
      $("#visual_s20230817569ed54963a8f .txt1").css("animation-name","nogradient");
      $("#visual_s20230817569ed54963a8f .txt2").css("animation-name","gradient");
      
      
      $("#visual_s20230817569ed54963a8f .sec_link").animate({
        "margin-left" : "25px"
      },3000);
    }else if(jud == 3){
      
      $("#visual_s20230817569ed54963a8f .txt3").css("animation-name","nogradient");
      $("#visual_s20230817569ed54963a8f .txt1").css("animation-name","gradient");
      
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
    $("#visual_s20230817569ed54963a8f .txt2").css("animation-name","nogradient");
    $("#visual_s20230817569ed54963a8f .txt3").css("animation-name","gradient");
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
      $("#visual_s20230817569ed54963a8f .txt1").css("animation-name","nogradient");
      $("#visual_s20230817569ed54963a8f .txt2").css("animation-name","gradient");

      
      $("#visual_s20230817569ed54963a8f .sec_link").animate({
        "margin-left" : "15px"
      },3000);

    }else if(jud == 3){
      $("#visual_s20230817569ed54963a8f .txt3").animate({
        "margin-left": "-10px"
      },2000);
      $("#visual_s20230817569ed54963a8f .txt3").css("animation-name","nogradient");
      $("#visual_s20230817569ed54963a8f .txt1").css("animation-name","gradient");

      
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
    $("#visual_s20230817569ed54963a8f .txt2").css("animation-name","nogradient");
    $("#visual_s20230817569ed54963a8f .txt3").css("animation-name","gradient");

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


// HOME - 파트너 섹션 전환
function chgPartner(num){
  let ow;
  if($(window).width() <= 415){
    ow = 180;
  }else{
    ow = 215;
  }
  
  if(num == 1){
    $("#s202309062f95dfb0d65e7").css("display","block");
    $("#s20230926bea3aa6cc25a8").css("display","none");
  }else{
    $("#s202309062f95dfb0d65e7").css("display","none");
    $("#s20230926bea3aa6cc25a8").css("display","block");
    $("#s20230926bea3aa6cc25a8 .img_wrap").css("height","auto");
    $("#s20230926bea3aa6cc25a8 img").css({
      "width":ow,
      "height":"100%",
      "margin":"3.3px 0px"
    });
    
    let ih = $("#s20230926bea3aa6cc25a8 img").css("height");
    let iw = $("#s20230926bea3aa6cc25a8 img").css("width");
    console.log(iw);
    console.log(ih);
    $("#s20230926bea3aa6cc25a8 .hover_img").css({
      "width":iw,
      "height":ih,
      "margin":"3.3px 0px"
    });
  }
}

// 모바일 체크
function chkMobile(){
  let isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
  return isMobile;
}


// 물흐르듯 로고 흘려버리는 jquery 
function setFlowBanner(){
  let wrap = $("#home_client");
  let list = $(".client_cont");
  let wrapWidth = wrap.width();
  let listWidth = list.width();
  let speed = 92;
  
  let clone = list.clone();
  wrap.append(clone);
  flowBannerAct();
  
  function flowBannerAct(){
    if(listWidth < wrapWidth){
      const listCount = Math.ceil(wrapWidth * 2 / listWidth);
      for(let i = 2;i < listCount; i++){
        clone = clone.clone();
        wrap.append(clone);
      }
    }
    let sp = listWidth / speed;
    wrap.find(".client_cont").css({
      'animation': sp+"s linear infinite flowRolling"
    })
  }
  // 마우스가 요소 위로 진입했을 때 일시정지
  wrap.on('mouseenter', function () {
    wrap.find('.client_cont').css('animation-play-state', 'paused');
  });

  // 마우스가 요소에서 빠져나갈 때 재생
  wrap.on('mouseleave', function () {
      wrap.find('.client_cont').css('animation-play-state', 'running');
  });
}


