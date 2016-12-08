function cleanFormAdd() {
  document.getElementById('nu').value="";
  document.getElementById('login').value="";
  document.getElementById('password').value="";
  var list=document.getElementById('department');
  list.selectedIndex=0;
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
				/* if(res==""){
					getNewHeader();
					showOffPopup('loginForm');
				 }else{
					printErrorMessage('errorLoginForm',res);
        }*/

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
