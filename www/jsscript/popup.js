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
	cleanElement("loginAutor");
	cleanElement("passwordAutor");
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

function exitButon() {
	$.post('\\libs\\stop.php', function(data) {
		getNewHeader();
	});
}

function startAutorizathion() {
	var login=delSpace(document.getElementById('loginAutor').value);
	var pass=delSpace(document.getElementById('passwordAutor').value);
	if(login!="" && pass!=""){
		$.ajax({
			 type: "POST",
			 url: "\\logic\\jsonScript\\authorization.php",
			 data: {"login":login, "password":pass},
			 scriptCharset: "CP1251",
			 success: function(data){
				 var res = JSON.parse(data);
				 if(res==""){
					getNewHeader();
					showOffPopup('loginForm');
				 }else{
					printErrorMessage('errorLoginForm',res);
				 }
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

function getNewHeader() {
	$.post('../visual/header.php', function(data) {
		$('.header').html(data);
	});
}

function cleanElementStyle(id) {
	document.getElementById(id).className="";
}
