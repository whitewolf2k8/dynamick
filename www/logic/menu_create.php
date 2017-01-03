<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");

  $filtr_name=(isset($_POST[nameS]))?$_POST[nameS]:'';
  $filtr_path=(isset($_POST[pathS]))?$_POST[pathS]:'';
  $filtr_mainMenu=(isset($_POST[mainMenuS]))?$_POST[mainMenuS]:'0';

  $where=array();

  if($filtr_name!=""){
    $where[]=" name LIKE('%".$filtr_name."%')";
  }

  if($filtr_path!=""){
    $where[]=" path LIKE('%".$filtr_path."%')";
  }

  if($filtr_mainMenu!=0){
    $where[]=" perent = ".$filtr_mainMenu;
  }

  $whereStr = ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

  $strQuery="SELECT * FROM `menu` ".$whereStr;
  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["perent"]=getListMainMenu($link,$row["perent"]);
      $listResult[]=$row;
    }
  }

  $mainListAdd=getListMainMenu($link,0);
  $mainListSearch=getListMainMenu($link,$filtr_mainMenu,'- βρ³ -');

  require_once("../visual/menu_create.php");
?>
