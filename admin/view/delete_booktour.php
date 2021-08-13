<?php
   
    $idBookTour=isset($_REQUEST["IDBookTour"]) ? $_REQUEST["IDBookTour"] : 0;
    


    $sql="DELETE FROM booktour where IDBookTour={$idBookTour}";
    
  
    
    //thuc hien cau truy van
   
    $ret = exec_update($sql);
   
    header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_booktour2");
    
    
    
?>