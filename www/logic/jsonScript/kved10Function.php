<? include_once("../../libs/start.php");
  include_once("../../libs/setting.php");
  include_once("../../libs/funList.php");



  $action=$_POST["action"];

  $ERROR_MSG="";
  $INFO_MSG="";

  if($action=="load"){
    $start = microtime(true);
    set_time_limit(90000);
    if (!file_exists($tmpFile=$_FILES["file_upload"]['tmp_name'])) {
      $ERROR_MSG .= 'Помилка завантаження файлу! <br/>';
      setMaxSession("");
    }else {
      $db = dbase_open($tmpFile, 0);
      if ($db) {
          $countUpdate=0;
          $countInsert=0;
          // чтение некотрых данных
          $querySelect = "SELECT * FROM `kved10` WHERE (`kod`LIKE ?) and (`sek`LIKE ?)";
          $queryUpdate = "UPDATE `kved10` SET`sek`=?,`kod`=?,`nu`=? WHERE (`kod`LIKE ?) and (`sek`LIKE ?)";
          $queryInsert = "INSERT INTO `kved10`(`sek`, `kod`, `nu`) VALUES (?,?,?)";
          $stmtSelect = mysqli_stmt_init($link);
          $stmtUpdate = mysqli_stmt_init($link);
          $stmtInsert = mysqli_stmt_init($link);

          $rowCount=dbase_numrecords ($db);

          if((!mysqli_stmt_prepare($stmtSelect, $querySelect))||(!mysqli_stmt_prepare($stmtInsert, $queryInsert))||(!mysqli_stmt_prepare($stmtUpdate, $queryUpdate)))
          {
            $ERROR_MSG.="<br> Помилка Підготовки запиту \n <br>";
          } else{
            mysqli_stmt_bind_param($stmtInsert, "sss",$sek,$kod,$nu);
            mysqli_stmt_bind_param($stmtSelect, "ss", $kodS,$sekS);
            mysqli_stmt_bind_param($stmtUpdate, "sssss",$sekU,$kodU,$nuU,$kodUS,$sekUS);
            setMaxSession($rowCount);
            for($i=1;$i<=$rowCount;$i++){
              $row= dbase_get_record_with_names ( $db , $i);
              $kodS=$row["KOD"];
              $sekS=$row["SEK"];
              mysqli_stmt_execute($stmtSelect);
              $result = mysqli_stmt_get_result($stmtSelect);
              if(mysqli_num_rows($result)>0){
                $sekU = $row["SEK"];
                $kodU = $row["KOD"];

                $nuU = changeCodingPage($row['NU']);
                $kodUS =$row['KOD'];
                $sekUS = $row["SEK"];
                mysqli_stmt_execute($stmtUpdate);
                $countUpdate+=1;
              } else {
                $sek = $row["SEK"];
                $kod = $row["KOD"];
                $nu = changeCodingPage($row['NU']);
                mysqli_stmt_execute($stmtInsert);
                $countInsert+=1;
              }
              mysqli_free_result($result);
              session_start();
              $_SESSION['ls_sleep_test'] = $i;
              session_write_close();
            }
          mysqli_stmt_close($stmtSelect);
          mysqli_stmt_close($stmtInsert);
          mysqli_stmt_close($stmtUpdate);
          $INFO_MSG.=" Записів оновлено ".$countUpdate." . <br>";
          $INFO_MSG.= " Додано записів ".$countInsert." . <br>";
          $INFO_MSG.= " З файлу запитано  ".$rowCount." записів. <br>";
          $INFO_MSG.= "Скрипт виконувався протягом ".calcTimeRun($start,microtime(true))."<br>";
          dbase_close($db);
        }
      }
    }
  }

  if($action=="Update"){
      $count=0;
      $array=json_decode($_POST["arrId"]);
      $strUpdate="UPDATE `kved10` SET `sek`='%s',`kod`='%s',`nu`='%s' WHERE `id`=%s";
      foreach ($array as $key => $value) {
        if($value[0]!="" && $value[1]!="" && $value[2]!=""){
          mysqli_query($link,sprintf($strUpdate,convertStringJSon($value[1]),
            convertStringJSon($value[2]),convertStringJSon($value[3]),
            convertStringJSon($value[0]),$value[4]));
          $errorMessege.=(mysqli_error($link)!="")?(mysqli_error($link)."<br>"):"";
          if(mysqli_error($link)==""){
            $count++;
          }
        }
        if($value[0]==""){
          $errorMessege.="Недопустимо щоб поле \"Ім&#8242;я\" було не заповнено. <br> ";
        }
        if($value[1]==""){
          $errorMessege.="Недопустимо щоб поле \"Логін\" було не заповнено. <br> ";
        }
        if($value[2]==""){
          $errorMessege.="Недопустимо щоб поле \"Пароль\" було не заповнено. <br> ";
        }
        if($value[3]==""){
          $errorMessege.="Недопустимо щоб поле \"Відділ\" було не заповнено. <br> ";
        }
      }
      $infoMessege="В базі данних було оновлено ".$count." запис(ів)";
  }







  /*for ($i=0; $i <100 ; $i++) {
   session_start();
   $_SESSION['ls_sleep_test'] = $i;
   session_write_close();
   sleep(1);
 }*/

  echo php2js('finish');
?>
