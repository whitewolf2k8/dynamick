function submitForm(mode) {
		correct = true;
		form = document.forms['adminForm'];
		var year=document.getElementById("big_year").value;
		var yearShort=document.getElementById("short_year").value;
		var str="";
		if(year.match("^[1-9][0-9]{3}$")==null||yearShort.match("^['][0-9]{2}$")==null){
			correct=false;
			if(year.match("^[1-9][0-9]{3}$")==null){
				 str+="Невірно введено повний запис року.<br>";
			}
			if(yearShort.match("^['][0-9]{2}$")==null){
				 str+="Невірно введено короткий запис року..<br>";
			}
		}
		printMessage("inform_panel",str,4);
		if (correct) {
			form.mode.value = mode;
			form.submit();
		}
	}


function cleanFormAdd() {
  document.getElementById('big_year').value="";
  document.getElementById('short_year').value="";
}

/*при выводе сообщениея применимы такие типы 0-Успешное выполнение,
  1-предупрждение , 2 - сверка, 3 - предупреждение */
function printMessage(id,mess,type) {
  var types = {0: "info",1: "success",2: "validation",3: "warning",4:"error"};
  var x=document.getElementById(id);
	x.setAttribute('hidden','')
  x.className=types[type];
	x.innerHTML="";
	x.innerHTML=mess;
	if(mess!=""){
		x.removeAttribute("hidden");
	}
}



function getMessage() {
	var msg_e=document.getElementById("messEr").value;
	if(msg_e!=""){
		printMessage('inform_panel',msg_e,4);
	}else{
		printMessage('inform_panel',document.getElementById("messInfo").value,0);
		cleanFormAdd();
	}
}
