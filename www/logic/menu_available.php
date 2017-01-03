<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");

  $filtr_menu=(isset($_POST[menuItemSelect]))?$_POST[menuItemSelect]:'0';
  $filtr_department=(isset($_POST[departmentItemselect]))?$_POST[departmentItemselect]:'-1';

  $where=array();

  if($filtr_menu!="0"){
    $where[]=" id_menu =".$filtr_menu;
  }

  if($filtr_department!="-1"){
    $where[]="id_department =".$filtr_department;
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
  $mainListDepartmentAdd=getListDeparmtent($link,0,"- всі -");

  $mainListSearch=getListMainMenu($link,$filtr_menu,"- не обрано -");
  $mainListDepartmentSelect=getListDeparmtentForAvaible($link,$filtr_department,0,"- всі -");

  require_once("../visual/menu_available.php");
?>
