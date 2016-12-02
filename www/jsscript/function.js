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
