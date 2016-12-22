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

  $strQuery="SELECT t1.id, t3.id as id_d, t2.name, t2.path FROM `menu_available` as t1 left join `menu` as t2 on t2.id=t1.id_menu ".
    " left join department as t3  on t3.id = t1.id_department".$whereStr;

  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["department"]=getListDeparmtent($link,$row["id_d"],"- Всі -");
      $listResult[]=$row;
    }
  }

  $mainListAdd=getListMenu($link,0,"- не обрано -");
  $mainListDepartmentAdd=getListDeparmtent($link,0,"- не обрано -");

  $mainListSearch=getListMainMenu($link,$filtr_mainMenu,"- не обрано -");

  require_once("../visual/menu_available.php");
?>
