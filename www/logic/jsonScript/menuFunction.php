<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");
  include_once("../../libs/funList.php");

  $action = iconv("utf-8","windows-1251",$_POST["action"]);
  $arrResult=array();
  $errorMessege="";
  $infoMessege="";

  if($action=="Add"){
    $name = iconv("utf-8","windows-1251",$_POST["name"]);
    $parentId=$_POST["parent"];
    $path=iconv("utf-8","windows-1251",$_POST["path"]);
    $enabled=$_POST["enabled"];


    $strSelect="SELECT id FROM `menu` WHERE `name` LIKE('%s') AND `perent`= %s";
    $strInsert="INSERT INTO `menu`(`name`, `perent`, `path`, `enables`) VALUES ('%s',%s,'%s',%s)";
    $result=mysqli_query($link,sprintf($strSelect,$name,$parentId));
    if($result){
      $row=mysqli_fetch_assoc($result);
      if(mysqli_num_rows($result)>0){
        $errorMessege.=" Не можливо створити пункт меню, з такими  данними вже існує.<br>";
      }else{
        mysqli_query($link,sprintf($strInsert,$name,$parentId,$path,$enabled));
      }
      mysqli_free_result($result);
    }
  }

  if($action=="Del"){
    $count=0;
    $array = $_POST["arrId"];
      $queryStr="DELETE FROM `menu` WHERE `id` = %s OR `perent` = %s";
    foreach ($array as $key => $value) {
      $result= mysqli_query($link,sprintf($queryStr,$value,$value));
      $count+=mysqli_affected_rows($link);
    }
    $infoMessege="З бази данних було видалено ".$count." пунктів меню.( видалялись і дочірні елементи )";
    $errorMessege=mysqli_error($link);
  }

  if($action=="Update"){
    $count=0;
    $array=json_decode($_POST["arrId"]);

    $strUpdate="UPDATE `menu` SET `name`='%s',`perent`=%s,`path`='%s',`enables`=%s WHERE `id`=%s";
    foreach ($array as $key => $value) {
      if($value[0]!="" && $value[1]!=""){
        mysqli_query($link,sprintf($strUpdate,convertStringJSon($value[0]),
          $value[2],convertStringJSon($value[1]),$value[3],$value[4]));
        $errorMessege.=(mysqli_error($link)!="")?(mysqli_error($link)."<br>"):"";
        if(mysqli_error($link)==""){
          $count++;
        }
      }
      if($value[0]==""){
        $errorMessege.="Назва пункту меню не може бути пустою. <br> ";
      }
      if($value[1]==""){
        $errorMessege.="Шлях перенаправлення не можу бути пустим. <br> ";
      }
    }
    $infoMessege="В базі данних було оновлено ".$count." запис(ів)";
  }

  $str="SELECT * FROM `menu`";
  $result=mysqli_query($link,$str);
  if($result){
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["perent"]=getListMainMenu($link,$row["perent"]);
      $arrResult["select"][]=$row;
    }
    mysqli_free_result($result);
  }

  $arrResult["error"]=$errorMessege;
  $arrResult["info"]=$infoMessege;
  $arrResult["listMainMenuAdd"]=getListMainMenu($link,0);
  $arrResult["listMainMenuSelect"]=getListMainMenu($link,0," - всі - ");

  echo php2js($arrResult);
?>
