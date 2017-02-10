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
	<script type="text/javascript" src="../jsscript/js_fin_res_add.js"></script>

</head>

<body onload="digitalWatch();checkAvaibles();" >

<div class="wrapper">
	<header class="header">
		<? require_once("header.php"); ?>
	</header>
	<main class="content">

		<form name="adminForm" id="adminForm" action="..\logic\kved10_load.php" method="post" enctype="multipart/form-data">
			<div  id="inform_panel" style="text-align:center;"  hidden></div>
			<input type="hidden" name="limitstart" value="0"/>
	    <input type="hidden" name="limit" <? echo "value='".$paginathionLimit."'"; ?> />

			<h2 style="	text-align: center;"> Фiнансовi результати до оподаткування  </h2>
			<div class="headInfo" >
				<h2> за <select  id = "periodS" name="periodS" style="width:250px;" onchange="changeAction();">
					 				<? echo $listPeriod; ?>
								</select>
								<select  id = "yearS" name="yearS" style="width:120px;"  onchange="changeAction();">
									<? echo $listYear; ?>
								</select>
							<input type="button" id="selectPeriodBtn"  disabled  value="Початич" onclick="updateAction();" >
				</h2>
			</div>

			<div class="clr"></div >
			<? if(isset($listResult)){ ?>
				<div align="center">

					<table >
						 <caption style="font-style: italic; text-align:left;  font-size: 13px;  display: table-caption; text-align: right; margin-bottom: 2px;">(тис. грн.)</caption>
						<tr>
							<th rowspan="2">За КВЕД10</th>
							<th rowspan="2">Фiнансовий <br>результат (сальдо)</th>
							<th colspan="2">Пiдприємства, якi</th>
							<th colspan="2">Пiдприємства, якi одержали збиток</th>
						</tr>
						<tr>
							<th>у % до загальної<br>кiлькостi пiдприємств</th>
							<th>фiнансовий результат</th>
							<th>у % до загальної<br>кiлькостi пiдприємств</th>
							<th>фiнансовий результат</th>
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
