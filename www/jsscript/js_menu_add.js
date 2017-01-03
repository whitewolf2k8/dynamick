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


function menuAdd() {
  var name = delSpace(document.getElementById('nameAdd').value);
	var list=document.getElementById('parentElementAdd');
  var selectParentntElement =  list.options[list.selectedIndex].value;
  var path = delSpace(document.getElementById('pathAdd').value);
  var enableElement =((document.getElementById('anableAdd').checked)?1:0);
  if(name!=""&& path!=""){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\menuFunction.php",
			 data: {"action":"Add","name":name ,"parent":selectParentntElement, "path":path,"enabled":enableElement},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
          if((res.error)!=""){
            printErrorMessage('errorFormMenuAdd',res.error);
          }else{
            fillTableMenu(res.select);
						updateLists(res.listMainMenuAdd,res.listMainMenuSelect);
            cleanFormAdd();
          }
				}
		});
  }else{
    var errStr="";
    if(name==""){
      errStr+="��������� ������ ����� �������.<br>";
    }
    if(path==""){
      errStr+="��������� ������ ���� �������������.<br>";
    }
    printErrorMessage('errorFormMenuAdd',errStr);
  }
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
  htmlTable+="<tr><th>&nbsp;</th><th>�����</th><th>���� ���������������</th>"
		+"<th>����������� �������</th><th>��������</th></tr>";
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
  var arr = ["name_","path_","parent_","avaible_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).setAttribute("disabled", "disabled");
  }
}

function delDisabled(id) {
  var arr = ["name_","path_","parent_","avaible_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).removeAttribute("disabled");
  }
}

function delMenuAction() {
  var arr=getIdSelectedForDel();
  var text="�� ������� � ���� �� ������ �������� "+arr.length+" �����(��)?";
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

function updateMenuAction() {
  var arr=getItemSelectedForUpdate();
  var text="�� ������� � ���� �� ������ ������� ��� ��� "+arr.length+" ������ ?";
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
						updateLists(res.listMainMenuAdd,res.listMainMenuSelect);
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
