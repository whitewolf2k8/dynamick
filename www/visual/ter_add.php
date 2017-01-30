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
	<script type="text/javascript" src="../jsscript/js_ter_add.js"></script>
</head>

<body onload="digitalWatch();checkAvaibles();getMessage();" >
<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">
		<form name="adminForm" action="..\logic\ter_add.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="mode" />
				<input type="hidden" name="arrItem" />
			<input type="hidden" id="messEr" value="<? echo ($MSG_error!="")?$MSG_error:"";?>" />
			<input type="hidden" id="messInfo" value="<? echo ($MSG_info!="")?$MSG_info:"";?>" />

			<div  id="inform_panel_info" style="text-align:center;"  hidden></div>
			<div  id="inform_panel_er" style="text-align:center;"  hidden></div>

			<h2 style="	text-align: center;"> Довідник територій </h2>
			<div class="item_blue" style="float:left; margin-left:60px; width:310px;" >
				<h2>Додати район/місто</h2>
				<div  id="errorFormTerAdd" class="error" hidden></div>
				<p>
					<div class="navigation_left" id='label'>Назва</div>
					<div class="navigation_right" ><input type="text"  name="nu" id="nu" value="<? echo ((isset($nu))?$nu:''); ?>" style="width:250px;text-align:center;"></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Код повний</div>
					<div class="navigation_right" ><input type="text" name="ter" id="ter" maxlength="10"  style="width:225px; text-align:center;" value="<? echo ((isset($ter))?$ter:'');  ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Тип</div>
					<div class="navigation_right" ><select style="width:250px; text-align:center;" name="typeTer" id="typeTer" ><? echo $listTerritoryAdd; ?></select></div>
				</p>
				<p style="text-align:center;" >
					<input type="button" value="Збрегти" onclick="submitForm('add');" >
					<input type="button" value="Очистити" onclick="cleanFormAdd();" >
				</p>
			</div>

			<div class="item_blue" style="float:right; margin-right:60px; width:310px;" >
				<h2>Пошук в довіднику територій по:</h2>
				<div  id="errorFormUserUpdate" class="error" hidden></div>
				<p>
					<div class="navigation_left" id='label'>Назві</div>
					<div class="navigation_right" ><input type="text" name="nu_filtr"  style="width:250px;" value="<? echo $filtr_nu; ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
						<div class="navigation_left" id='label'>Коду<br>території</div>
						<div class="navigation_right" ><input type="text" name="ter_filtr" style="width:230px; margin-top:5px;"  value="<? echo $filtr_ter; ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Типу</div>
					<div class="navigation_right" ><select name="type_filtr" style="width:250px; text-align:center;"><? echo $listTerritorySelect; ?></select></div>
				</p>
				<p style="text-align:center;" >
					<input type="button" id="saveBtn"  disabled  value="Збрегти зміни" onclick="submitForm('update');" >
					<input type="button" id="saveDtn" value="Пошук" onclick="submitForm('')" >
					<input type="button" id="delBtn"  disabled value="Видалити" onclick="submitForm('dell');" >
				</p>
			</div>
			<div class="clr"></div >
			<? if(isset($listResult)){ ?>
				<div align="center">
					<table id="tableUser">
						<tr>
							<th>&nbsp;</th>
							<th>Назва</th>
							<th>Код території</th>
							<th>Тип</th>
						</tr>
						<? foreach ($listResult as $key => $value) {
								echo "<tr id=\"r_".$value["id"]."\" onChange=\"delCheck('".$value[id]."');\" >";
								echo "<td> <input type=\"checkbox\" name=\"checkFlag\" id=\"".$value[id]."\"  > </td>";
								echo "<td><input type=\"text\" id=\"n_".$value[id]."\"  name=\"n_".$value[id]."\"  value=\"".$value["name"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><input type=\"text\" id=\"ter_".$value[id]."\" maxlength=\"10\" name=\"ter_".$value[id]."\"  value=\"".$value["ter"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><select id=\"type_".$value[id]."\" name=\"type_".$value[id]."\" onChange=\"onChangeData('".$value[id]."');\" >".$value["type"]."</select></td>";
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
