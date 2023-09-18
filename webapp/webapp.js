function chkSpaceFe(obj){
  let id = obj.id;
  let val = obj.value;
  val = val.replace(/(^\s+)|(\s*$)/gi,"");

  $("#"+id).val(val);
}


function editSaengsan(){
  if(confirm("생산성을 적용 하시겠습니까?")){
    let cnt = $("input[name=ss_count").val();
    
    let arr_val = new Array();
    let val;
    for(let i=1; i<=cnt; i++){
      val = $("input[name=ss_value"+i+"]").val();
      arr_val.push(val);
    }
    let val_txt = arr_val.join("|");
    
    $.ajax({
      url : "ajax_webapp.php",
      type: "post",
      data: {"w_mode":"editSeangsan","data":val_txt},
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
  let value = $("input[name=sumsum").val();
  let toyear = $("input[name=years").val();
  
  $("#exp1").append("<form name='sumform' action='downExcel.php' method='post'></form>");
  $("form").append("<input type='hidden' name='sums' value='"+value+"'>");
  $("form").append("<input type='hidden' name='toyear' value='"+toyear+"'>");
  $("form").submit();
}