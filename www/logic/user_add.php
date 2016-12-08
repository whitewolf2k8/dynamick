<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");


  $strQuery="SELECT * FROM `users`";
  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["id_department"]=getListDeparmtent($link,$row["id_department"]);
      $listResult[]=$row;
    }
  }

  $listDepatmentAdd=getListDeparmtent($link,0,1);

  require_once("../visual/user_add.php");
?>
