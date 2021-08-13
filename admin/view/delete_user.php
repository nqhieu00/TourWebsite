<?php

    $id=$_GET['id'];
   
    $sql="DELETE FROM admin where adminID='$id'";
    $ret = exec_update($sql);
    //thuc hien cau truy van
  
    header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_users");

?>