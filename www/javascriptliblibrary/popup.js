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

	
}
