<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");
  include_once("../../libs/funList.php");

  $action = iconv("utf-8","windows-1251",$_POST["action"]);
  $arrResult=array();
  $errorMessege="";
  $infoMessege="";

  if($action=="Add"){
    $nu = iconv("utf-8","windows-1251",$_POST["nu"]);
    $login=iconv("utf-8","windows-1251",$_POST["login"]);
    $password=iconv("utf-8","windows-1251",$_POST["password"]);
    $department=iconv("utf-8","windows-1251",$_POST["department"]);


    $strSelect="SELECT * FROM `users` WHERE `nu` LIKE('%s') AND `name` LIKE('%s')";
    $strInsert="INSERT INTO `users`( `nu`,`name`, `password`, `id_department`) VALUES ('%s','%s','%s','%s')";
    $result=mysqli_query($link,sprintf($strSelect,$nu,$login,md5($password)));
    if($result){
      $row=mysqli_fetch_assoc($result);
      if(mysqli_num_rows($result)>0){
        $errorMessege.=" �� ������� �������� �����������. ���������� � ������ ������� ��� ����.<br>";
      }else{
        mysqli_query($link,sprintf($strInsert,$nu,$login,md5($password),$department));
      }
      mysqli_free_result($result);

    }
  }

  if($action=="Del"){
    $count=0;
    $array = $_POST["arrId"];
    $queryStr="DELETE FROM `users` WHERE `id`=%s";
    foreach ($array as $key => $value) {
      mysqli_query($link,sprintf($queryStr,$value));
      $count++;
    }
    $infoMessege="� ���� ������ ���� �������� ".$count."������������";
    $errorMessege=mysqli_error($link);
  }

  if($action=="Update"){
    $count=0;
    $array=json_decode($_POST["arrId"]);
    $strSelect="SELECT id FROM `users` WHERE `nu` LIKE('%s') AND `name` LIKE('%s')";
    $strUpdate="UPDATE `users` SET `name`='%s',`password`='%s',`id_department`='%s',`nu`='%s' WHERE `id`=%s";
    foreach ($array as $key => $value) {
      if($value[0]!="" && $value[1]!="" && $value[2]!="" && $value[3]!=0){
        mysqli_query($link,sprintf($strUpdate,convertStringJSon($value[1]),
          convertStringJSon($value[2]),convertStringJSon($value[3]),
          convertStringJSon($value[0]),$value[4]));
        $errorMessege.=(mysqli_error($link)!="")?(mysqli_error($link)."<br>"):"";
        if(mysqli_error($link)==""){
          $count++;
        }
      }
      if($value[0]==""){
        $errorMessege.="����������� ��� ���� \"��&#8242;�\" ���� �� ���������. <br> ";
      }
      if($value[1]==""){
        $errorMessege.="����������� ��� ���� \"����\" ���� �� ���������. <br> ";
      }
      if($value[2]==""){
        $errorMessege.="����������� ��� ���� \"������\" ���� �� ���������. <br> ";
      }
      if($value[3]==""){
        $errorMessege.="����������� ��� ���� \"³���\" ���� �� ���������. <br> ";
      }
    }
    $infoMessege="� ��� ������ ���� �������� ".$count." �����(��)";
  }

  $str="SELECT * FROM `users`";
  $result=mysqli_query($link,$str);
  if($result){
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $row["id_department"]=getListDeparmtent($link,$row["id_department"]);
      $arrResult["select"][]=$row;
    }
    mysqli_free_result($result);
  }

  $arrResult["error"]=$errorMessege;
  $arrResult["info"]=$infoMessege;

  echo php2js($arrResult);
?>
