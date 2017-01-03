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
	<script type="text/javascript" src="../jsscript/js_menu_available.js"></script>
</head>

<body onload="digitalWatch();checkAvaibles();" >
<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">
		<form name="adminForm" action="..\logic\menu_available.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" />
			<div  id="inform_panel" style="text-align:center;"  hidden></div>

			<h2 style="	text-align:center;"> Таблиця надання доступів до пуктів меню відділам </h2>

			<div class="item_blue" style="float:left; margin-left:60px; width:350px;" >
				<h2>Додати доступ до пункту меню</h2>
				<div  id="errorFormMenuAdd" class="error" hidden></div>
				<p>
					<div class="navigation_left"id='label'>Назва пункту</div>
					<div class="navigation_right" ><select style="width:242px; text-align:center;" id="menuItemAdd"><? echo $mainListAdd; ?></select>	</div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" style="text-align:center;" id='label'>Відділ</div>
					<div class="navigation_right" ><select style="width:242px; text-align:center;" id="departmentItemAdd"><? echo $mainListDepartmentAdd ?></select></div>
				</p>
				<div class="clr"></div>

				<p style="text-align:center;" >
					<input type="button" value="Збрегти" onclick="menuAdd();" >
					<input type="button" value="Очистити" onclick="cleanFormAdd();" >
				</p>
			</div>

			<div class="item_blue" style="float:right; margin-right:60px; width:350px;" >
				<h2>Пошук доступів до пункті меню</h2>
				<div  id="errorForMenuUpdate" class="error" hidden></div>
				<p>
					<div class="navigation_left"id='label'>Назва пункту</div>
					<div class="navigation_right" ><select style="width:242px; text-align:center;" name="menuItemSelect"><? echo $mainListSearch; ?></select>	</div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" style="text-align:center;" id='label'>Відділ</div>
					<div class="navigation_right" ><select style="width:242px; text-align:center;" name="departmentItemselect"><? echo $mainListDepartmentSelect ?></select></div>
				</p>
				<div class="clr"></div>
				<div class="clr"></div>
				<p style="text-align:center;" >
					<input type="button" id="saveBtn"  disabled  value="Збрегти зміни" onclick="updateMenuAction();" >
					<input type="button" id="saveDtn" value="Пошук" onclick="submitForm('finduser')" >
					<input type="button" id="delBtn"  disabled value="Видалити" onclick="delMenuAction();" >
				</p>
			</div>

			<div class="clr"></div >
			<? if(isset($listResult)){ ?>
				<div align="center">
					<table id="tableMenu">
						<tr>
							<th>&nbsp;</th>
							<th>Назва</th>
							<th>Шлях перенаправлення</th>
							<th>Відділ</th>
						</tr>
						<? foreach ($listResult as $key => $value) {
								echo "<tr id=\"r_".$value["id"]."\">";
								echo "<td> <input name=\"checkFlag\" id=\"".$value[id]."\"  type=\"checkbox\" onChange=\"delCheck('".$value[id]."');\"> </td>";
								echo "<td style=\"padding:0 8px 0 8px;\">".$value["name"]."</td>";
								echo "<td>".$value["path"]."</td>";
								echo "<td><select style=\" width:100%; text-align:center;\" id=\"dep_".$value[id]."\" onChange=\"onChangeData('".$value[id]."');\" >".$value["department"]."</select></td>";
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
				<input type="text" id="loginAutor" oninput="cleanElementStyle ('loginAutor');"  placeholder="Ваш логін">
				<input type="password" id="passwordAutor" oninput="cleanElementStyle('passwordAutor');"  placeholder="Ваш пароль">
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
