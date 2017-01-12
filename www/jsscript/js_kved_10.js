function submitForm(mode) {
		correct = true;
		form = document.forms['adminForm'];
		if (correct) {
			form.mode.value = mode;
			form.submit();
		}
	}


function cleanFormAdd() {
  document.getElementById('nameAdd').value="";
  document.getElementById('anableAdd').checked=false;
  document.getElementById('pathAdd').value="";
  var list=document.getElementById('parentElementAdd');
  list.selectedIndex=0;
  printErrorMessage('errorFormMenuAdd',"");
}


function loadKved() {
	var forms= new FormData(document.getElementById("adminForm"));
	forms.append("action","load");
	showPopup("progressDisplay");
	var myVar = setInterval(function() {
			ls_ajax_progress();
	}, 1000);
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\kved10Function.php",
			 data: forms,
			 scriptCharset: "CP1251",
			 processData: false,
  	 	 contentType: false ,
			 success: function(data){
				clearInterval(myVar);
				showOffPopup("progressDisplay");
				}
		});
}

function ls_ajax_progress() {
	var progress = document.getElementById('progressbar');
	var progressStr = document.getElementById('progress_value');
		$.ajax({
				type: 'POST',
				url: "\\logic\\jsonScript\\readLoad.php",
				success: function(data) {
					progress.value=Math.round(data);
					progressStr.innerHTML=data+"%";
				},
		});
}



function updateLists(strAdd, strSelect) {
	var list=document.getElementById('parentElementAdd');
	list.innerHTML=strAdd;
	var list=document.getElementById('mainMenuS');
	list.innerHTML=strSelect;
}

function fillTableMenu(arr){
  var table = document.getElementById("tableMenu");
  var htmlTable="";
  table.innerHTML="";
  htmlTable+="<tr><th>&nbsp;</th><th>Назва</th><th>Шлях перенаправлення</th>"
		+"<th>Батьківський елемент</th><th>Видимість</th></tr>";
  for(var i=0;i<arr.length;i++){
    htmlTable+="<tr id=\"r_"+arr[i].id+"\">";
		htmlTable+="<td> <input name=\"checkFlag\" id=\""+arr[i].id+"\"  type=\"checkbox\" onChange=\"delCheck('"+arr[i].id+"');\"> </td>";
		htmlTable+="<td><input style=\" width:100%; text-align:center; \" type=\"text\" id=\"name_"+arr[i].id+"\"  value=\""+arr[i].name+"\" onChange=\"onChangeData('"+arr[i].id+"');\"  ></td>";
		htmlTable+="<td><input style=\" width:100%; text-align:center; \" type=\"text\" id=\"path_"+arr[i].id+"\"  value=\""+arr[i].path+"\" onChange=\"onChangeData('"+arr[i].id+"');\"  ></td>";
		htmlTable+="<td><select style=\" width:100%; text-align:center;\" id=\"parent_"+arr[i].id+"\" onChange=\"onChangeData('"+arr[i].id+"');\" >"+arr[i].perent+"</select></td>";
		htmlTable+="<td><input type=\"checkbox\" id=\"avaible_"+arr[i].id+"\" onChange=\"onChangeData('"+arr[i].id+"');\" "+((+arr[i].enables==1)?"checked":'')+"  ></td>";
		htmlTable+="</tr>";
  }
  table.innerHTML=htmlTable;
}

function onChangeData(id){
  if(document.getElementById("delBtn").disabled==true){
    var arr = document.getElementsByName("checkFlag");
    var count=1;
    document.getElementById("r_"+id).className="selectedRaw";
    for(var i=0;i<arr.length;i++){
      if(arr[i].checked){
        count++;
      }
    }
    if(count>0){
      document.getElementById("saveBtn").disabled=false;
    }else{
      document.getElementById("saveBtn").disabled=true;
    }
  }
  checkedProcess(id);
}

