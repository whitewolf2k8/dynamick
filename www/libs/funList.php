<? include_once("setting.php");
  function getListDeparmtent($link, $id,$type=0,$mes=" - не обрано - ")
  {
    $resultingStr="";
    $strQuery="SELECT * FROM `department`  ".(($type!=0)?("WHERE `activity`= 1"):"");
    $result=mysqli_query($link,$strQuery);
    $resultingStr.="<option value=\"0\" ".(($id==0)?"selected":"")." >".$mes."</option>";
    if($result){
      while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultingStr.="<option value=\"".$row["id"]."\" ".(($id==$row["id"])?"selected":"")
          ." ".(($row["activity"]==0)?"disabled":"")." >".$row["nu"]."</option>";
      }
    }
    return $resultingStr;
  }


  function getListDeparmtentForAvaible($link, $id,$type=0,$mes=" - не обрано - ")
  {
    $resultingStr="";
    $strQuery="SELECT * FROM `department`  ".(($type!=0)?("WHERE `activity`= 1"):"");
    $result=mysqli_query($link,$strQuery);
    $resultingStr.="<option value=\"-1\" ".(($id=='-1')?"selected":"")." > - не обрано - </option>";
    $resultingStr.="<option value=\"0\" ".(($id==0)?"selected":"")." >".$mes."</option>";
    if($result){
      while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultingStr.="<option value=\"".$row["id"]."\" ".(($id==$row["id"])?"selected":"")
          ." ".(($row["activity"]==0)?"disabled":"")." >".$row["nu"]."</option>";
      }
    }
    return $resultingStr;
  }

  function getListMainMenu($link, $id,$mes=" - голвне меню - ")
  {
    $resultingStr="";
    $strQuery="SELECT `id`, `name` FROM `menu` WHERE `path` LIKE('#')";
    $result=mysqli_query($link,$strQuery);
    $resultingStr.="<option value=\"0\" ".(($id==0)?"selected":"")." >".$mes."</option>";
    if($result){
      while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultingStr.="<option value=\"".$row["id"]."\" ".(($id==$row["id"])?"selected":"").
        " >".$row["name"]."</option>";
      }
    }
    return $resultingStr;
  }

  function getListMenu($link, $id,$mes=" - всі - ")
  {
    $resultingStr="";
    $strQuery="SELECT `id`, `name` FROM `menu`";
    $result=mysqli_query($link,$strQuery);
    $resultingStr.="<option value=\"0\" ".(($id==0)?"selected":"")." >".$mes."</option>";
    if($result){
      while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultingStr.="<option value=\"".$row["id"]."\" ".(($id==$row["id"])?"selected":"").
        " >".$row["name"]."</option>";
      }
    }
    return $resultingStr;
  }

  function getListPeriod($link, $id,$mes=" - не обрано - ")
  {
    $resultingStr="";
    $strQuery="SELECT `id`, `nu` FROM `period` ";
    $result=mysqli_query($link,$strQuery);
    $resultingStr.="<option value=\"0\" ".(($id==0)?"selected":"")." >".$mes."</option>";
    if($result){
      while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultingStr.="<option value=\"".$row["id"]."\" ".(($id==$row["id"])?"selected":"").
        " >".$row["nu"]."</option>";
      }
    }
    return $resultingStr;
  }


  function getListYear($link, $id,$mes=" - не обрано - ")
  {
    $resultingStr="";
    $strQuery="SELECT `id`, `nu` FROM `year`";
    $result=mysqli_query($link,$strQuery);
    $resultingStr.="<option value=\"0\" ".(($id==0)?"selected":"")." >".$mes."</option>";
    if($result){
      while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $resultingStr.="<option value=\"".$row["id"]."\" ".(($id==$row["id"])?"selected":"").
        " >".$row["nu"]."</option>";
      }
    }
    return $resultingStr;
  }


  function getTypeTerritory($id,$mes="- не обрано -")
  {
    global $type_ter;
    $str="<option value=\"-1\" ".(($id=="-1")?"selected":"").">".$mes."</option>";
    foreach ($type_ter as $key => $value) {
      $str.="<option ".(($key==$id)?"selected":"")." value=\"".$key."\" >".$value."</option>";
    }
    return $str;
  }

?>
