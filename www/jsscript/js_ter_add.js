function submitForm(mode) {
	correct = true;
	form = document.forms['adminForm'];
 	var msgError="";

	printMessage('inform_panel_info',"",4);
	printMessage('inform_panel_er',"",0);

	if(mode=="add"){
		var nu=document.getElementById('nu').value;
		var kod=document.getElementById('ter').value;
		var list=document.getElementById('typeTer');

		var type=list.options[list.selectedIndex].value;

		if(nu==""||kod.match("^[0-9]{9,10}$")==null||type=="-1"){
			correct=false;
			if(nu==""){
				msgError+="Необхідно ввести назву території/ населеного пункту.<br>";
			}
			if(kod.match("^[0-9]{9,10}$")==null){
				msgError+="Необхідно ввести код (території/ населеного пункту) за КОАТОУ.<br>";
			}
			if(type=="-1"){
				msgError+="Необхідно обрати тип (території/ населеного пункту).<br>";
			}
		}
	}

	if(mode=="update"){
		form.arrItem.value=getIdSelected();
	}

	if(mode=="dell"){
		var arr=getIdSelected();
		if(confirm("Ви впевнені, в тому що хочете видалити "+arr.length+" запис(ів) ??")){
			form.arrItem.value=arr;
		}else{
			correct=false;
		}
	}
	printErrorMessage("errorFormTerAdd",msgError);
	if (correct) {
		form.mode.value = mode;
		form.submit();
	}

}

function getMessage() {
	var msg_e=document.getElementById("messEr").value;
	var msg_i=document.getElementById("messInfo").value;
	printMessage('inform_panel_info',msg_e,4);
	printMessage('inform_panel_er',msg_i,0);
	if(msg_e==""){
		cleanFormAdd();
	}
}

function cleanFormAdd() {
  document.getElementById('nu').value="";
  document.getElementById('ter').value="";
  var list=document.getElementById('typeTer');
  list.selectedIndex=0;
  printErrorMessage('errorFormTerAdd',"");
}

/*при выводе сообщениея применимы такие типы 0-Успешное выполнение,
  1-предупрждение , 2 - сверка, 3 - предупреждение */
function printMessage(id,mess,type) {
  var types = {0: "info",1: "success",2: "validation",3: "warning" , 4: "error"};
  var x=document.getElementById(id);
	x.setAttribute('hidden','')
  x.className=types[type];
	x.innerHTML="";
	x.innerHTML=mess;
	if(mess!=""){
		x.removeAttribute("hidden");
	}
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
  var arr = ["n_","ter_","type_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).setAttribute("disabled", "disabled");
  }
}

function delDisabled(id) {
    var arr = ["n_","ter_","type_"];
  for(var i=0;i<arr.length;i++){
    document.getElementById(arr[i]+id).removeAttribute("disabled");
  }
}

function getIdSelected() {
  var arr = document.getElementsByName("checkFlag");
  var arrSelected=[];
  for (var i = 0; i < arr.length; i++) {
    if(arr[i].checked){
      arrSelected.push(arr[i].id);
    }
  }
  return arrSelected;
}
