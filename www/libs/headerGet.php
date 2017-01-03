<?   require_once("../libs/classMenu.php");

  function getMein($link,$tree,$id_perent,$arr)
  {
    $mainMenu;
    if($id_perent!=0){
      $query="SELECT * FROM `menu` WHERE `id`=".$id_perent;
      $result=mysqli_query($link,$query);
      $row=mysqli_fetch_assoc($result);
      if($row["perent"]==0){
        $mainMenu= $tree->getElement($row["id"]);
        if($mainMenu==false){
          $tree->insertMenu($row["id"],new menuItem($row["id"],$row["name"],$row['path']));
        }
        $mainMenu= $tree->getElement($row["id"]);
      }else{
        $mainMenu=getMein($link,$tree,$row["perent"],$row);
        setChild($mainMenu,$row["perent"],$row);
      }
    }else{
      $mainMenu= (isset($tree->menuList[$arr["id"]]))?($tree->menuList[$arr["id"]]):(false);
      if($mainMenu==false){
        $tree->insertMenu($arr["id"],new menuItem($arr["id"],$arr["name"],$arr['path']));
        $mainMenu= $tree->menuList[$arr["id"]];
      }
    }
    return $mainMenu;
  }

  function setChild($tree,$parent,$arr)
  {
    if($tree->id==$parent){
      $tree->insertItem($arr["id"],$arr["name"],$arr["path"]);
      return true;
    }else{
      if($tree->listChild!=null){
        foreach ($tree->listChild as $key => $value) {
          if($key==$parent){
            $tree->listChild[$key]->insertItem($arr["id"],$arr["name"],$arr["path"]);
            return true;
          }else{
            if(setChild($tree->listChild[$key],$parent,$arr)){
              return true;
            }
          }
        }
      }else{
        return false;
      }
    }
  }

  function createCode($tree)
  {
    if($tree->name!=""){
      $code="<li>";
      $code.="<a href=\"".$tree->path."\">".$tree->name."</a>";
      if($tree->hasChild()){
        $result="<ul>";
        foreach ($tree->listChild as $key => $value) {
          $object=$tree->getItem($key);
            $result.=createCode($object);
        }
        $result.="</ul>";
      }
      $code.=((isset($result))?$result:'');
      $code.="</li>";
      return $code;
    }
    return "";
  }
  $query="SELECT t2.* FROM `menu_available` as t1  LEFT JOIN menu as t2 "
    ."on t1.`id_menu`=t2.id WHERE t1.`id_department` = 0"
    .((isset($_SESSION["id"]))?(" OR  t1.`id_department` =".$_SESSION["id"]):"")." GROUP BY t2.id";
  $result=mysqli_query($link,$query);
  echo mysqli_error($link);
  if ($result) {
    $tree=new treeMenu();
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $res=getMein($link,$tree,$row["perent"],$row);
      setChild($res,$row["perent"],$row);
    }
    $menuRes="";
    foreach ($tree->getArrayChild() as $key => $value) {
      $menuRes.=createCode($tree->getElement($key));
    }
  }
?>
