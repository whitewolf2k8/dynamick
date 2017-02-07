<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");


  $paginathionLimitStart=isset($_POST['limitstart']) ? stripslashes($_POST['limitstart']) : 0;
  $paginathionLimit=isset($_POST['limit']) ? stripslashes($_POST['limit']) : 50;

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


  $qeruStrPaginathion="SELECT COUNT(*) as resC FROM `kved10` ".( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
  $resultPa = mysqli_query($link,$qeruStrPaginathion);
  if($resultPa){
    $r=mysqli_fetch_array($resultPa, MYSQLI_ASSOC);
    $rowCount=$r['resC'];
  }
  mysqli_free_result($resultPa);
  if($rowCount>0){
    $pagination.=getPaginator($rowCount,$paginathionLimit,$paginathionLimitStart);
  }

  $whereStr = ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
  if($paginathionLimit!=0 ){

    $whereStr.=' LIMIT '.$paginathionLimitStart.','.$paginathionLimit;

  }




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

  $listPeriod= getListPeriod($link,0);
  $listYear= getListYear($link,0);

  require_once("../visual/fin_res_add.php");
?>
