<?php
    include "header.php";
    
    if(isset($_POST["submit"])){
        if(isset($_POST['checkboxNoiBat'])){
            $indexNoiBat=select_one("select count(*) from noibat");
            $arr=array();
            $idNoiBat=select_list("select idnoibat from noibat");
            $getIDNoiBat=getID($indexNoiBat['count(*)'],$idNoiBat);
            $GiamGia=$_POST["GiamGia"];
            $ThoiGian= $_POST["ThoiGian"];

            $dataNoiBat["IDNoiBat"] =  $getIDNoiBat;
            $dataNoiBat["GiamGia"] = $GiamGia;
            $dataNoiBat["ThoiGian"] =  $ThoiGian;
            $tblNoiBat = "NoiBat";
            $sqlNoiBat = data_to_sql_insert( $tblNoiBat,  $dataNoiBat);
        //print_r($sql);exit();
            $ret = exec_update($sqlNoiBat);
        }
        else{
            
            $getIDNoiBat=0;

        }
        $idTour=$_POST["idTour"];
        $nameTour= $_POST["NameTour"];
        $ngaykhoihanh= $_POST["NgayKhoiHanh"];
        $lichtrinh= $_POST["LichTrinh"];
        $giatien= $_POST["GiaTien"];
        $diemxuatphat= $_POST["NoiKhoiHanh"];
        
        $vungmien= $_POST["IDVungMien"];
        $vanchuyen= $_POST["PhuongTien"];
        $sochongoi= $_POST["SoLuong"];
        $images="../public/images/".$_POST["image"];
      
       
        $CTlichtrinh= $_POST["CTLichTrinh"];
        $ghichu= $_POST["GhiChu"];
        $dichvu= $_POST["DichVu"];
        $text=$_POST["Text"];
        $imagechitiet="../public/images/".$_POST["imageCT"];
        
        $index="select count(*)from tour";
        $dataindex=select_one($index);
        
        $setIndex="ALTER TABLE tour AUTO_INCREMENT=".$dataindex['count(*)'];
        $datasetIndex=exec_update($setIndex);

        $setIndex1="ALTER TABLE detailtour AUTO_INCREMENT=".$dataindex['count(*)'];
        $datasetIndex1=exec_update($setIndex1);

        $dataTour["NameTour"] = $nameTour;
        $dataTour["LichTrinh"] = $lichtrinh;
        $dataTour["PhuongTien"] = $vanchuyen;
        $dataTour["SoLuong"] = $sochongoi;
        $dataTour["NgayKhoiHanh"] = $ngaykhoihanh;
        $dataTour["Image"] = $images;
        $dataTour["NoiKhoiHanh"] = $diemxuatphat;
        $dataTour["GiaTien"] = $giatien;
        $dataTour["IDVungMien"] = $vungmien;
        $dataTour["IDNoiBat"] = $getIDNoiBat;
        $tblTour = "tour";
        $sqlTour = data_to_sql_insert($tblTour, $dataTour);
	//print_r($sql);exit();
	    $ret = exec_update($sqlTour);
        
        $dataDetailTour["LichTrinh"] = $CTlichtrinh;
        $dataDetailTour["GhiChu"] = $ghichu;
        $dataDetailTour["DichVu"] = $dichvu;
        $dataDetailTour["Text"] = $text;
        $dataDetailTour["Image"] = $imagechitiet;
        $tblDetailTour = "detailtour";
        $sqlDetailTour = data_to_sql_insert($tblDetailTour, $dataDetailTour);
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
    <h3>Add tour </h3>
    <div class="container">
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control" name="idTour" value="<?php echo $idTour; ?>">
                <label for="name" class="col-sm-12">Tiêu đề: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" autofocus  required class="form-control"
                        name="NameTour" ></div>
                <label for="name" class="col-sm-12">Ảnh:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <input type='file' id="imgInp1"  required name="image" />
                    <img id="blah1"   class="img-responsive"   />
                </div>
                <label for="name" class="col-sm-12">Ngày khởi hành: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="date"  required  class="form-control"
                        name="NgayKhoiHanh" ></div>

                <label for="name" class="col-sm-12">Lịch trình: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="LichTrinh" ></div>
                <label for="name" class="col-sm-12">Giá tiền: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="GiaTien" ></div>

                <label for="name" class="col-sm-12">Điểm xuất phát: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="NoiKhoiHanh" ></div>

                <label for="name" class="col-sm-1">Nổi bật  </label>
                
                <div class="col-sm-11" style="  margin-bottom:20px">    
                    <input type="checkbox" id="myCheck" onclick="NoiBat()" class="col-sm-1 checkbox" value="" name="checkboxNoiBat">
                    <label for="" style="display: none; margin:0" class="NoiBat col-sm-2">Thời gian</label>
                    <input type="date" name="ThoiGian" class="NoiBat col-sm-2 " style="display: none;margin:0">
                    <label for="" style="display: none;margin:0" class="NoiBat col-sm-2">Giảm giá</label>
                    <input type="text" name="GiamGia" class="NoiBat col-sm-2" style="display: none;margin:0">
                </div>

                <label for="name" class="col-sm-12">Vùng miền: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <select  class="form-control" name="IDVungMien" >
                    <?php $data=select_list("select * from vungmien"); foreach($data as $values){
                      ?>
                        <option value="<?php echo $values['IDVungMien'] ?>"><?php echo $values['TenMien'] ?></option>
                     <?php  } ?> </select>

                      </div>

                <label for="name" class="col-sm-12">Xe: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="PhuongTien" ></div>

                <label for="name" class="col-sm-12">Số chỗ ngồi: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text"  required class="form-control"
                        name="SoLuong" ></div>
                <label for="name" class="col-sm-12">Ảnh chi tiết tour: </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <input type='file' id="imgInp2" required name="imageCT" />    
                    <img id="blah2"  class="img-responsive" />
                </div>
                <label for="name" class="col-sm-12">Chi tiết lịch trình:  </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="CTLichTrinh"
                         ></textarea>
                </div>

                <label for="name" class="col-sm-12">Ghi Chú: </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="GhiChu"
                     ></textarea>
                </div>

                <label for="name" class="col-sm-12">Dịch vụ:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="DichVu"
                       ></textarea>
                </div>
                <label for="name" class="col-sm-12">Mô tả chuyến đi:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3"  required rows="3" name="Text"
                       ></textarea>

                </div>
                <div class="col-sm-12" style="text-align:center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Thêm">
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