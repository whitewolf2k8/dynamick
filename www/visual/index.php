<? require_once("../libs/start.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="windows-1251" />
	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
	<title></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="../css/style.css" rel="stylesheet">
  <link href="../css/menu.css" rel="stylesheet">
	<link href="../css/digitForm.css" rel="stylesheet">

  <script type="text/javascript" src="../javascriptliblibrary/jquery.min.js"></script>
	<script type="text/javascript" src="../javascriptliblibrary/popup.js"></script>
  <script type="text/javascript">
	  $(function() {
		  if ($.browser.msie && $.browser.version.substr(0,1)<7)
		  {
		        $('li').has('ul').mouseover(function(){
		                $(this).children('ul').show();
		                }).mouseout(function(){
		                $(this).children('ul').hide();
		                })
		  }
		});
  </script>


	<script type="text/javascript">
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
	</script>

</head>

<body onload="digitalWatch()" >

<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header><!-- .header-->

	<main class="content">
		<strong>Content:</strong> Sed placerat accumsan ligula. Aliquam felis magna, congue quis, tempus eu, aliquam vitae, ante. Cras neque justo, ultrices at, rhoncus a, facilisis eget, nisl. Quisque vitae pede. Nam et augue. Sed a elit. Ut vel massa. Suspendisse nibh pede, ultrices vitae, ultrices nec, mollis non, nibh. In sit amet pede quis leo vulputate hendrerit. Cras laoreet leo et justo auctor condimentum. Integer id enim. Suspendisse egestas, dui ac egestas mollis, libero orci hendrerit lacus, et malesuada lorem neque ac libero. Morbi tempor pulvinar pede. Donec vel elit.
	</main><!-- .content -->
		<div class="popup" id="loginForm" >
			<div class="popup_bg"></div>
			<div class="form">
				<form>
					<h2>Авторизація в сервісі </h2>
					<input type="text" id="login"  placeholder="Ваш логін">
					<input type="password" id="password"  placeholder="Ваш пароль">
					<p style="text-align: center;">
						<input type="button" onClick="";  value="Авторизуватися">
						<input type="button" value="Скасувати">
					</p>
				</form>
			</div>
		</div>
</div><!-- .wrapper -->

<footer class="footer">
	<? require_once("foter.php"); ?>
</footer><!-- .footer -->

</body>
</html>
