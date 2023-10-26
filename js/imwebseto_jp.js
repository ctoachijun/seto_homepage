$(function () {
    
    // 모바일인 경우, 메뉴 하단에 SNS 버튼 추가
    if(chkMobile()){
       let snsbtn = "<div class='sns_div'><a href='https://blog.naver.com/globalfunding'>BLOG</a>&middot;<a href='https://www.facebook.com/setoworks'>FACEBOOK</a></div>";
      $("#mobile_slide_menu ul .viewport-nav.mobile").append("<li class='depth-01'>"+snsbtn+"</li>");      
    }
    
    // HOME일때 실행
    if($("#s20231026efa7002b6af9b #visual_s20231026efa7002b6af9b").html()){
     
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
        breakpoints: {
          280:{
            slidesPerView:1,
            spaceBetween:10
          },
          765:{
            slidesPerView:2,
            spaceBetween:30,
          },
          991:{
            slidesPerView:3,
            spaceBetween:10,
          }
        }
      });
      
      // service 호버시 동작 (415 이상에서만)
      if(!chkMobile()){
        $(".service_div").on("mouseenter", function(index){
          $(this).find(".backblack").toggle();
          $(this).find(".txt_cont").toggle();
        });
        $(".service_div").on("mouseleave", function(){
          $(this).find(".backblack").toggle();
          $(this).find(".txt_cont").toggle();
        })
        $(".etc_div").on("mouseenter", function(index){
          $(this).find(".backblack").toggle();
          $(this).find(".txt_cont").toggle();
        });
        $(".etc_div").on("mouseleave", function(){
          $(this).find(".backblack").toggle();
          $(this).find(".txt_cont").toggle();
        })
      }

      
      // review 스와이퍼
      let rswiper = new Swiper(".review_wrap", {
        slidesPerView:2,
        centeredSlides: false,
        spaceBetween:30,
        loop:true,
        loopAdditionalSlides : 1,
        autoplay:{
          delay: 3000,
          disableOnInteraction:false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + "</span>";
          },
        },
        navigation:{
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          280:{
            slidesPerView:1,
            spaceBetween:10
          },
          765:{
            slidesPerView:2,
            spaceBetween:30,
          },
          992:{
            slidesPerView:2,
            spaceBetween:10,
          }
        }
      });
      
      // HOME 뉴스룸 제목
      let htitle,htxt,hbox;
      $("#w202310265ee522871e62b .type_grid.grid_02 .title").each(function(index){
        htxt = $(this).text().replace(/\t/g,'');
        hbox = htxt.split('\n');
        htitle = hbox[5];
        if(htitle.length > 42){
          htitle = htitle.substr(0,42)+'...';
        }
        $(this).html(htitle);
      })
      
    }else{
      // HOME 이외의 페이지에서 언어버튼 테두리
      $("#w2023102653f71ec1546bc .widget.inline_widget a i").css("border-top-color","#222222");
      $("#w2023102653f71ec1546bc .widget.inline_widget a").mouseenter(function(){
        $("#w2023102653f71ec1546bc .widget.inline_widget a i").css("border-top-color","#ff003b");
      })
      $("#w2023102653f71ec1546bc .widget.inline_widget a").mouseleave(function(){
        $("#w2023102653f71ec1546bc .widget.inline_widget a i").css("border-top-color","#222222");
      })
    }
    setFlowBanner();

    // 스크롤시 한번만 동작하기위한 변수
    let any = jum1 = false;

    // 스크롤시 이미지 등장
    $(window).scroll(function () {
      var bottom_of_window = $(window).scrollTop() + $(window).height();
      
      // 카운트 섹션의 html이 있는 경우에만 작업. offset top 때문에 에러나서 about 애니메이션이 동작 안함.
      if($("#s2023102635651c7f70681").html()){

        // 카운트 시작점을 위한 좌표구하기
        let count_top = $("#s2023102635651c7f70681").offset().top + $("#s2023102635651c7f70681").outerHeight() - 200;    
        
        // 모바일에서는 조금 더 일찍 시작하게..
        if($(window).width() <= 415) count_top -= 500;

        if(bottom_of_window > count_top && any === false){
            any = true;
  
            // HOME - 숫자 증가 
            const $mcounter = document.querySelector(".crow_money");
            const $pcounter = document.querySelector(".crow_cst");
            const $ucounter = document.querySelector(".crow_unit");
            let mmax = 19250;
            let fmax = 270;
            let umax = 650;
            setTimeout(() => counter2($mcounter, mmax), 50);
            setTimeout(() => counter3($pcounter, fmax), 50);
            setTimeout(() => counter($ucounter, umax), 50);
        }
        
        // HOME 화면이니 메일 다운 버튼 보이도록 처리
        if(bottom_of_window > 1100){
          $("#main_down").css("opacity","1");
          $("#main_down").css("background","rgba(100,100,100,0.6)");
        }else{
          $("#main_down").css("opacity","0");
        }
      }  
      
      // 상단 바로가기
      if(bottom_of_window > 3500){
        $("#w202310261a9dbacb1bf49").css("opacity","1");
        $("#w20231026dc1604ad79715").css("opacity","1");
        
      }else{
        $("#w202310261a9dbacb1bf49").css("opacity","0");
        $("#w20231026dc1604ad79715").css("opacity","0");
      }

    });

    // HOME 뉴스룸 게시판 클릭시 NEWS 메뉴의 상세로 연결하기
    $("#w202310265ee522871e62b .post_link_wrap").click(function(){
      let param = $(this).attr("href");
      let box = param.split('/');
      param = box[box.length-1];
      location.href="/news"+param;
      
      return false;
    })

        
    // SERVICE - 내비 버튼
    let garo_sum = 0;
    
    // 각 화면에서 내비 버튼이 왼쪽으로 붙어 나오게 처리
    if($("#w20231026a7673b8430dc9").html()){
        garo_sum += $("#w20231026a7673b8430dc9 > div > div > div > div:nth-child(1)").width();
      $("#w20231026a7673b8430dc9").scrollLeft(garo_sum);
    }
    if($("#w202310264826af54ae47f").html()){
      for(let i=1; i<=2; i++){
        garo_sum += $("#w202310264826af54ae47f > div > div > div > div:nth-child("+i+")").width();
      }
      $("#w202310264826af54ae47f").scrollLeft(garo_sum);
    }
    if($("#w20231026f62c4015ecb3e").html()){
      for(let i=1; i<=3; i++){
        garo_sum += $("#w20231026f62c4015ecb3e > div > div > div > div:nth-child("+i+")").width();
      }

      $("#w20231026f62c4015ecb3e").scrollLeft(garo_sum);
    }
    if($("#w2023102692c5a574d68b1").html()){
      for(let i=1; i<=4; i++){
        garo_sum += $("#w2023102692c5a574d68b1 > div > div > div > div:nth-child("+i+")").width();
      }

      $("#w2023102692c5a574d68b1").scrollLeft(garo_sum);
    }
    if($("#w20231026025947ddf7fc3").html()){
      for(let i=1; i<=5; i++){
        garo_sum += $("#w20231026025947ddf7fc3 > div > div > div > div:nth-child("+i+")").width();
      }

      $("#w20231026025947ddf7fc3").scrollLeft(garo_sum);
    }
    if($("#w20231026cb602ab778714").html()){
      for(let i=1; i<=6; i++){
        garo_sum += $("#w20231026cb602ab778714 > div > div > div > div:nth-child("+i+")").width();
      }

      $("#w20231026cb602ab778714").scrollLeft(garo_sum);
    }
    
    // SERVICE - 펀딩 PROCESS
    // 펀딩 모바일에서 클릭시 호버효과 나오게
    if($(window).width() < 991){
      $("#s202310265dc38a24c9271 .img_wrap").click(function(){
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
      $("#s20231026c433a1d49f492 .img_wrap").click(function(){
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
    
          
    // 크라우드펀딩 페이지 - 성공사례 클릭 시 이동처리
    // $("#w20231023da89eb360b0c8 .img_wrap").click(function(){
    //   location.href="/ourproject/?q=YToxOntzOjEyOiJrZXl3b3JkX3R5cGUiO3M6MzoiYWxsIjt9&bmode=view&idx=16562642&t=board";
    // })
    // $("#w202310234183caa13dbb3 .img_wrap").click(function(){
    //   location.href="/ourproject/?q=YToxOntzOjEyOiJrZXl3b3JkX3R5cGUiO3M6MzoiYWxsIjt9&bmode=view&idx=16562642&t=board";
    // })
    // $("#w20231023c0ff7baff2706 .img_wrap").click(function(){
    //   location.href="/ourproject/?q=YToxOntzOjEyOiJrZXl3b3JkX3R5cGUiO3M6MzoiYWxsIjt9&bmode=view&idx=16562642&t=board";
    // })
      
    
    
    // 피플 모바일에서 클릭시 호버효과 나오게
    if($(window).width() <= 991){
      $("#s20231026de4e42311740a .img_wrap").click(function(){
        if($(this).children(".txt._txt_wrap").css("display") == "none"){
          $(".txt._txt_wrap").css("display","block");
          $(".hover_overlay").css({
            "opacity" : "0"
          });
          $(".hover_img").css({
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
          });
          
          // 호버시 이미지 표시
          $(this).children(".hover_img").css({
            "opacity" : "1"
          });
        }
        
      })
      
      $("#s202310266939e0cb1a86d .img_wrap").click(function(){
        if($(this).children(".txt._txt_wrap").css("display") == "none"){
          $(".txt._txt_wrap").css("display","block");
          $(".hover_overlay").css({
            "opacity" : "0"
          });
          $(".hover_img").css({
            "opacity" : "0"
          });
          $(".hover_txt").css({
            "z-index" : "1",
            "opacity" : "0"
          })
        }else{
          $(".txt._txt_wrap").css({
            "display":"block",
            "visibility":"visible",
            "opacity":"1"
          });
          // 기존 nametag 부분 숨기기
          $(this).children(".txt._txt_wrap").css("display","none");
    
          // 호버시 배경 검은색
          $(this).children(".hover_overlay").css({
            "background" : "#000",
            "opacity" : "0.4"
          });
    
          //호버시 나오는 설명글
          $(this).children(".hover_txt").css({
            "z-index" : "10",
            "opacity" : "1"
          });
          
          // 호버시 이미지 표시
          $(this).children(".hover_img").css({
            "opacity" : "1"
          });
        }
        
      })
    }
    

    // PROJECT 에서만 동작
    if($("#s2023102667c2ed4ff2a59").html()){
      
      // 상세페이지에서는 상단 동영상 미노출 처리
      chkProjectParam();
      
      
      // 제목 띄어쓰기 세팅
      // 양쪽에 공백 추가 - 단어 추가시에는 , 구분으로 ""로 감싸서 단어를 입력하면 됩니다.
      let both_txt = new Array(
        "-","컨텐츠"
      )
      // 왼쪽에 공백 추가
      let left_txt = new Array(
        "팝업스토어","커머스"
      )
      // 오른쪽에 공백 추가
      let right_txt = new Array(
        "킥스타터","인디고고","젝젝","와디즈","마쿠아케","대만"
      )
        
      
      // 호버시가 아닌 그냥 있을때에도 정보 표시      
      $("#w20231026a86fd4b64aabe .card").each(function(index){
        
        // 카테고리 이름 세팅
        let cate_name = $(this).find(".title > span > em").html();
        cate_name = cate_name.replace("[","");
        cate_name = cate_name.replace("]","");
        $(this).find(".post_link_wrap").prepend("<div class='category_name'>"+cate_name+"</div>");
        
        let title_name = $(this).find(".title").text();
        let box = title_name.replace(/\s/g,"");
        let box2 = box.split("]");
        title_name = box2[1];
        
        // 각 이미지 세팅. 크라우드 펀딩일 경우 첫줄로 이미지를 판단. (에서 제목에서 단어 매칭으로 변경)
        let img_name = amount = "";
        
        if(cate_name == "글로벌 크라우드 펀딩"){
          
          // 첫줄없이 제목에서 단어 매칭
          // plf_arr에 들어가는 펀딩사이트 이름 순서와 img_arr에 들어가는 이미지 순서가 동일해야 합니다.
          let plf_arr = new Array("킥스타터", "인디고고", "젝젝", "와디즈", "마쿠아케");
          let img_arr = new Array(
            "https://setoworks.com/common/img/image_WorkBadge_Kickstarter.svg",
            "https://setoworks.com/common/img/image_WorkBadge_Indiegogo.svg",
            "https://setoworks.com/common/img/image_WorkBadge_Zeczec.svg",
            "https://setoworks.com/common/img/image_WorkBadge_Wadiz.svg",
            "https://setoworks.com/common/img/image_WorkBadge_Makuake.svg"
          )
          plf_arr.forEach(function(name, index){
            if(title_name.indexOf(name) > -1){
              img_name = img_arr[index];  
              return false;
            }
          })
          
        }else if(cate_name == "Global PreOrder"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_PreOrder.svg";
        }else if(cate_name == "Global ContentsMarketing"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_ContentsMarketing.svg";
        }else if(cate_name == "Global DigitalMarketing"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_DigitalMarketing.svg";
        }else if(cate_name == "Global Commerce"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_GlobalCommerce.svg";
        }else if(cate_name == "Exhibition / PopupStore"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_PopupStore.svg";
        }else if(cate_name == "Government-funded projects"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_ExportVoucher.svg";
        }else if(cate_name == "아마존"){
          img_name = "https://setoworks.com/common/img/image_WorkBadge_Amazon.svg";
        }else{
          
        }
        
        $(this).find(".post_link_wrap").append("<div class='title_div'><div class='img_row'><div class='title_img'><img src='"+img_name+"' alt=''></div><div class='amount'>"+amount+"</div></div><div class='title_name'>"+title_name+"</div></div>");
        
        
        // 제목 띄어쓰기 세팅
        let chgtxt;

        // 양쪽 공백 추가 처리
        both_txt.forEach(function(word){
          chgtxt = " "+word+" ";
          if(title_name.indexOf(word) > -1){
            title_name = title_name.replace(word,chgtxt);
          }
        })
        
        // 왼쪽 공백 추가 처리
        left_txt.forEach(function(word){
          chgtxt = " "+word;
          if(title_name.indexOf(word) > -1){
            title_name = title_name.replace(word,chgtxt);
          }
        })

        // 오른쪽 공백 추가 처리
        right_txt.forEach(function(word){
          chgtxt = word+" ";
          if(title_name.indexOf(word) > -1){
            title_name = title_name.replace(word,chgtxt);
          }
        })
        $(this).find(".title_div .title_name").text(title_name);
        
      })
    }

    // 입력폼 약관보기
    $(".viewgree").click(function(){
      // $(".chkbox .privacy_agree").toggle(500);
      SITE.openModalMenu('m20231016145073248d228', 'm202308173ce08e97ed747')
    })
    
    
    // NEWS 일때
    if($('#s202310262b8695359af9b').html()){
      
      // 상단배너, 본문, 내비버튼, 여백하나 숨김  
      chkNewsParam();
      
      // 제목 3줄 안가게 말줄임표 처리
      let title,txt,box;
      $("#w202310265240bf77458ec .type_grid.grid_02 .title").each(function(index){
        txt = $(this).text().replace(/\t/g,'');
        box = txt.split('\n');
        title = box[5];
        if(title.length > 42){
          title = title.substr(0,42)+'...';
        }
        $(this).html(title);
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
const counter2 = ($counter, max) => {
  // console.log(max);
  let now = max;
  const handle = setInterval(() => {
    // $counter.innerHTML = Math.ceil(max - now);
    let box = String(Math.ceil(max - now));
    box = box.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $counter.innerHTML = box;
      
    // 목표수치에 도달하면 정지
    if (now < 1) {
      clearInterval(handle);
    }
    
    // 증가되는 값이 계속하여 작아짐
    const step = now / 10;
    
    // 값을 적용시키면서 다음 차례에 영향을 끼침
    now -= step;
  }, 20);
}
const counter3 = ($counter, max) => {
  // console.log(max);
  let now = max;
  const handle = setInterval(() => {
    // $counter.innerHTML = Math.ceil(max - now);
    let box = String(Math.ceil(max - now));
    box = box.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $counter.innerHTML = box;
      
    // 목표수치에 도달하면 정지
    if (now < 1) {
      clearInterval(handle);
    }
    
    // 증가되는 값이 계속하여 작아짐
    const step = now / 10;
    
    // 값을 적용시키면서 다음 차례에 영향을 끼침
    now -= step;
  }, 35);
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
  // setInqForm(num);  
}

// 문의에 입력된 데이터를 기존 폼에 세팅 후 전송
function setContactFormData(num){
  let uname = $("input[name=contact_name]").val();
  let tel1 = $("input[name=tel1]").val();
  let tel2 = $("input[name=tel2]").val();
  let tel3 = $("input[name=tel3]").val();
  let uemail = $("input[name=contact_email]").val();
  let ucomp = $("input[name=contact_comp").val();
  // let chk1 = "N";
  let cont = $("#contact_cont").val();

  
  
  // 필수 체크
  // if(!ucomp){
  //   alert("회사명을 입력 해 주세요.");
  //   $("#contact_comp").focus();
  //   $(window).scrollTop($("#contact_comp").offset().top);
  //   return false;
  // }
  if(!uemail){
    alert("이메일을 입력 해 주세요.");
    $("#contact_email").focus();
    // $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }
  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (!re.test(uemail)) {
    alert("이메일 형식을 확인 해 주세요.");
    $("#contact_email").focus();
    // $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }
  if(!tel1){
    alert("연락처를 입력 해 주세요.");
    $("#tel1").focus();
    return false;
  }
  if(!tel2){
    alert("연락처를 입력 해 주세요.");
    $("#tel2").focus();
    return false;
  }
  if(!tel3){
    alert("연락처를 입력 해 주세요.");
    $("#tel3").focus();
    return false;
  }
  if(!uname){
    alert("이름을 입력 해 주세요.");
    $("#contact_name").focus();
    // $(window).scrollTop($("#contact_comp").offset().top);
    return false;
  }
  

  // 체크 된 값을 원래 폼의 체크박스에 체크하기
  // 유형
  // $("input[name=radio_1k2T3sr7E3]").each(function(index){
  //     if($(this).is(":checked")){
  //       chk1 = "Y";
  //     }
  // })
  
  // if(chk1 == "N"){
  //   alert("문의 유형을 선택 해 주세요.");
  //   return false;
  // }


  if(!$("#cprivacy").is(":checked")){
    alert("개인정보 수집/이용에 동의 해 주세요.");
    $(".checkbox.checkbox-styled input[type='checkbox']").prop("checked",false);
    return false;
  }else{
    $(".checkbox.checkbox-styled input[type='checkbox']").prop("checked",true);
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
  $("#input_text_area_820380Ls56").val(cont);
  
  if(num == 1){
    // 문의하기 위젯 ID 입니다.
    SITE_FORM.confirmInputForm('w20231026b672477e8c425','N');    
  }else if(num == 2){
    SITE_FORM.confirmInputForm('w202310265e600fd44c96c','N');
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
  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  let chk = chkbox_chk();

  if(uname && uemail && chk && re.test(uemail)){
    $(".down-btn").attr("disabled",true);
  }
  
  setTimeout(function(){
    SITE_FORM.confirmInputForm('w202310266ae216cf8d5c9','N');
  },1000);
  if(uname && uemail){

    if (re.test(uemail) && chk) {
      setTimeout(function(){
        window.open('about:blank').location.href="https://drive.google.com/file/d/1OVF4B17p8wNMNHxebYA3SrLRol_rSmTe/view?usp=sharing";
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
  // 뉴스레터 모달
  SITE.openModalMenu('m202310268e7726e1564db', 'm20231026ccccf53b60ab3')
}

function regNewsletter(num){
  let input_email = $("input[name=homemail").val();
  if(!input_email){
    alert("이메일 주소를 입력 해 주세요.");
    $("#newsmail").focus();
    return false;
  }
  
  let re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  if (!re.test(input_email)) {
    alert("이메일 주소 형식을 확인 해 주세요.");
    $("#newsmail").focus();
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
  $(".sendbtn").prop("disabled",true);
  
  // console.log(num);
  if(num == 1){
    SITE_FORM.confirmInputForm('w202310267acd2be84ef51','N');
  }else{
    SITE_FORM.confirmInputForm('w20231026b99d3aac170a8','N');
  }
}

function goPage(pg){
  location.href="/"+pg;
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

// PROJECT 동영상 클릭시 이동
function work_move(num){
  if(num == 1){
    location.href="/ourwork/?q=YToxOntzOjEyOiJrZXl3b3JkX3R5cGUiO3M6MzoiYWxsIjt9&bmode=view&idx=16274609&t=board";
  }else if(num == 2){
    location.href="/ourwork/?q=YToxOntzOjEyOiJrZXl3b3JkX3R5cGUiO3M6MzoiYWxsIjt9&bmode=view&idx=16568642&t=board";
  }else if(num == 3){
    location.href="/ourwork/?q=YToxOntzOjEyOiJrZXl3b3JkX3R5cGUiO3M6MzoiYWxsIjt9&bmode=view&idx=16341971&t=board";
  }
}

// PROJECT 포트폴리오 상세페이지에서는 헤드동영상 미노출처리
function chkProjectParam(){
  let url = new URL(location.href);
  let param = url.searchParams;
  let bidx = param.get('idx');  
  
  if(bidx){
    $("#w202310260c58f9ab9afae").css("display","none");
    $("#w20231026749e2475ad2a2").css("display","none");
    
    // 모바일
    if(chkMobile()){
      $("#s2023102647a6670a31574").css("display","none");
    }
    
  }else{
    $("#w202310260c58f9ab9afae").css("display","block");
    $("#w20231026749e2475ad2a2").css("display","block");
    
    // 모바일
    if(chkMobile()){
      $("#s202310250635fc354b3c8").css("display","block");
    }

    
  }
}

// 뉴스룸 상세페이지에서는 헤드동영상 미노출처리
function chkNewsParam(){
  let url = new URL(location.href);
  let param = url.searchParams;
  let bidx = param.get('idx');  
  
  if(bidx){
    $("#w202310267efae631586d4").css("display","none");
    $("#w20231026642910da77e83").css("display","none");
    $("#w20231026685857b012ac7").css("display","none");
    // 상단여백
    $("#w202310256f59fa22b1cd0").css("display","none");
  }else{
    $("#w202310267efae631586d4").css("display","block");
    $("#w20231026642910da77e83").css("display","block");
    $("#w20231026685857b012ac7").css("display","block");
    // 상단여백
    $("#w202310256f59fa22b1cd0").css("display","block");
  }
}