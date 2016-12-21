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
	<link href="../css/CheckBoxStyle.css" rel="stylesheet">

  <script type="text/javascript" src="../javascriptliblibrary/jquery.min.js"></script>
	<script type="text/javascript" src="../jsscript/popup.js"></script>
	<script type="text/javascript" src="../jsscript/function.js"></script>
	<script type="text/javascript" src="../jsscript/js_menu_add.js"></script>
</head>

<body onload="digitalWatch();" >
<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">
		<form name="adminForm" action="..\logic\menu_available.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" />
			<div  id="inform_panel" style="text-align:center;"  hidden></div>

			<h2 style="	text-align: center;"> Таблиця надання доступів до пуктів меню відділам </h2>

			<div class="item_blue" style="float:left; margin-left:60px; width:350px;" >
				<h2>Додати доступ до пункту меню</h2>
				<div  id="errorFormMenuAdd" class="error" hidden></div>
				<p>
					<div class="navigation_left"id='label'>Назва пункту</div>
					<div class="navigation_right" ><select style="width:242px; text-align:center;" id="parentElementAdd"><? echo $mainListAdd; ?></select>	</div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" style="text-align:center;" id='label'>Відділ</div>
					<div class="navigation_right" ><select style="width:242px; text-align:center;" id="parentElementAdd"><? echo $mainListDepartmentAdd; ?></select></div>
				</p>
				<div class="clr"></div>

				<p style="text-align:center;" >
					<input type="button" value="Збрегти" onclick="menuAdd();" >
					<input type="button" value="Очистити" onclick="cleanFormAdd();" >
				</p>
			</div>

			<div class="item_blue" style="float:right; margin-right:60px; width:350px;" >
				<h2>Пошук пунта меню</h2>
				<div  id="errorForMenuUpdate" class="error" hidden></div>
				<p>
					<div class="navigation_left" id='label'>Назва пункту</div>
					<div class="navigation_right" ><input type="text" name="nameS"  style="width:240px;" value="<? echo $filtr_name; ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Шлях<br>відкриття</div>
					<div class="navigation_right" ><input type="text" name="pathS" style="width:240px;"  value="<? echo $filtr_path; ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Батіківський<br>елемент</div>
					<div class="navigation_right" ><select name="mainMenuS" id ='mainMenuS' style="width:242px; text-align:center;"><? echo $mainListSearch; ?></select></div>
				</p>
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
							<th>Батьківський елемент</th>
							<th>Видимість</th>
						</tr>
						<? foreach ($listResult as $key => $value) {
								echo "<tr id=\"r_".$value["id"]."\">";
								echo "<td> <input name=\"checkFlag\" id=\"".$value[id]."\"  type=\"checkbox\" onChange=\"delCheck('".$value[id]."');\"> </td>";
								echo "<td><input style=\" width:100%; text-align:center; \" type=\"text\" id=\"name_".$value[id]."\"  value=\"".$value["name"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><input style=\" width:100%; text-align:center; \" type=\"text\" id=\"path_".$value[id]."\"  value=\"".$value["path"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><select style=\" width:100%; text-align:center;\" id=\"parent_".$value[id]."\" onChange=\"onChangeData('".$value[id]."');\" >".$value["perent"]."</select></td>";
								echo "<td><input type=\"checkbox\" id=\"avaible_".$value[id]."\" onChange=\"onChangeData('".$value[id]."');\" ".(($value[enables]==1)?"checked":'')."  ></td>";
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
