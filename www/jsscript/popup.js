$(document).ready(function() {
	$(".popup_bg").click(function(){
		$(".popup").fadeOut(800);
	});
});

function showPopup(id ) {
	$("#"+id).fadeIn(800);
}

function showOffPopup(id) {
	$("#"+id).fadeOut(800);
}

function openAutorizathionForm() {
	cleanElement("login");
	cleanElement("password");
	printErrorMessage("errorLoginForm",'');
	showPopup('loginForm');
}


function cleanElement(id) {
	var x =document.getElementById(id);
	x.value='';
	cleanElementStyle(id);
}

function printErrorMessage(id,mess){
	var x=document.getElementById(id);
	x.setAttribute('hidden','')
	x.innerHTML="";
	x.innerHTML=mess;
	if(mess!=""){
		x.removeAttribute("hidden");
	}
}



function startAutorizathion() {
	var login=delSpace(document.getElementById('login').value);
	var pass=delSpace(document.getElementById('password').value);
	if(login!="" && pass!=""){
		$.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\authorization.php",
			 data: {"login":login, "password":pass},
			 scriptCharset: "CP1251",
			 success: function(data){
				 //var res = JSON.parse(data);
				// formListRay(res,idRay,id); // распарсим JSON
				}
		});
	}else{
		var err='';
		if(login==""){
			document.getElementById('login').className="errorfild";
			err+='Не було введео логін.<br>';
		}
		if(pass==""){
			document.getElementById('password').className="errorfild";
			err+='Не було введео пароль.<br>';
		}
		printErrorMessage('errorLoginForm',err);
	}
}

function cleanElementStyle(id) {
	document.getElementById(id).className="";
}
