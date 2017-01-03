<?
  class treeMenu{
    var $menuList;
    function treeMenu()
    {
      $this->menuList = array();
    }
    public function insertMenu($id, $menu)
    {
      if(!isset($this->menuList[$id])){
        $this->menuList[$id]=$menu;
      }
    }
    function getElement($id)
    {
      if(isset($this->menuList[$id])){
        return $this->menuList[$id];
      }else{
        return false;
      }
    }
    function getArrayChild()
    {
      return $this->menuList;
    }

    function printAll()
    {
      print_r($this->menuList);
    }
  }

  class menuItem
  {
    var  $listChild;
    var  $name;
    var  $path;
    var  $id;

    function menuItem($id,$name,$path)
    {
      $this->id=$id;
      $this->name=$name;
      $this->path=$path;
      $this->listChild=null;
    }

    function insertItem($id,$name,$path)
    {
      if($this->listChild==null){
        $this->listChild=array();
      }
      if(!isset($this->listChild[$id])){
        $this->listChild[$id]=new menuItem($id,$name,$path);
      }
    }

    function getItem($id)
    {
      return $this->listChild[$id];
    }


    function printInfo()
    {
      if($this->listChild!=null){
        echo $this->name." -- this name  ";
        if($this->listChild!=null){ print_r($this->listChild);}
        echo "<br>";
      }
    }
    function hasChild()
    {
      if($this->listChild!=null){
        return true;
      }else{
        return false;
      }
    }
  }

?>
