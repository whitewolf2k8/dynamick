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
	<script type="text/javascript" src="../jsscript/js_user_add.js"></script>
</head>

<body onload="digitalWatch();" >
<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">
		<form name="adminForm" action="index.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" />
			<h2 style="	text-align: center;"> Довідник користувачів системи </h2>
			<div class="item_blue" style="float:left; margin-left:60px; width:310px;" >
				<h2>Додати користувача</h2>
				<div  id="errorFormUserAdd" class="error" hidden></div>
				<p>
					<div class="navigation_left" id='label'>Ім&#8242;я</div>
					<div class="navigation_right" ><input type="text"  id="nu" style="width:250px;"></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Логін</div>
					<div class="navigation_right" ><input type="text" id="login"  style="width:250px;"></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Пароль</div>
					<div class="navigation_right" ><input type="text" id="password" style="width:250px;"></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Відділ</div>
					<div class="navigation_right" ><select style="width:250px; text-align:center;" id="department" ><? echo $listDepatmentAdd; ?></select></div>
				</p>
				<p style="text-align:center;" >
					<input type="button" value="Збрегти" onclick="userAdd();" >
					<input type="button" value="Очистити" onclick="cleanFormAdd();" >
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
					<input type="button" id="saveDtn"  disabled  value="Збрегти" >
					<input type="button" value="Очистити" >
					<input type="button" id="delBtn"  disabled value="Видалити" >
				</p>
			</div>
			<div class="clr"></div >
			<? if(isset($listResult)){ ?>
				<div align="center">
					<table id="tableUser">
						<tr>
							<th>&nbsp;</th>
							<th>Ім&#8242;я</th>
							<th>Логін</th>
							<th>Пароль(md5)</th>
							<th>Відділ</th>
						</tr>
						<? foreach ($listResult as $key => $value) {
								echo "<tr id=\"r_".$value["id"]."\" onChange=\"delCheck('".$value[id]."');\" >";
								echo "<td> <input name=\"checkFlag\" id=\"".$value[id]."\"  type=\"checkbox\"> </td>";
								echo "<td><input type=\"text\" id=\"n_".$value[id]."\"  value=\"".$value["nu"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><input type=\"text\" id=\"l_".$value[id]."\"  value=\"".$value["name"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><input type=\"text\" id=\"p_".$value[id]."\" value=\"".$value["password"]."\" onChange=\"onChangeData('".$value[id]."');\" ></td>";
								echo "<td><select id=\"d_".$value[id]."\" onChange=\"onChangeData('".$value[id]."');\" >".$value["id_department"]."</select></td>";
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
