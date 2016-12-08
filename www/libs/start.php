<? include_once("setting.php");
  include_once("function.php");

  if(!isset ($_SESSION))
	{
    session_start();
	}
	$link=connectingDb();
?>
