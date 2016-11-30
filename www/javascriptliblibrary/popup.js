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

function startAutorixathion() {
	var login=document.getElementById('login');
	var pass=document.getElementById('password');
	$.ajax({
		 type: "POST",
		 url: "script\\order.php",
		 data: {id:mode},
		 scriptCharset: "CP1251",
		 success: function(data){
				 var res = JSON.parse(data);
			//	 formListRay(res,idRay,id); // распарсим JSON
			}
	 });

}
