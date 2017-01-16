<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");

  $filtr_fullYear=(isset($_POST[big_year]))?addslashes($_POST[big_year]):'';
  $filtr_shortYear=(isset($_POST[short_year]))?addslashes($_POST[short_year]):'';

  $MSG_Error="";
  $MSG_Info="";


  $action= (isset($_POST[mode]))?$_POST[mode]:'';

  if($action=="add"){
    $strQueryGet="SELECT * FROM `year` WHERE `nu` LIKE('".$filtr_fullYear."') AND `short_nu` LIKE ('".$filtr_shortYear."')";
    $res=mysqli_query($link,$strQueryGet);
    if($res){
      if(mysqli_num_rows($res)>0){
        $MSG_Error="Не можливо додати такий рік він вже існує.";
      }else{
        $strQuery="INSERT INTO `year`(`nu`, `short_nu`) VALUES ('".$filtr_fullYear."','".$filtr_shortYear."')";
        mysqli_query($link,$strQuery);
        $MSG_Error=(mysqli_error($link)!="")?("Виникла помилка при доданні даних ".mysqli_error($link)):("");
        $MSG_Info=(($MSG_Error!="")?"":"Запис додано до базы даних.");
      }
      mysqli_free_result($res);
    }
  }


  $strQuery="SELECT * FROM `year`";
  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $listResult[]=$row;
    }
  }

  require_once("../visual/year_add.php");
?>
