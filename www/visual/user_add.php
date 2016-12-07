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
	<link href="../css/table.css" rel="stylesheet">

  <script type="text/javascript" src="../javascriptliblibrary/jquery.min.js"></script>
	<script type="text/javascript" src="../jsscript/popup.js"></script>
	<script type="text/javascript" src="../jsscript/function.js"></script>

	<script type='text/javascript' src="../snow/snow.js"></script>

</head>

<body onload="digitalWatch();snow(1);" >
<div id="snow">	</div>
<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header><!-- .header-->

	<main class="content">
		<h2 style="	text-align: center;"> Довідник користувачів системи </h2>
		<div class="item_blue" style="float:left; margin-left:60px; width:310px;" >
			<h2>Додати користувача</h2>
			<p>
				<div class="navigation_left" id='label'>Ім&#8242;я</div>
				<div class="navigation_right" ><input type="text" style="width:250px;"></div>
			</p>
			<div class="clr"></div>
			<p>
				<div class="navigation_left" id='label'>Логін</div>
				<div class="navigation_right" ><input type="text" style="width:250px;"></div>
			</p>
			<div class="clr"></div>
			<p>
				<div class="navigation_left" id='label'>Пароль</div>
				<div class="navigation_right" ><input type="text" style="width:250px;"></div>
			</p>
			<div class="clr"></div>
			<p>
				<div class="navigation_left" id='label'>Відділ</div>
				<div class="navigation_right" ><select style="width:250px;"></select></div>
			</p>

			<p style="text-align:center;" >
				<input type="button" value="Збрегти" >
				<input type="button" value="Очистити" >
			</p>
		</div>

		<div class="item_blue" style="float:right; margin-right:60px; width:310px;" >
			<h2>Додати користувача</h2>
			<p>
				<div class="navigation_left" id='label'>Ім&#8242;я</div>
				<div class="navigation_right" ><input type="text" style="width:250px;"></div>
			</p>
			<div class="clr"></div>
			<p>
				<div class="navigation_left" id='label'>Логін</div>
				<div class="navigation_right" ><input type="text" style="width:250px;"></div>
			</p>
			<div class="clr"></div>
			<p>
				<div class="navigation_left" id='label'>Пароль</div>
				<div class="navigation_right" ><input type="text" style="width:250px;"></div>
			</p>
			<div class="clr"></div>
			<p>
				<div class="navigation_left" id='label'>Відділ</div>
				<div class="navigation_right" ><select style="width:250px;"></select></div>
			</p>

			<p style="text-align:center;" >
				<input type="button" value="Збрегти" >
				<input type="button" value="Очистити" >
			</p>
		</div>
		 <div class="clr"></div >
  <div align="center">
		<table>
<tr>
  <th>Company</th>
  <th>Q1</th>
  <th>Q2</th>
  <th>Q3</th>
  <th>Q4</th>
  </tr>
 <tr>
  <td>Microsoft</td>
  <td>20.3</td>
  <td>30.5</td>
  <td>23.5</td>
  <td>40.3</td>
 </tr>
<tr>
  <td>Google</td>
  <td>50.2</td>
  <td>40.63</td>
  <td>45.23</td>
  <td>39.3</td>
</tr>
<tr>
  <td>Apple</td>
  <td>25.4</td>
  <td>30.2</td>
  <td>33.3</td>
  <td>36.7</td>
</tr>
<tr>
  <td>IBM</td>
  <td>20.4</td>
  <td>15.6</td>
  <td>22.3</td>
  <td>29.3</td>
</tr>
</table>
</div>

	</main><!-- .content -->
	<div class="popup" id="loginForm" >
		<div class="popup_bg"></div>
		<div class="form">
			<form method="post">
				<h2>Авторизація в сервісі </h2>
				<div  id="errorLoginForm" class="error" hidden></div>
				<input type="text" id="login" oninput="cleanElementStyle ('login');"  placeholder="Ваш логін">
				<input type="password" id="password" oninput="cleanElementStyle('password');"  placeholder="Ваш пароль">
				<p style="text-align: center;">
					<input type="button" onClick="startAutorizathion();";  value="Авторизуватися">
					<input type="button" onClick="showOffPopup('loginForm')"; value="Скасувати">
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
