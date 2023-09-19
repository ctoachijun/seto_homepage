function chkSpaceFe(obj){
  let id = obj.id;
  let val = obj.value;
  val = val.replace(/(^\s+)|(\s*$)/gi,"");

  $("#"+id).val(val);
}


function editSaengsan(){
  if(confirm("생산성을 적용 하시겠습니까?")){
    let cnt = $("input[name=ss_count").val();
    
    let arr_count = new Array();
    let arr_amount = new Array();
    
    let count,amount;
    for(let i=1; i<=cnt; i++){
      count = $("input[name=ss_count"+i+"]").val();
      arr_count.push(count);
      amount = $("input[name=ss_amount"+i+"]").val();
      arr_amount.push(amount);
    }
    let count_txt = arr_count.join("|");
    let amount_txt = arr_amount.join("|");
    
    $.ajax({
      url : "ajax_webapp.php",
      type: "post",
      data: {"w_mode":"editSeangsan","count":count_txt,"amount":amount_txt,"cnt":cnt},
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);

        if(json.state == "N"){
          alert("시스템 에러입니다.");
          return false;
        }else{
          alert("적용 했습니다.");
          history.go(0);
        }
      }
    })
  }
}


function addStep(){
  let name = $("input[name=step_name").val();
  let sdate = $("input[name=step_month").val();
  
  if(!name){
    alert("이름을 입력 해 주세요.");
    return false;
  }
  if(!sdate){
    alert("시작일을 입력 해 주세요.");
    return false;
  }

  $.ajax({
    url : "ajax_webapp.php",
    type: "post",
    data: {"w_mode":"addStep","name":name,"date":sdate},
    success: function(result){
      let json = JSON.parse(result);
      console.log(json);
      
      if(json.state == "N"){
        alert("시스템 에러입니다.");
        return false;
      }else{
        history.go(0);
      }
    }
  })
}

function editStep(idx){
  if(confirm("수정 하시겠습니까?")){
    let name = $("#name"+idx).val();
    let date = $("#date"+idx).val();
    
    $.ajax({
      url : "ajax_webapp.php",
      type: "post",
      data: {"w_mode":"editStep","idx":idx,"name":name,"date":date},
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        if(json.state == "N"){
          alert("시스템 에러입니다.");
          return false;
        }else{
          alert("수정 했습니다.");
          history.go(0);
        } 
      }
    })
  }
}

function delStep(idx){
  let name = $("#name"+idx).val();
  let date = $("#date"+idx).val();

  if(confirm(name+"을 삭제 하시겠습니까?")){
    
    $.ajax({
      url : "ajax_webapp.php",
      type: "post",
      data: {"w_mode":"delStep","idx":idx,"name":name,"date":date},
      success: function(result){
        let json = JSON.parse(result);
        console.log(json);
        
        if(json.state == "N"){
          alert("시스템 에러입니다.");
          return false;
        }else{
          alert("삭제 했습니다.");
          history.go(0);
        } 
      }
    })
  }
}

function downExcel(){
  let count = $("input[name=sumcnt").val();
  let amount = $("input[name=sumamt").val();
  let toyear = $("input[name=years").val();


  $("form").attr("action","downExcel.php");
  // $("#exp1").append("<form name='sumform' action='downExcel.php' method='post'></form>");
  // $("form").append("<input type='hidden' name='sums_cnt' value='"+count+"'>");
  // $("form").append("<input type='hidden' name='sums_amt' value='"+amount+"'>");
  // $("form").append("<input type='hidden' name='toyear' value='"+toyear+"'>");
  $("form").submit();
}

function searchDate(){
  let start = $("input[name=sstart").val();
  let end = $("input[name=send").val();
  
  location.href="./exp_part1.php?sstart="+start+"&send="+end;
}

