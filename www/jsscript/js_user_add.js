function submitForm(mode) {
		correct = true;
		form = document.forms['adminForm'];
		if (correct) {
			form.mode.value = mode;
			form.submit();
		}
	}


function cleanFormAdd() {
  document.getElementById('nu').value="";
  document.getElementById('login').value="";
  document.getElementById('password').value="";
  var list=document.getElementById('department');
  list.selectedIndex=0;
  printErrorMessage('errorFormUserAdd',"");
}

/*при выводе сообщениея применимы такие типы 0-Успешное выполнение,
  1-предупрждение , 2 - сверка, 3 - предупреждение */
function printMessage(id,mess,type) {
  var types = {0: "info",1: "success",2: "validation",3: "warning"};
  var x=document.getElementById(id);
	x.setAttribute('hidden','')
  x.className=types[type];
	x.innerHTML="";
	x.innerHTML=mess;
	if(mess!=""){
		x.removeAttribute("hidden");
	}
}


function userAdd() {
  var nu = delSpace(document.getElementById('nu').value);
  var login = delSpace(document.getElementById('login').value);
  var password =delSpace( document.getElementById('password').value);
  var list=document.getElementById('department');
  var selectDepartment =  list.options[list.selectedIndex].value;
  if(nu!=""&& login!=""&& password!=""&& selectDepartment!=0){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\usersFunction.php",
			 data: {"action":"Add","nu":nu ,"login":login, "password":password,"department":selectDepartment},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
          if((res.error)!=""){
            printErrorMessage('errorFormUserAdd',res.error);
          }else{
            fillTableUser(res.select);
            cleanFormAdd();
          }
				}
		});
  }else{
    var errStr="";
    if(nu==""){
      errStr+="Необхідно ввести ім&#8242;я користувача.<br>";
    }
    if(login==""){
      errStr+="Необхідно ввести логін користувача.<br>";
    }
    if(password==""){
      errStr+="Пароль користувача не може бути порожнім.<br>";
    }
    if(selectDepartment==0){
      errStr+="Необхідно обрати відділ до якого відноситься користувач.<br>";
    }
    printErrorMessage('errorFormUserAdd',errStr);
  }
}

function fillTableUser(arr){
  var table = document.getElementById("tableUser");
  var htmlTable="";
  table.innerHTML="";
  htmlTable+="<tr><th>&nbsp;</th><th>Ім&#8242;я</th><th>Логін</th>"+
    "<th>Пароль(md5)</th><th>Відділ</th></tr>"
  for(var i=0;i<arr.length;i++){
    htmlTable+="<tr id=\"r_"+arr[i].id+"\" onChange=\"delCheck('"+arr[i].id+"');\" >";
    htmlTable+="<td> <input name=\"checkFlag\" id=\""+arr[i].id+"\"  type=\"checkbox\"> </td>";
    htmlTable+="<td><input type=\"text\" id=\"n_"+arr[i].id+"\"  value=\""+arr[i].nu+"\" onChange=\"onChangeData('"+arr[i].id+"');\"  ></td>";
    htmlTable+="<td><input type=\"text\" id=\"l_"+arr[i].id+"\"  value=\""+arr[i].name+"\" onChange=\"onChangeData('"+arr[i].id+"');\"  ></td>";
    htmlTable+="<td><input type=\"text\" id=\"p_"+arr[i].id+"\" value=\""+arr[i].password+"\" onChange=\"onChangeData('"+arr[i].id+"');\" ></td>";
    htmlTable+="<td><select id=\"d_"+arr[i].id+"\" onChange=\"onChangeData('"+arr[i].id+"');\" >"+arr[i].id_department+"</select></td>";
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
  var arr = ["n_","l_","p_","d_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).setAttribute("disabled", "disabled");
  }
}

function delDisabled(id) {
  var arr = ["n_","l_","p_","d_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).removeAttribute("disabled");
  }
}

function delUserAction() {
  var arr=getIdSelectedForDel();
  var text="Ви впевнені в тому що хочете видалити "+arr.length+" користувачів ?";
  if(confirm(text)){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\usersFunction.php",
			 data: {"action":"Del","arrId":arr},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
         printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorFormUserAdd',res.error);
          }else{
            fillTableUser(res.select);
            document.getElementById('delBtn').disabled=true;
          }
				}
		});
  }
}

function updateUserAction() {
  var arr=getItemSelectedForUpdate();
  var text="Ви впевнені в тому що хочете оновити дані "+arr.length+" користувачів ?";
  if(confirm(text)){
    $.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\usersFunction.php",
			 data: {"action":"Update","arrId":JSON.stringify(arr)},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
         printMessage("inform_panel",res.info,0);
          if((res.error)!=""){
            printErrorMessage('errorFormUserUpdate',res.error);
          }else{
            fillTableUser(res.select);
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
  var arrField = ["n_","l_","p_","d_"];

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
