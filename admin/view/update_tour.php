<?php
    include "header.php";
   
    $idTour=isset($_REQUEST["IDTour"]) ? $_REQUEST["IDTour"] : 0;
    $sql1 = "SELECT * from tour where IDTour='$idTour'";
    $sql2="SELECT * from detailtour where IDDetailTour='$idTour'";
    $row=select_one($sql1);
    $row2=select_one($sql2);
    $temp1=$row['Image'];
    $temp2=$row2['Image'];
    $idNoiBat=$row['IDNoiBat'];
   
    $sqlNoiBat="select * from NoiBat where IDNoiBat=$idNoiBat";
    $dataNoiBat=select_one($sqlNoiBat);
    
    if(isset($_POST["submit"])){
        if(isset($_POST['checkboxNoiBat'])){
            if($idNoiBat==0){
                
                $indexNoiBat=select_one("select count(*) from noibat");
                $idNoiBat=select_list("select idnoibat from noibat");
                $getIDNoiBat=getID($indexNoiBat['count(*)'],$idNoiBat);
              
               

                $GiamGia=isset($_POST["GiamGia"])?$_POST["GiamGia"]:0;
                $ThoiGian= isset($_POST["ThoiGian"])?$_POST["ThoiGian"]:"";

                $dataNoiBat["IDNoiBat"] =  $getIDNoiBat;
                $dataNoiBat["GiamGia"] = $GiamGia;
                $dataNoiBat["ThoiGian"] =  $ThoiGian;
                $tblNoiBat = "NoiBat";
                $sqlNoiBat = data_to_sql_insert( $tblNoiBat,  $dataNoiBat);
                $ret = exec_update($sqlNoiBat);
               
                $dataTour["IDNoiBat"] = $getIDNoiBat;
                $tblTour = "tour";
                $cond = "IDTour={$idTour}";
                $sqlTour = data_to_sql_update($tblTour, $dataTour,$cond);
            //print_r($sql);exit();
                $ret = exec_update($sqlTour);
                $idNoiBat=$getIDNoiBat;
            }
            else{
                $GiamGia=isset($_POST["GiamGia"])?$_POST["GiamGia"]:0;;
                $ThoiGian= isset($_POST["ThoiGian"])?$_POST["ThoiGian"]:"";;

               

                $dataNoiBat["GiamGia"] = $GiamGia;
                $dataNoiBat["ThoiGian"] =  $ThoiGian;
                $cond="IDNoiBat={$idNoiBat}";
                $tblNoiBat = "NoiBat";
                $sqlNoiBat = data_to_sql_update( $tblNoiBat,  $dataNoiBat,$cond);
                $ret = exec_update($sqlNoiBat);
            }
            
        //print_r($sql);exit();
               
        }
        else{
            if($idNoiBat!=0){
                $tblTour = "tour";
                $cond = "IDTour={$idTour}";
                $data['IDNoiBat']=0;
                $sqlTour = data_to_sql_update($tblTour, $data,$cond);
                $ret = exec_update($sqlTour);

                $sqlNoiBat="DELETE FROM NoiBat where IDNoiBat=$idNoiBat";
                $ret = exec_update($sqlNoiBat);
               
                $idNoiBat=0;
            }

        }
        $idTour=isset($_POST["idTour"])?$_POST["idTour"]:0;
        $nameTour= isset($_POST["NameTour"])?$_POST["NameTour"]:"";
        $ngaykhoihanh= isset($_POST["NgayKhoiHanh"])?$_POST["NgayKhoiHanh"]:"";
        $lichtrinh= isset($_POST["LichTrinh"])?$_POST["LichTrinh"]:"";
        $giatien= isset($_POST["GiaTien"])?$_POST["GiaTien"]:0;
        $diemxuatphat= isset($_POST["NoiKhoiHanh"])?$_POST["NoiKhoiHanh"]:"";
        $vungmien= isset($_POST["IDVungMien"])?$_POST["IDVungMien"]:0;
        $vanchuyen= isset($_POST["PhuongTien"])?$_POST["PhuongTien"]:"";
        $sochongoi= isset($_POST["SoLuong"])?$_POST["SoLuong"]:0;
        

        $images="../public/images/".$_POST["image"];
       
        $CTlichtrinh= isset($_POST["CTLichTrinh"])?$_POST["CTLichTrinh"]:"";
        $ghichu= isset($_POST["GhiChu"])?$_POST["GhiChu"]:"";
        $dichvu= isset($_POST["DichVu"])?$_POST["DichVu"]:"";
        $text=isset($_POST["Text"])?$_POST["Text"]:"";
        $imagechitiet="../public/images/".$_POST["imageCT"];
       

        if($images=="../public/images/"){
            $images=$temp1;
        }
        if($imagechitiet==  "../public/images/"){
            $imagechitiet=$temp2;
        }

        
        $dataTour["NameTour"] = $nameTour;
        $dataTour["LichTrinh"] = $lichtrinh;
        $dataTour["PhuongTien"] = $vanchuyen;
        $dataTour["SoLuong"] = $sochongoi;
        $dataTour["NgayKhoiHanh"] = $ngaykhoihanh;
        $dataTour["Image"] = $images;
        $dataTour["NoiKhoiHanh"] = $diemxuatphat;
        $dataTour["GiaTien"] = $giatien;
        $dataTour["IDVungMien"] = $vungmien;
        $dataTour["IDNoiBat"] = $idNoiBat;
        $tblTour = "tour";
        $cond = "IDTour={$idTour}";
        $sqlTour = data_to_sql_update($tblTour, $dataTour,$cond);
	//print_r($sql);exit();
	    $ret = exec_update($sqlTour);
      
        $dataDetailTour["LichTrinh"] = $CTlichtrinh;
        $dataDetailTour["GhiChu"] = $ghichu;
        $dataDetailTour["DichVu"] = $dichvu;
        $dataDetailTour["Text"] = $text;
        $dataDetailTour["Image"] = $imagechitiet;
        $tblDetailTour = "detailtour";
        $cond = "IDDetailTour={$idTour}";
        $sqlDetailTour = data_to_sql_update($tblDetailTour, $dataDetailTour,$cond);
	//print_r($sql);exit();
	    $ret = exec_update($sqlDetailTour);
        header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_tour");
       
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <title>QUẢN LÍ DU LỊCH TRONG NƯỚC</title>
</head>

<body>
<h3>Update tour </h3>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control" name="idTour" value="<?php echo $idTour; ?>">
                <label for="name" class="col-sm-12">Tiêu đề: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" autofocus  required class="form-control"
                        name="NameTour" value="<?php echo $row['NameTour']; ?>"></div>
                <label for="name" class="col-sm-12">Ảnh:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <input type='file' id="imgInp1"  name="image" />
                    <img id="blah1"   class="img-responsive"  src="<?php echo $row['Image'];?>" alt="your image" />
                </div>
                <label for="name" class="col-sm-12">Ngày khởi hành: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="date"  required class="form-control"
                        name="NgayKhoiHanh" value="<?php echo $row['NgayKhoiHanh']; ?>"></div>

                <label for="name" class="col-sm-12">Lịch trình: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="LichTrinh" value="<?php echo $row['LichTrinh']; ?>"></div>
                <label for="name" class="col-sm-12">Giá tiền: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="GiaTien" value="<?php echo $row['GiaTien']; ?>"></div>

                <label for="name" class="col-sm-12">Điểm xuất phát: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="NoiKhoiHanh" value="<?php echo $row['NoiKhoiHanh']; ?>"></div>

                <label for="name" class="col-sm-1">Nổi bật </label>
                <?php if($row['IDNoiBat']==0){
                    ?>
                <div class="col-sm-11" style="  margin-bottom:20px">    
                    <input type="checkbox" id="myCheck" onclick="NoiBat()" class="col-sm-1 checkbox" value="" name="checkboxNoiBat">
                    <label for="" style="display: none; margin:0" class="NoiBat col-sm-2">Thời gian</label>
                    <input type="date" name="ThoiGian" class="NoiBat col-sm-2 "   style="display: none;margin:0">
                    <label for="" style="display: none;margin:0" class="NoiBat col-sm-2">Giảm giá</label>
                    <input type="text" name="GiamGia" class="NoiBat col-sm-2"   style="display: none;margin:0">
                </div>
                    <?php
                }
                    else{
                        ?>
                        <input type="checkbox" id="myCheck" onclick="NoiBat()"   class="col-sm-1 checkbox" value="" checked name="checkboxNoiBat">
                    <label for="" style="display: inline; margin:0" class="NoiBat col-sm-2">Thời gian</label>
                    <input type="date" name="ThoiGian" class="NoiBat col-sm-2 "  value="<?php echo($dataNoiBat['ThoiGian']) ?>" style="display:  inline;margin:0">
                    <label for="" style="display:  inline;margin:0" class="NoiBat col-sm-2">Giảm giá</label>
                    <input type="text" name="GiamGia" class="NoiBat col-sm-2"   value="<?php echo($dataNoiBat['GiamGia']) ?>" style="display: inline;margin:0">
                    <?php
                    
                } 
                ?>
               

                <label for="name" class="col-sm-12">Vùng miền: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"><select  class="form-control" name="IDVungMien" >
                    <?php $data=select_list("select * from vungmien"); foreach($data as $values){
                      ?>
                        <option value="<?php echo $values['IDVungMien'] ?>"><?php echo $values['TenMien'] ?></option>
                     <?php  } ?> </select> </div>

                <label for="name" class="col-sm-12">Xe: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="PhuongTien" value="<?php echo $row['PhuongTien']; ?>"></div>

                <label for="name" class="col-sm-12">Số chỗ ngồi: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="SoLuong" value="<?php echo $row['SoLuong']; ?>"></div>
                <label for="name" class="col-sm-12">Ảnh chi tiết tour: </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <input type='file' id="imgInp2" name="imageCT" />    
                    <img id="blah2"  class="img-responsive" src="<?php echo $row2['Image'];?>" alt="your image" />
                </div>
                <label for="name" class="col-sm-12">Chi tiết lịch trình: </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="CTLichTrinh"
                         ><?php echo $row2['LichTrinh'] ?></textarea>
                </div>

                <label for="name" class="col-sm-12">Ghi Chú: </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="GhiChu"
                     ><?php echo $row2['GhiChu'] ?></textarea>
                </div>

                <label for="name" class="col-sm-12">Dịch vụ:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="DichVu"
                       ><?php echo $row2['DichVu'] ?></textarea>
                </div>
                <label for="name" class="col-sm-12">Mô tả chuyến đi:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="Text"
                       ><?php echo $row2['Text'] ?></textarea>

                </div>
                <div class="col-sm-12" style="text-align:center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Cập Nhập">
                </div>
            </div>
        </form>
    </div>
    <script>
        $("#imgInp1").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                   
                    $('#blah1').attr('src', e.target.result);
                    
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });
        $("#imgInp2").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                   
                    $('#blah2').attr('src', e.target.result);
                    
                }

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }
        });
        function NoiBat() {
            var checkBox = document.getElementById("myCheck");
            if (checkBox.checked == true){
                $(".NoiBat").css("display","inline");
                $(".checkbox").val('1');
            } else {
                $(".NoiBat").css("display","none");
                $(".checkbox").val('0');
            }
        }
       
    </script>
</body>

</html>