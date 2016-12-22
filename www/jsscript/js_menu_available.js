function submitForm(mode) {
		correct = true;
		form = document.forms['adminForm'];
		if (correct) {
			form.mode.value = mode;
			form.submit();
		}
	}


function cleanFormAdd() {
  document.getElementById('menuItemAdd').selectedIndex=0;
	document.getElementById('departmentItemAdd').selectedIndex=0;
  printErrorMessage('errorFormMenuAdd',"");
}

function getSelectListElement(id) {
	var list=document.getElementById(id);
  return list.options[list.selectedIndex].value;
}

function menuAdd() {
  var selectMenuElement = getSelectListElement('menuItemAdd');
  var selectDepartmentElement = getSelectListElement('departmentItemAdd');

  if(selectMenuElement!="0"){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\menuAvailableFunction.php",
			 data: {"action":"Add","menuID":selectMenuElement ,"departmentID":selectDepartmentElement},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
				 printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorFormMenuAdd',res.error);
          }else{
            fillTableMenu(res.select);
            cleanFormAdd();
          }
				}
		});
  }else{
    var errStr="";
    if(name==""){
      errStr+="Необхідно обрати пункт меню для якого додаэться дозвіл.<br>";
    }
    printErrorMessage('errorFormMenuAdd',errStr);
  }
}


function fillTableMenu(arr){
  var table = document.getElementById("tableMenu");
  var htmlTable="";
  table.innerHTML="";
  htmlTable+="<tr><th>&nbsp;</th><th>Назва</th><th>Шлях перенаправлення</th>"
		+"<th>Відділ</th></tr>";
  for(var i=0;i<arr.length;i++){
    htmlTable+="<tr id=\"r_"+arr[i].id+"\">";
		htmlTable+="<td> <input name=\"checkFlag\" id=\""+arr[i].id+"\"  type=\"checkbox\" onChange=\"delCheck('"+arr[i].id+"');\"> </td>";
		htmlTable+="<td style=\"padding:0 8px 0 8px;\">"+arr[i].name+"</td>";
		htmlTable+="<td>"+arr[i].path+"</td>";
		htmlTable+="<td><select style=\" width:100%; text-align:center;\" id=\"dep_"+arr[i].id+"\" onChange=\"onChangeData('"+arr[i].id+"');\" >"+arr[i].department+"</select></td>";
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
    document.getElementById("dep_"+id).setAttribute("disabled", "disabled");
}

function delDisabled(id) {
    document.getElementById("dep_"+id).removeAttribute("disabled");
}

function delMenuAction() {
  var arr=getIdSelectedForDel();
  var text="Ви впевнені в тому що хочете видалити "+arr.length+" пунтк(тів)?";
  if(confirm(text)){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\menuAvailableFunction.php",
			 data: {"action":"Del","arrId":arr},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
         printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorForMenuUpdate',res.error);
          }else{
            fillTableMenu(res.select);
            document.getElementById('delBtn').disabled=true;
          }
				}
		});
  }
}

function updateMenuAction() {
  var arr=getItemSelectedForUpdate();
  var text="Ви впевнені в тому що хочете оновити дані для "+arr.length+" записів ?";
  if(confirm(text)){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\menuFunction.php",
			 data: {"action":"Update","arrId":JSON.stringify(arr)},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
         printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorForMenuUpdate',res.error);
          }else{
            fillTableMenu(res.select);
            document.getElementById('saveBtn').disabled=true;
          }
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
  var arrField = ["name_","path_","parent_","avaible_"];
  for (var i = 0; i < arr.length; i++) {
    if(arr[i].checked){
      var ItemContent=[];
      var id=arr[i].id;
      for(var j=0;j<arrField.length;j++){
        var name=arrField[j];
				if(arrField[j]=="avaible_"){
					ItemContent[j]=((document.getElementById(arrField[j]+id).checked)?1:0);
					continue;
				}
        ItemContent[j]=document.getElementById(arrField[j]+id).value;
      }
      ItemContent[arrField.length]=id;
      arrSelected.push(ItemContent);
    }
  }
  return arrSelected;
}
