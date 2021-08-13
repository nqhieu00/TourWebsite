<?php
   include "header.php";
   

   

   $IDBookTour=isset($_REQUEST['IDBookTour'])?$_REQUEST['IDBookTour']:0;
   $sqlBookTour="select * from booktour where IDBookTour=".$IDBookTour;
   $dataBookTour=select_one($sqlBookTour);
   $sqlTour="select * from tour where IDTour=".$dataBookTour['IDTour'];
   $dataTour=select_one($sqlTour);
    $GiamGia=1;
   
    if($dataTour['IDNoiBat']<>0){
        $sql1="select * from NoiBat where IDNoiBat=".$dataTour['IDNoiBat'];
        $dataNoiBat=select_one($sql1);
        $GiamGia=1-$dataNoiBat['GiamGia']/100;
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <script src="../public/js/index.js"></script>
    <title>QUẢN LÍ DU LỊCH TRONG NƯỚC</title>
</head>

<body>
<h3>update booktour </h3>
    <div class="container">
        <form method="POST" action="?Page_layout=update_booktour_exec&GiaTien=<?php echo $GiamGia*$dataTour['GiaTien']; ?>">
            <div class="form-group">
                <input type="hidden" class="form-control" name="IDBookTour" value="<?php echo $dataBookTour['IDBookTour']; ?>">
                <label for="name" class="col-sm-12">Tour: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" autofocus  class="form-control"
                        name="IDTour" value="<?php echo $dataBookTour['IDTour']; ?>"></div>
                <label for="name" class="col-sm-12">Tên Khách: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" class="form-control"
                        name="Name" value="<?php echo $dataBookTour['Name']; ?>"></div>
                <label for="name" class="col-sm-12">Phone:</label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                   
                <input type="text" class="form-control"
                        name="Phone" value="<?php echo $dataBookTour['Phone']; ?>">
                </div>
                <label for="name" class="col-sm-12">Email: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" class="form-control"
                        name="Email" value="<?php echo $dataBookTour['Email']; ?>"></div>

                <label for="name" class="col-sm-12">Địa chỉ: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" class="form-control"
                        name="Addr" value="<?php echo $dataBookTour['Addr']; ?>"></div>
                
                        <label for="name" class="col-sm-12">Ghi Chú: </label>
                <div class="col-sm-12" style="  margin-bottom:20px">
                    <textarea class="form-control form-control-sm mb-3" rows="3" name="Note"
                     > <?php echo $dataBookTour['Note'] ?>  </textarea>
                </div>

                <label for="name" class="col-sm-12">Thời gian đặt: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="datetime-local" class="form-control"
                        name="ThoiGianDat"  value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataBookTour['ThoiGianDat'])) ;  ?>"></div>
                <div class="col-sm-12" style="  margin-bottom:20px">
                  <label >Tình trạng:</label>
                  <input type="hidden" name="TinhTrangBanDau" value="<?php echo $dataBookTour['TinhTrang']; ?>">
                    <select  class="form-control" name="TinhTrang" >
                    <?php if($dataBookTour['TinhTrang']=="Chưa nhận"){
                      ?>
                        <option value="Chưa nhận">Chưa nhận</option>
                        <option value="Đã nhận">Đã nhận</option>
                      <?php
                    }else{
                      ?>
                        <option value="Đã nhận">Đã nhận</option>
                       <option value="Chưa nhận">Chưa nhận</option>
                        
                      <?php
                    } ?>
                      
                     
                    </select>
                </div>
               
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Loại giá\Độ tuổi</th>
                      <th>Người lớn(Trên 11 tuổi)</th>
                      <th>Trẻ em(5 - 11 tuổi)</th>
                      <th>Trẻ nhỏ(2 - 5 tuổi)</th>
                      <th>Sơ sinh( < 2 tuổi)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Giá</td>
                      <td id="m-Adult"><?php echo number_format ($GiamGia*$dataTour['GiaTien']) ?></td>
                      <td id="m-Child"><?php echo number_format ($GiamGia*$dataTour['GiaTien']*0.5) ?></td>
                      <td id="m-Baby"><?php echo number_format ($GiamGia*$dataTour['GiaTien']*0.3) ?></td>
                      <td id="m-Infant"><?php echo number_format ($GiamGia*$dataTour['GiaTien']*0.1) ?></td>
                    </tr> 
                  </tbody>
                </table>
               
               
                <div class="col-md-3">
                    <label>Người lớn: </label>
                    <input type="number" name="QAdult" onchange="monney()" id="Adult" class="form-control" value="<?php echo $dataBookTour['NguoiLon']; ?>" min="0" max="20">
                </div>
                <div class="col-md-3"  >
                    <label>Trẻ em(5 - 11 tuổi) : </label>
                    <input type="number" name="QChild" onchange="monney()" id="Child" class="form-control" min="0" value="<?php echo $dataBookTour['TreEm']; ?>"  max="20">
                </div>
                <div class="col-md-3">
                    <label>Trẻ nhỏ( 2 - &lt; 5 tuổi): </label>
                    <input type="number" name="QBaby" onchange="monney()" id="Baby" class="form-control" min="0" value="<?php echo $dataBookTour['TreNho']; ?>" max="20">
                </div>
                <div class="col-md-3">
                    <label>Sơ sinh(nhỏ hơn 2 tuổi): </label>
                    <input type="number" name="QInfant" onchange="monney()" id="Infant" class="form-control" min="0" value="<?php echo $dataBookTour['SoSinh']; ?>" max="20">
                </div>
                <?php
                  $SoLuongBanDau= $dataBookTour['NguoiLon']+$dataBookTour['TreEm']+ $dataBookTour['TreNho']+ $dataBookTour['SoSinh'];
                ?>
                <input type="hidden" name="SoLuongBanDau" value="<?php echo $SoLuongBanDau; ?>">
                <div class="col-md-3">
                <div class="txtTotal">Tổng giá trị : <span id="sumary"><?php echo number_format($dataBookTour['TongTien']); ?></span> <span>đ</span></div>
                </div>
                <div class="col-md-12" style="text-align:center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Cập Nhập">
                </div>
            </div>
        </form>
    </div>
</body>

</html>