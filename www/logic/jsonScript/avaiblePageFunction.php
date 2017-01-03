<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");
  include_once("../../libs/funList.php");

  function getNameTable($val)
  {
    $path=iconv("utf-8","windows-1251",$val);
    $arrPath=parse_url($path);
    $str=explode("/", $arrPath['path']);
    return end($str);
  }

  $nameTable=getNameTable($_POST["path"]);

  if(!isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION["name"])){
    $id_departmnet=$_SESSION["id_department"];
  }

  $strQuery="SELECT * FROM `menu_available`as t1 LEFT JOIN `menu` as t2 on "
    ." t1.`id_menu`=t2.id WHERE t2.path LIKE('%".$nameTable."') AND "
    ."(t1.`id_department`=0 ".((isset($id_departmnet))?("OR t1.`id_department`=".$id_departmnet):"").")";

  $res=false;
  $result=mysqli_query($link,$strQuery);
  if($result){
    if(mysqli_num_rows($result)>0){
      $res=true;
    }
  }
  echo php2js($res);
?>
