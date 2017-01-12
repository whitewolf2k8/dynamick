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
	<link href="../css/file_load.css" rel="stylesheet">
	<link href="../css/progress.css" rel="stylesheet">
	<link href="../css/paginator.css" rel="stylesheet">


  <script type="text/javascript" src="../javascriptliblibrary/jquery.min.js"></script>
	<script type="text/javascript" src="../jsscript/popup.js"></script>
	<script type="text/javascript" src="../jsscript/function.js"></script>
	<script type="text/javascript" src="../jsscript/js_kved_10.js"></script>


<script type="text/javascript">
	function loadElement() {
		document.getElementById("file_upload").onchange = function () {
			document.getElementById("file_info").value = document.getElementById("file_upload").value;
		};
	}
</script>



</head>

<body onload="digitalWatch();checkAvaibles();loadElement();" >

<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">

		<form name="adminForm" id="adminForm" action="..\logic\kved10_load.php" method="post" enctype="multipart/form-data">
			<div  id="inform_panel" style="text-align:center;"  hidden></div>
			<input type="hidden" name="limitstart" value="0"/>
	    <input type="hidden" name="limit" <? echo "value='".$paginathionLimit."'"; ?> />

			<h2 style="	text-align: center;"> Завантаження довыдника KVED 2010 </h2>
			<div class="item_blue" style="float:left; margin-left:60px; width:310px;" >
				<h2>Завантаження файлу КВЕД 2010</h2>
				<div  id="errorFormUserAdd" class="error" hidden></div>
				<p>
					<div>
						<input type="text" style="	width: 220px;" class="file" id="file_info" name="file_info">
						<div class="file_upload">
							<input type="file" id="file_upload" name="file_upload" accept=".dbf" >
						</div>
					</div>
				</p>
				<div class="clr"></div>
				<p style="text-align:center;" >
					<input type="button" value="Імпорт" onclick="loadKved();" >
				</p>
			</div>

			<div class="item_blue" style="float:right; margin-right:60px; width:310px;" >
				<h2>Пошук користувача</h2>
				<div  id="errorFormUserUpdate" class="error" hidden></div>
				<p>
					<div class="navigation_left" id='label'>Ім&#8242;я</div>
					<div class="navigation_right" ><input type="text" name="nameS"  style="width:250px;" value="<? echo $filtr_name; ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Логін</div>
					<div class="navigation_right" ><input type="text" name="loginS" style="width:250px;"  value="<? echo $filtr_login; ?>" ></div>
				</p>
				<div class="clr"></div>
				<p>
					<div class="navigation_left" id='label'>Відділ</div>
					<div class="navigation_right" ><select name="depS" style="width:250px; text-align:center;"><? echo $listDepatmentFind; ?></select></div>
				</p>
				<p style="text-align:center;" >
					<input type="button" id="saveBtn"  disabled  value="Збрегти зміни" onclick="updateAction();" >
					<input type="button" id="saveDtn" value="Пошук" onclick="submitForm('finduser')">
					<input type="button" id="delBtn"  disabled value="Видалити" onclick="delUserAction();" >
				</p>
			</div>
			<div class="clr"></div >
			<? if(isset($listResult)){ ?>
				<div align="center">
					<table id="tableKved">
						<tr>
							<th>&nbsp;</th>
							<th>Категорія</th>
							<th>Код</th>
							<th>Назва</th>
						</tr>
						<? foreach ($listResult as $key => $value) {
								echo "<tr id=\"r_".$value["id"]."\" onChange=\"delCheck('".$value[id]."');\" >";
								echo "<td><input name=\"checkFlag\" id=\"".$value[id]."\"  type=\"checkbox\"> </td>";
								echo "<td><input type=\"text\" id=\"kat_".$value[id]."\"  value=\"".$value["sek"]."\" onChange=\"onChangeData('".$value[id]."');\" maxlength=\"1\"  style=\"text-align:center;\" ></td>";
								echo "<td><input type=\"text\" id=\"kod_".$value[id]."\"  value=\"".$value["kod"]."\" onChange=\"onChangeData('".$value[id]."');\"  ></td>";
								echo "<td><textarea  id=\"n_".$value[id]."\" onChange=\"onChangeData('".$value[id]."');\" >".$value["nu"]."</textarea></td>";
								echo "</tr>";
						}?>
					</table>
				</div>
			<? } ?>
			</div>
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

	<div class="popup" id="progressDisplay" >
			<div class="popup_bg"></div>

			<div class="html5-progress-bar">
				<h2>Зачекайте іде виконная скрипта!! </h2>
				<div class="clr"></div>
						<progress id="progressbar" value="0" max="100"></progress>
						<span class="progress-value" id="progress_value" >0%</span>
			</div>
	</div>
</div>

<div class="scrollup"></div>
<div id="container">
 <? if(isset($pagination)){
	 		echo $pagination;
		}
	?>
</div>
<footer class="footer">
	<? require_once("foter.php"); ?>
</footer><!-- .footer -->

</body>
</html>
