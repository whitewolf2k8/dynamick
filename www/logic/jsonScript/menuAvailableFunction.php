<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");
  include_once("../../libs/funList.php");

  $action = iconv("utf-8","windows-1251",$_POST["action"]);
  $arrResult=array();
  $errorMessege="";
  $infoMessege="";

  if($action=="Add"){
    $menuId= $_POST["menuID"];
    $departmentId=$_POST["departmentID"];


    $strSelect="SELECT id FROM `menu_available` WHERE `id_menu`= %s AND `id_department`= %s ";
    $strInsert="INSERT INTO `menu_available` (`id_menu`, `id_department`) VALUES (%s,%s)";
    $result=mysqli_query($link,sprintf($strSelect,$menuId,$departmentId));
    if($result){
      $row=mysqli_fetch_assoc($result);
      if(mysqli_num_rows($result)>0){
        $errorMessege.=" Для даного відділу на даний пункт меня вже встановлено дозвіл.<br>";
      }else{
        mysqli_query($link,sprintf($strInsert,$menuId,$departmentId));
        $infoMessege="До бази данних було внесено 1дозвіл на використання пункту меню.";
      }
      mysqli_free_result($result);
    }
  }

  if($action=="Del"){
    $count=0;
    $array = $_POST["arrId"];
      $queryStr="DELETE FROM `menu_available` WHERE `id` =%s";
    foreach ($array as $key => $value) {
      $result= mysqli_query($link,sprintf($queryStr,$value));
      $count++;
    }
    $infoMessege="З бази данних було видалено ".$count." пунктів меню.( видалялись і дочірні елементи )";
    $errorMessege=mysqli_error($link);
  }

  if($action=="Update"){
    $count=0;
    $array=json_decode($_POST["arrId"]);

    $strUpdate="UPDATE `menu_available` SET `id_department`=%s WHERE `id`=%s";
    foreach ($array as $key => $value) {
        mysqli_query($link,sprintf($strUpdate,$value[0],$value[1]));
        $errorMessege.=(mysqli_error($link)!="")?(mysqli_error($link)."<br>"):"";
        if(mysqli_error($link)==""){
          $count++;
        }
    }
    $infoMessege="В базі данних було оновлено ".$count." запис(ів)";
  }

  $strQuery="SELECT t1.id, t3.id as id_d, t2.name, t2.path FROM `menu_available` as t1 left join `menu` as t2 on t2.id=t1.id_menu ".
    " left join department as t3  on t3.id = t1.id_department".$whereStr;
  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["department"]=getListDeparmtent($link,$row["id_d"],0,"- Всі -");
      $listResult[]=$row;
    }
  }
  $arrResult["select"]=$listResult;
  $arrResult["error"]=$errorMessege;
  $arrResult["info"]=$infoMessege;


  echo php2js($arrResult);
?>
