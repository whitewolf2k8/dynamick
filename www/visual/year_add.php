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
	<script type="text/javascript" src="../jsscript/js_year_add.js"></script>
</head>

<body onload="digitalWatch();checkAvaibles(); getMessage();" >
<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">
		<form name="adminForm" action="..\logic\year_add.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" />
			<input type="hidden" id="messEr" value="<? echo ($MSG_Error!="")?$MSG_Error:"";?>" />
				<input type="hidden" id="messInfo" value="<? echo ($MSG_Info!="")?$MSG_Info:"";?>" />
			<div  id="inform_panel" style="text-align:center;" hidden></div>
			<h2 style="	text-align: center;"> Довідник років </h2>
			<div class="item_blue" style=" width:310px;text-align:center; margin-left:40%;margin-right:-155px;" >
				<h2>Додати рік</h2>
				<p>
					<div class="navigation_left" id='label'>Повний запис року</div>
					<div class="navigation_right" ><input type="text" maxlength="4" name="big_year" id="big_year" style="width:150px; text-align:center;" value="<? echo $filtr_fullYear; ?>"></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Короткий запис року</div>
					<div class="navigation_right" ><input type="text" maxlength="3" name="short_year" id="short_year"  style="width:150px; text-align:center;" value="<? echo stripcslashes($filtr_shortYear); ?>"></div>
				</p>
				<div class="clr"></div>
				<p style="text-align:center;" >
					<input type="button" value="Збрегти" onclick="submitForm('add');" >
					<input type="button" value="Очистити" onclick="cleanFormAdd();" >
				</p>
			</div>

			<div class="clr"></div >
			<? if(isset($listResult)){ ?>
				<div align="center">
					<table id="tableUser">
						<tr>
							<th>ID</th>
							<th>Повний запис</th>
							<th>Короткий запис</th>
						</tr>
						<? foreach ($listResult as $key => $value) {
								echo "<tr>";
								echo "<td>".$value['id']."</td>";
								echo "<td>".$value['nu']."</td>";
								echo "<td>".$value['short_nu']."</td>";
								echo "</tr>";
						}?>
					</table>
				</div>
			<? } ?>
		</form>
	</main><!-- .content -->
	<div class="popup" id="loginForm" >
		<div class="popup_bg"></div>
		<div class="form">
			<form method="post">
				<h2>Авторизація в сервісі </h2>
				<div  id="errorLoginForm" class="error" hidden></div>
				<input type="text" id="loginAutor" oninput="cleanElementStyle ('login');"  placeholder="Ваш логін">
				<input type="password" id="passwordAutor" oninput="cleanElementStyle('password');"  placeholder="Ваш пароль">
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
