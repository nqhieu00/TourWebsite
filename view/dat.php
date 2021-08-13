<?php
include '../lib/lib_db.php';
if(isset($_POST["submit"])){
        $Name = $_POST["Name"];
        $Email = $_POST["Email"];
        $Phone =$_POST["Phone"];
        $Addr = $_POST["Addr"];
        $Note = $_POST["Note"];
        $Adult = $_POST["QAdult"];
        $Child = $_POST["QChild"];
        $Bady = $_POST["QBaby"];
        $Infant = $_POST["QInfant"];
        $SoLuong=$Adult+$Child+$Bady+$Infant;
        $GiaTien=$_REQUEST['GiaTien'];
        $TongTien= $Adult*$GiaTien+$Child*$GiaTien*0.5+$Bady*$GiaTien*0.3+$Infant*$GiaTien*0.1;
        $TinhTrang="Chưa nhận";
        $IDTour=$_REQUEST['IDTour'];
        
        //tao sql
        $databooktour["Name"] =  $Name;
        $databooktour["Email"] = $Email;
        $databooktour["Phone"] =  $Phone;
        $databooktour["Addr"] =  $Addr;
        $databooktour["Note"] = $Note;
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $databooktour["ThoiGianDat"]=date("Y-m-d h:m:s");
        $databooktour["NguoiLon"] =  $Adult;
        $databooktour["TreEm"] =  $Child;
        $databooktour["TreNho"] =  $Bady;
        $databooktour["SoSinh"] =  $Infant;
        $databooktour["TongTien"] =  $TongTien;
        $databooktour["IDTour"] =  $IDTour;
        $databooktour["TinhTrang"] =  $TinhTrang;
        $tblbooktour = "booktour";
        $sqlbooktour = data_to_sql_insert( $tblbooktour,  $databooktour);
      
        $ret = exec_update($sqlbooktour);
       
        header("Location: http://localhost/cnw/view/index.php");

    }
    ?>