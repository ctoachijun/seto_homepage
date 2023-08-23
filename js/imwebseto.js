$(function () {
  
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

      $('#s20230817ca3bf1a224207 .service_div').each(function (i) {
        // console.log(i);
        var bottom_of_element = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();

        if (bottom_of_window > bottom_of_element) {
          $(this).animate({ 'opacity': '1' }, 1000);
        }
        
        if($(window).width() >= 768){
          // 좌측 여백 계산
          let yleft = ( $(window).width() - 1280 ) / 2;
          
          $(".fixed_left").css("position","fixed");
          $(".fixed_left").css("top","166px");
          $(".fixed_left").css("left",yleft+"px");
          
          let ybottom = $("#doz_footer_wrap").height() + $("#s20230809fbc185bfd069e").height() + $("#doz_header_wrap").height();
          let lbottom = $(window).height()-$(".fixed_left").offset().top+ $(".fixed_left").outerHeight();
          let main_height = $("main").height();
          let header_height = $("#doz_header_wrap").height();
          // console.log(main_height);
          // console.log(lbottom);
          // console.log(ybottom);
          let jbottom = $(window).height()-$("#w20230817b4f6d736d0f1b").offset().top+ $("#w20230817b4f6d736d0f1b").outerHeight();
          // console.log("----------");
        }
      });

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
    
})

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
