function delSpace(str) {
  return str.replace(/\s/g, "");
}
function digitalWatch() {
  var date = new Date();
  var fulldate=date.getDate();
  var month=date.getMonth()+1;
  var year= date.getFullYear();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var seconds = date.getSeconds();
  if (hours < 10) hours = "0" + hours;
  if (minutes < 10) minutes = "0" + minutes;
  if (seconds < 10) seconds = "0" + seconds;
  document.getElementById("digital_watch").innerHTML =year+"/"+month+"/"+fulldate+"  "+ hours + ":" + minutes + ":" + seconds;
  setTimeout("digitalWatch()", 1000);
}

$(function() {

        $('li').has('ul').mouseover(function(){
                $(this).children('ul').show();
                }).mouseout(function(){
                $(this).children('ul').hide();
                })
});

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

$(document).ready(function(){
 $(window).scroll(function(){
   if ($(this).scrollTop() > 100) {
     $('.scrollup').fadeIn();
   } else {
     $('.scrollup').fadeOut();
   }
 });
 $('.scrollup').click(function(){
 $("html, body").animate({ scrollTop: 0 }, 600);
   return false;
 });
});

function submitFormLim(lim){
  var x = document.getElementsByName("limit");
    x[0].value=lim;
  var x = document.getElementsByName("limitstart");
    x[0].value=0;
    document.forms['adminForm'].submit();
}

function submitFormLimStart(limS){
  var x = document.getElementsByName("limitstart");
    x[0].value=limS;
    document.forms['adminForm'].submit();
}
