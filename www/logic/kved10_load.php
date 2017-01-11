<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");

  $filtr_name=(isset($_POST[nameS]))?$_POST[nameS]:'';
  $filtr_login=(isset($_POST[loginS]))?$_POST[loginS]:'';
  $filtr_department=(isset($_POST[depS]))?$_POST[depS]:'0';

  $where=array();

  if($filtr_name!=""){
    $where[]=" nu LIKE('%".$filtr_name."%')";
  }

  if($filtr_login!=""){
    $where[]=" name LIKE('%".$filtr_login."%')";
  }

  if($filtr_department!=0){
    $where[]=" id_department = ".$filtr_department;
  }

  $whereStr = ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

  $strQuery="SELECT * FROM `kved10` WHERE 1".$whereStr;
  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $listResult[]=$row;
    }
  }

  $listDepatmentAdd=getListDeparmtent($link,0,1);
  $listDepatmentFind=getListDeparmtent($link,$filtr_department,1,"- βρ³ -");

  require_once("../visual/kved10_load.php");
?>
