<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");

  $action = iconv("utf-8","windows-1251",$_POST["action"]);
  $arrResult=array();
  $errorMessege="";

  if($action=="Add"){
    $nu = iconv("utf-8","windows-1251",$_POST["nu"]);
    $login=iconv("utf-8","windows-1251",$_POST["login"]);
    $password=iconv("utf-8","windows-1251",$_POST["password"]);
    $department=iconv("utf-8","windows-1251",$_POST["department"]);


    $strSelect="SELECT * FROM `users` WHERE `nu` LIKE('%s') AND `name` LIKE('%s') AND `password` LIKE ('%s')";
    $strInsert="INSERT INTO `users`( `nu`,`name`, `password`, `id_department`) VALUES ('%s','%s','%s','%s')";
    $result=mysqli_query($link,sprintf($strSelect,$nu,$login,md5($password)));
    if($result){
      $row=mysqli_fetch_assoc($result);
      if(mysqli_num_rows($result)>0){
        $errorMessege.=" Не можливо створити користувача. Користувач з такими данними вже існує.<br>";
      }else{
        mysqli_query($link,sprintf($strInsert,$nu,$login,md5($password),$department));
      }
      mysqli_free_result($result);

    }
  }

  $str="SELECT * FROM `users`";
  $result=mysqli_query($link,$str);
  if($result){
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $arrResult["select"][]=$row;
    }
    mysqli_free_result($result);
  }

  $arrResult["error"]=$errorMessege;

  echo php2js($arrResult);
?>