function delCheck(id) {
  if(document.getElementById("saveBtn").disabled==true){
    var arr = document.getElementsByName("checkFlag");
    var count = 0;
    for(var i=0;i<arr.length;i++){
      if(arr[i].getAttribute("id")==id){
        if(arr[i].checked!=true){
          document.getElementById("r_"+id).className="";
        }else{
          document.getElementById("r_"+id).className="delRaw";
          count++;
          continue;
        }
      }
      if(arr[i].checked==true){
        count++;
      }
    }
    if(count>0){
      for(var i=0;i<arr.length;i++){
        setDisabled(arr[i].getAttribute("id"));
      }
      document.getElementById("delBtn").disabled=false;
    }else{
      for(var i=0;i<arr.length;i++){
        delDisabled(arr[i].getAttribute("id"));
      }
      document.getElementById("delBtn").disabled=true;
    }
  }else{
    var arr = document.getElementsByName("checkFlag");
    var count = 0;
    for(var i=0;i<arr.length;i++){
      if(arr[i].checked==true){
        count++;
      }
      if(arr[i].getAttribute("id")==id){
        if(arr[i].checked && document.getElementById("r_"+id).className=="changeRaw"){
          document.getElementById("r_"+id).className="selectedRaw";
        }else{
          if(document.getElementById("r_"+id).className!="" && !arr[i].checked){
            document.getElementById("r_"+id).className="changeRaw";
          }else if(document.getElementById("r_"+id).className=="") {
            arr[i].checked=false;
          }
        }
      }
    }
  }
}

function checkedProcess(id) {
  var arr = document.getElementsByName("checkFlag");
  for(var i=0;i<arr.length;i++){
    if(arr[i].getAttribute("id")==id){
      arr[i].checked = true;
    }
  }
}

function setDisabled(id) {
  var arr = ["kat_","kod_","n_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).setAttribute("disabled", "disabled");
  }
}

function delDisabled(id) {
  var arr = ["kat_","kod_","n_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).removeAttribute("disabled");
  }
}

function delMenuAction() {
  var arr=getIdSelectedForDel();
  var text="Ви впевнені в тому що хочете видалити "+arr.length+" пунтк(тів)?";
  if(confirm(text)){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\menuFunction.php",
			 data: {"action":"Del","arrId":arr},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
         printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorForMenuUpdate',res.error);
          }else{
            fillTableMenu(res.select);
						updateLists(res.listMainMenuAdd,res.listMainMenuSelect);
            document.getElementById('delBtn').disabled=true;
          }
				}
		});
  }
}

function updateAction() {
  var arr=getItemSelectedForUpdate();
	var text="Ви впевнені в тому що хочете оновити дані для "+arr.length+" записів ?";
  if(confirm(text)){
	 var forms= new FormData(document.getElementById("adminForm"));
	 forms.append("action","Update");
	 forms.append("ArrId",JSON.stringify(arr));
	 showPopup("progressDisplay");
	 var myVar = setInterval(function() {
			 ls_ajax_progress();
	 }, 1000);
		$.ajax({
				type: "POST",
				url: "\\logic\\jsonScript\\kved10Function.php",
				data: forms,
				scriptCharset: "CP1251",
				processData: false,
				contentType: false ,
				success: function(data){
				 var res = JSON.parse(data);
         /*printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorForMenuUpdate',res.error);
          }else{
            fillTableMenu(res.select);
						updateLists(res.listMainMenuAdd,res.listMainMenuSelect);
            document.getElementById('saveBtn').disabled=true;
          }*/
				}
		});
  }
}

function getIdSelectedForDel() {
  var arr = document.getElementsByName("checkFlag");
  var arrSelected=[];
  for (var i = 0; i < arr.length; i++) {
    if(arr[i].checked){
      arrSelected.push(arr[i].id);
    }
  }
  return arrSelected;
}

function getItemSelectedForUpdate() {
  var arr = document.getElementsByName("checkFlag");
  var arrSelected=[];
  var arrField = ["kat_","kod_","n_"];
  for (var i = 0; i < arr.length; i++) {
    if(arr[i].checked){
      var ItemContent=[];
      var id=arr[i].id;
      for(var j=0;j<arrField.length;j++){
        var name=arrField[j];
        ItemContent[j]=document.getElementById(arrField[j]+id).value;
      }
      ItemContent[arrField.length]=id;
      arrSelected.push(ItemContent);
    }
  }
  return arrSelected;
}
