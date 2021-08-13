<?php
   
    $idTour=isset($_REQUEST["IDTour"]) ? $_REQUEST["IDTour"] : 0;
    

    $dataTour=select_one("select IDNoibat from tour where IDTour=$idTour");
   

    $sqlTour="DELETE FROM tour where IDTour=$idTour";
    
    
    $sqlDetailTour="DELETE FROM detailtour where IDDetailTour=$idTour";
   
    $sqlNoiBat="DELETE FROM NoiBat where IDNoiBat={$dataTour['IDNoibat']}";
   

    
    //thuc hien cau truy van
    $ret = exec_update($sqlDetailTour);
    $ret = exec_update($sqlTour);
    $ret = exec_update($sqlNoiBat);
    header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_tour");
    
    
?>