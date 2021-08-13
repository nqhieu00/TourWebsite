<?php
	//print_r($_GET);
	//print_r($_POST);
	//print_r($_POST);exit();
	//echo "Banj dang dinh them ban ghi";exit();
	
	//print_r($_FILES);exit();
	
	// $data = array();
	$IDBookTour= isset($_POST["IDBookTour"]) ? $_POST["IDBookTour"] : 0;
    $IDTour= isset($_POST["IDTour"]) ? $_POST["IDTour"] : 0;
    $Name= isset($_POST["Name"]) ? $_POST["Name"] : "";
    $Phone= isset($_POST["Phone"]) ? $_POST["Phone"] : "";
    $Email= isset($_POST["Email"]) ? $_POST["Email"] : "";
    $Addr= isset($_POST["Addr"]) ? $_POST["Addr"] : "";
    $Note= isset($_POST["Note"]) ? $_POST["Note"] : "";
    $ThoiGianDat= isset($_POST["ThoiGianDat"]) ? $_POST["ThoiGianDat"] : "";
    $TinhTrang= isset($_POST["TinhTrang"]) ? $_POST["TinhTrang"] : "";
    $Adult = isset($_POST["QAdult"]) ? $_POST["QAdult"] : 0;
    $Child =isset($_POST["QChild"]) ? $_POST["QChild"] : 0;
    $Bady = isset($_POST["QBaby"]) ? $_POST["QBaby"] : 0;
    $Infant =isset($_POST["QInfant"]) ? $_POST["QInfant"] : 0;
    $GiaTien=isset($_REQUEST["GiaTien"]) ? $_REQUEST["GiaTien"] : 0;
    $TongTien= $Adult*$GiaTien+$Child*$GiaTien*0.5+$Bady*$GiaTien*0.3+$Infant*$GiaTien*0.1;
	$data["Name"] = $Name;
	$data["Phone"] = $Phone;
	$data["Email"] = $Email;
	$data["Addr"] = $Addr;
	$data["Note"] = $Note;
	$data["ThoiGianDat"] = $ThoiGianDat;
    $data["Note"] = $Note;
    $data["TinhTrang"] = $TinhTrang;
    $data["NguoiLon"] =  $Adult;
    $data["TreEm"] =  $Child;
        $data["TreNho"] =  $Bady;
        $data["SoSinh"] =  $Infant;
        $data["TongTien"] = $TongTien;
        $data["IDTour"]=$IDTour;
	$tbl = "booktour";
    $cond = "IDBookTour={$IDBookTour}";
	$sql = data_to_sql_update($tbl, $data,$cond);
    $ret = exec_update($sql);
    $TinhTrangBanDau= isset($_POST["TinhTrangBanDau"]) ? $_POST["TinhTrangBanDau"] : "";
    $SoLuongThayDoi=$Adult+$Child+$Bady+$Infant;
    $SoLuongBanDau= isset($_POST["SoLuongBanDau"]) ? $_POST["SoLuongBanDau"] : 0;
    $soLuong=select_one("select SoLuong from tour where idtour={$IDTour}");
    if($TinhTrang=="Đã nhận" and $TinhTrang!=$TinhTrangBanDau){
       
        $dataTour["SoLuong"]=$soLuong["SoLuong"]-$SoLuongThayDoi;
        $tbltour = "tour";
        $condtour = "IDTour = {$IDTour}";
        $sqltour = data_to_sql_update($tbltour, $dataTour,$condtour);
        $ret = exec_update($sqltour);
    }
    else if($TinhTrang=="Chưa nhận" and $TinhTrang!=$TinhTrangBanDau){
        $dataTour["SoLuong"]=$soLuong["SoLuong"]+$SoLuongThayDoi;
        $tbltour = "tour";
        $condtour = "IDTour = {$IDTour}";
        $sqltour = data_to_sql_update($tbltour, $dataTour,$condtour);
        $ret = exec_update($sqltour);
    }
    else if($TinhTrang=="Đã nhận" and $TinhTrang==$TinhTrangBanDau){
        $dataTour["SoLuong"]=$soLuong["SoLuong"]+$SoLuongBanDau-$SoLuongThayDoi;
        $tbltour = "tour";
        $condtour = "IDTour = {$IDTour}";
        $sqltour = data_to_sql_update($tbltour, $dataTour,$condtour);
        $ret = exec_update($sqltour);
    }
    if($TinhTrangBanDau=="Chưa nhận"){
        header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_booktour1");
    }
    else{
        header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_booktour2");
    }
    
   
	//print_r($sql);exit();
	
	//print_r($ret);exit();
   
?>