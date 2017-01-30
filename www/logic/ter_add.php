<? require_once("../libs/setting.php");
  require_once("../libs/start.php");
  require_once("../libs/funList.php");

  $filtr_nu=(isset($_POST[nu_filtr]))?$_POST[nu_filtr]:'';
  $filtr_ter=(isset($_POST[ter_filtr]))?$_POST[ter_filtr]:'';
  $filtr_type=(isset($_POST[type_filtr]))?$_POST[type_filtr]:"-1";


  $MSG_info="";
  $MSG_error="";




  $action=(isset($_POST[mode]))?$_POST[mode]:'';

  if($action=="add"){
    $nu=(isset($_POST[nu]))?$_POST[nu]:'';
    $ter=(isset($_POST[ter]))?$_POST[ter]:'';
    $type=(isset($_POST[typeTer]))?$_POST[typeTer]:'';

    $strQuerySelect="SELECT id FROM `territories` WHERE `name` like ('".$nu."')"
      ."OR `ter` like ('".$ter."')  ";
    $result=mysqli_query($link,$strQuerySelect);
    if($result){
      if(mysqli_num_rows($result)==0){
        $strQueryInsert="INSERT INTO `territories`(`name`, `ter`, `type`)"
        ." VALUES ('".$nu."','".$ter."','".$type."')";
        mysqli_query($link,$strQueryInsert);
        if(mysqli_error($link)!=""){
          $MSG_error.="При доданні запису виникла помилка: ".mysqli_error($link);
        }else{
          $MSG_info.=" До бази даних було додано 1-ин запис.";
        }
      }else{
        $MSG_error.="Запис за такими данними існує, дані не було внесено.";
      }
      mysqli_free_result($result);
    }else{
      $MSG_error.="При доданні запису виникла помилка: ".mysqli_error($link);
    }
  }

  if($action=="update"){
    $res = explode(",",$_POST["arrItem"]);
    $count=0;
    foreach ($res as $key => $value) {
      if(preg_match("/^[0-9]{9,10}/",$_POST["ter_".$value])!=0 && !empty(delAllSpace($_POST["n_".$value])) && $_POST["type_".$value]!="-1"){
        $strUpdate="UPDATE `territories` SET `name`='".$_POST["n_".$value]
          ."',`ter`='".$_POST["ter_".$value]."',`type`='".$_POST["type_".$value]
          ."' WHERE id=".$value;
        mysqli_query($link,$strUpdate);
        if(mysqli_error($link)!=""){
          $MSG_error.=mysqli_error($link)."<br>";
        }else{
          $count++;
        }
      }else{
        $mes="";
        if(empty(delAllSpace($_POST["n_".$value]))){
          $mes.=" Назва території не може бути порожньою. ";
        }
        if(preg_match("/^[0-9]{9,10}/",$_POST["ter_".$value])==0){
          $mes.=" Код території не відповідає стандарту. ";
        }
        if ($_POST["type_".$value]=="") {
          $mes.=" Тип території повинен бути заданим. ";
        }
        $MSG_error.=$mes."<br>";
      }
    }
    if($count>0){
      $MSG_info=" При оновленні даних було оновлено ".$count." запис(ів).";
    }
  }


  if($action=="dell"){
    $res = explode(",",$_POST["arrItem"]);
    $count=0;
    foreach ($res as $key => $value) {
      $strDell="DELETE FROM `territories` WHERE id=".$value;
      mysqli_query($link,$strDell);
      if(mysqli_error($link)!=""){
        $MSG_error.=" Виникла помилка при видаленні запису ".mysqli_error($link)."<br>";
      }else{
        $count++;
      }
    }
    $MSG_info=" З бази даних було видалено ".$count." запис(ів).";
  }

  $where=array();

  if($filtr_nu!=""){
    $where[]=" name LIKE('%".$filtr_nu."%')";
  }

  if(delAllSpace($filtr_ter)!=""){
    $where[]=" ter LIKE('%".delAllSpace($filtr_ter)."%')";
  }

  if($filtr_type!="-1"){
    $where[]=" type = ".$filtr_type;
  }

  $whereStr = ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

  $strQuery="SELECT `id`, `name`, `ter`, `type` FROM `territories` ".$whereStr;
  $result=mysqli_query($link,$strQuery);
  if($result){
    $listResult=array();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["type"]=getTypeTerritory($row["type"]);
      $listResult[]=$row;
    }
  }

  $listTerritorySelect=getTypeTerritory((!empty($filtr_type)?$filtr_type:"-1"));
  $listTerritoryAdd=getTypeTerritory(((isset($type))?$type:"-1"));

  require_once("../visual/ter_add.php");
?>
