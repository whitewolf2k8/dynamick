<? include_once("setting.php");

  function connectingDb()
  {
    global $nameBd,$userNameBd,$passwordBd;
    $link = new mysqli('localhost', $userNameBd , $passwordBd, $nameBd);
    if (!$link) {
      die('Ошибка подключения (' . mysqli_connect_errno() . ') ');
    }
    return $link;
  }

  function closeConnect($link)
  {
    mysqli_close($link);
  }

  function php2js($a=false){
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        $a = str_replace(",", ".", strval($a));
      }
      static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
      array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
      return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = php2js($v);
      return '[ ' . join(', ', $result) . ' ]';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = php2js($k).': '.php2js($v);
      return '{ ' . join(', ', $result) . ' }';
    }
  }

  function convertStringJSon($str)
  {
    return iconv("utf-8","windows-1251",$str);
  }

  function setMaxSession($max) {
    if(isset($_SESSION)){
      session_start();
    }
    $_SESSION['max'] = $max;
    session_write_close();
  }

  function calcTimeRun($startTime,$endTime){
    $time=$endTime-$startTime;
    $hours = floor($time/3600);
    $minutes = floor(($time/3600 - $hours)*60);
    $seconds =ceil(((($time/3600 - $hours)*60) - floor(($time/3600 - $hours)*60))*60);
    return "<br> Виконання скрипта зайняло  $hours годин $minutes хвилин $seconds секунд";
  }

  function changeCodingPage($string)
{
  $enc=((mb_detect_encoding($string)==false)?"cp866":mb_detect_encoding($string));
  if($enc!="cp866"){
    $result=$string;
    $result=replace_symvol($result,"ї","Є","є");
    $result=replace_symvol($result,"ў","І","і");
    $result=replace_symvol($result,"Ў","i","І");
    $result=replace_symvol($result,"°","Ї","ї");
    $result=replace_symvol($result,"•","Ї","ї");
    return  $result;
  }else{
        $result=$string;
        $result=replace_symvol($result,"ї","Є","є");
        $result=replace_symvol($result,"ў","І","і");
        $result=replace_symvol($result,"Ў","i","І");
        $result=replace_symvol($result,"°","Ї","ї");
        $result=replace_symvol($result,"•","Ї","ї");
        return $result;
  }
}

function replace_symvol($string,$sherch, $replaceU, $replaceL ){
    $result=$string;
    $pos=stripos($result, $sherch);
    while ($pos!==false){
			if("°"==$sherch||"•"==$sherch){
				$s="";
				if($pos==0){
					$s=$replaceU;
				}else{
					$s=(ctype_upper(substr($result, $pos-1,1))?$replaceU:$replaceL);
				}
			}else{
				$replace=((substr($result, $pos,1)!==$sherch)?$replaceU:$replaceL);
			}
      $result=substr_replace($result,$replace,$pos,1);
      $pos=stripos($result, $sherch);
    }
    return $result;
  }


  function getPaginator($total,$count=10,$now){
    $arrayCount= array(0,10,20,30,40,50,100);
    //проверка на нулевое количество страниц в выборе при первой загрузке пагинатора
    $count=($count=="")?50:$count;
    $result.="" ;
    if($count==0){
      $pageCount=round($total/1, 0, PHP_ROUND_HALF_UP);
    }else {
      $pageCount=round($total/$count, 0, PHP_ROUND_HALF_UP);
    }
    $result.="<div class='pagination'><p> В таблицю вибрано ".
    $total." записів. Показати в таблиці по "
      .'<select name="limits" size="1" onchange="submitFormLim(this.value)">';
    foreach($arrayCount as $v) {
      $result .= '<option value="'.$v.'"'.($count==$v ? ' selected="selected"' : '').'>'.($v==0 ? 'Все' : $v).'</option>';
    }
    $result.= '</select></p>';
    if($total>$count && $count!=0){
        $result.=createListPaginator($total,$count,$now)."</div>";
    }else {
      $result.="</div>";
    }
    return $result;
  }

function createListPaginator($total,$count=10,$now){
  $result.="";
  if($count!=0){
    $pageCount=ceil($total/$count);
    $currentPage=ceil($now/$count)+1;
    $currentGroup=ceil($currentPage/10);
    for ($i=0; $i < $total ; $i+=$count) {
      $page=ceil($i/$count)+1;
      $group=ceil($page/10);
      if ($currentGroup!=$group) {
        $result.= '<a class="page gradient" href="#" onclick="submitFormLimStart('.$i.');">'.$page.'-'.min($page+9, $pageCount).'</a>';# code...
        $i+=$count*9;
      }else{
        if ($currentPage==$page) {
          $result.="<span class='page active'>".$page."</span>";
        }else {
          $result .= '<a class="page gradient" href="#" onclick="submitFormLimStart('.$i.');">'.$page.'</a>';
        }
      }
    }
  }
  return $result;
}

?>
