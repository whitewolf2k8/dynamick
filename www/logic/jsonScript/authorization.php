<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");

  $login=iconv("utf-8","windows-1251",$_POST["login"]);
  $password=iconv("utf-8","windows-1251",$_POST["password"]);
  $errorMessege="";


  $strSelect="SELECT * FROM `users` WHERE `name` LIKE('%s') AND `password` LIKE ('%s')";
  $result=mysqli_query($link,sprintf($strSelect,$login,md5($password)));
  if($result){
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)==1){
      if(isset($_SESSION)){
        session_unset();
        $_SESSION["name"]=$row["name"];
        $_SESSION["nu"]=$row["nu"];
        $_SESSION["id"]=$row["id"];
        $_SESSION["id_department"]=$row["id_department"];
      }else{
        $errorMessege.="Час сесії сплив, авторизуйтесь знову<br>";
      }
    }else{
      $errorMessege.="Не вірна пара Логін/Пароль<br>";
    }
  }else{
    $errorMessege.="Не можливо сформувати замит<br>";
  }

  echo php2js($errorMessege);

?>
