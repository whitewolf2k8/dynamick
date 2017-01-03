<? include_once("../libs/setting.php"); if(!isset($_SESSION)) include_once("../libs/start.php");
   require("../libs/headerGet.php");
?>

<h2><? echo $stringHeader; ?><h2>
<div class="infostrin">
  <p style="float:left; padding-left: 10px;">Вітаємо ви авторизовані як: <? echo (isset($_SESSION["nu"]))?$_SESSION["nu"]:"Гість"; ?></p>
  <p id="digital_watch" style="float:right; padding-right: 15px;  font-size:13px; font-weight: bold;"></p>
</div>


<ul id="menu">
  <li><a href="../index.php">Головна</a></li>
  <? if(isset($menuRes)) echo $menuRes; ?>
  <li style="float:right;"  >
    <? if(isset($_SESSION["name"])){
        echo  "<a onClick=\"exitButon();\">Вихід</a>";
      }else{
        echo  "<a onClick=\"openAutorizathionForm();\">Увійти</a>";
      }
    ?>
  </li>

</ul>
