<? include_once("setting.php");

  function connectingDb()
  {
    global $nameBd,$userNameBd,$passwordBd;
    $link = new mysqli('localhost', $userNameBd , $passwordBd, $nameBd);
    if (!$link) {
      die('������ ����������� (' . mysqli_connect_errno() . ') ');
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

?>
