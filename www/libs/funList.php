<?
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


?>
