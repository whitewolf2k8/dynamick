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
	<link href="../css/messege.css" rel="stylesheet">
	<link href="../css/digitForm.css" rel="stylesheet">

  <script type="text/javascript" src="../javascriptliblibrary/jquery.min.js"></script>
	<script type="text/javascript" src="../jsscript/popup.js"></script>
	<script type="text/javascript" src="../jsscript/function.js"></script>

</head>

<body onload="digitalWatch()" >

<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header><!-- .header-->

	<main class="content">
		<h2 style="	text-align: center;"> ������� ������������ ������� </h2>
	</main><!-- .content -->
	<div class="popup" id="loginForm" >
		<div class="popup_bg"></div>
		<div class="form">
			<form method="post">
				<h2>����������� � ����� </h2>
				<div  id="errorLoginForm" class="error" hidden></div>
				<input type="text" id="login" oninput="cleanElementStyle ('login');"  placeholder="��� ����">
				<input type="password" id="password" oninput="cleanElementStyle('password');"  placeholder="��� ������">
				<p style="text-align: center;">
					<input type="button" onClick="startAutorizathion();";  value="��������������">
					<input type="button" onClick="showOffPopup('loginForm')"; value="���������">
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
