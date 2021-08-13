<?php
    include '../inc/header.php';
    include '../lib/lib_db.php';
    $idTour = isset($_REQUEST["IDTour"]) ? $_REQUEST["IDTour"] : 0;
    $IDNoiBat=isset($_REQUEST["IDNoiBat"]) ? $_REQUEST["IDNoiBat"] : 0;
    $sql="select * from Tour where IDTour=".$idTour;
    $dataTour=select_one($sql);
    $sql2="select * from VungMien where IDVungMien=".$dataTour["IDVungMien"];
    $dataVungMien=select_one($sql2); 
    $GiamGia=1;
   
    if($IDNoiBat<>0){
        $sql1="select * from NoiBat where IDNoiBat=".$IDNoiBat;
        $dataNoiBat=select_one($sql1);
        $GiamGia=1-$dataNoiBat['GiamGia']/100;
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bookTour.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="../public/js/index.js"></script>
    <title>Du lịch trong nước</title>
</head>
<body>
  <div class="container">
      <section class="content-header">
      <ol class="breadcrumb">
                <li>
                    <a itemprop="item" href="index.php">
                        <i class="fa fa-home"></i> <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a itemprop="item" href="Tour.php?IDVungMien=<?php echo($dataTour['IDVungMien'])?>">
                        <span itemprop="name"><?php echo($dataVungMien['TenMien']) ?></span>
                    </a>
                </li>
                <li>
                    <a itemprop="item" class="link-detail-value" href="detail.php?IDTour=<?php echo($dataTour['IDTour'])?>&IDNoiBat=<?php echo($IDNoiBat)?>">
                        <span itemprop="name"> <?php echo($dataTour['NameTour']) ?></span>
                    </a>
                </li>
                <li>
                    <a itemprop="item"  href="bookTour.php?IDTour=<?php echo($dataTour['IDTour'])?>&IDNoiBat=<?php echo($IDNoiBat)?>">
                    <span itemprop="name">Đặt Tour </span>
                    </a>
                </li>
            </ol>
      </section>
      <div id="mda-tour">
          <div class="mda-info">
              <div class="row">
                  <div class="col-sm-4">
                      <div class="mda-info-img">
                          <img src="<?php echo($dataTour['Image']) ?>" class="img-responsive" style="width:100%;height: 280px;" alt="Image" >
                        </div>
                  </div>
                  <div class="col-sm-8">
                      <div class="mda-info-caption">
                          <h2>
                            <a href="#"><?php echo($dataTour['NameTour']) ?></a>
                          </h2>
                          <div class="mda-info-list">
                            <div class="mda-row"><span class="be">Mã tour:</span> <span style="font-weight:bold"><?php echo($dataTour['IDTour']) ?></span></div>
                            <div class="mda-row"><span class="be">Thời gian:</span> <span style="font-weight:bold"><?php echo($dataTour['LichTrinh']) ?></span></div>
                            <div class="mda-row"><span class="be">Giá:</span><span style="font-weight:bold" id="total-all"><?php echo(number_format($dataTour['GiaTien']*$GiamGia))  ?></span> đ</div>
                            <div class="mda-row"><span class="be">Ngày khởi hành:</span><span style="font-weight:bold"><?php echo($dataTour['NgayKhoiHanh']) ?></span></div>
                            <div class="mda-row"><span class="be">Nơi khởi hành:</span><span style="font-weight:bold"><?php echo($dataTour['NoiKhoiHanh']) ?></span></div>
                            <div class="mda-row"><span class="be">Số chỗ còn nhận:</span> <span style="font-weight:bold"><?php echo($dataTour['SoLuong']) ?></span></div>                 
                          </div>
                        </div>
                  </div>
              </div>
          </div>
      </div>
      <div id="MdaPrice">
          <div class="mda-tilte-3">
            <span class="mda-tilte-name">Bảng giá tour chi tiết</span>
          </div>
          <div class="mda-price-tour-r clearfix">
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
                      <td id="m-Adult"><?php echo(number_format($dataTour['GiaTien']*$GiamGia))  ?></td>
                      <td id="m-Child"><?php echo(number_format($dataTour['GiaTien']*0.5*$GiamGia))  ?></td>
                      <td id="m-Baby"><?php echo(number_format($dataTour['GiaTien']*0.3*$GiamGia))  ?></td>
                      <td id="m-Infant"><?php echo(number_format($dataTour['GiaTien']*0.1*$GiamGia))  ?></td>
                    </tr> 
                  </tbody>
                </table>
          </div>
      </div> 
      <form action="dat.php?IDTour=<?php echo($idTour) ?>&GiaTien=<?php echo($GiamGia*$dataTour['GiaTien']) ?>" method="POST">
          <div class="mda-tilte-3">
              <span class="mda-tilte-name">Thông tin liên hệ</span>
          </div>   
          <div class="row">
              <div class="form-group col-md-4">
                  <label>HỌ TÊN : <span id="bookNameError" class="error"></span></label>
                  <input type="text" name="Name" id="lname"  required class="form-control input-tracking1">
              </div>
              <div class="form-group col-md-4">
                  <label>Email:<span id="bookEmailError" class="error"></span></label>
                  <input  type="text" name="Email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  title="Vui lòng nhập đúng email !" required class="user-email form-control input-tracking1">
              </div>
              <div class="form-group col-md-4">
                  <label>Số điện thoại :<span id="bookPhoneError" class="error"></span></label>
                  <input  type="text" name="Phone" pattern="^0+[0-9]{9}" title="Vui lòng nhập đúng số điện thoại !" required class="form-control numeric  input-tracking1">
              </div>
              <div class="form-group col-md-4">
                  <label>Địa chỉ :<span id="bookAddressError" class="error"></span></label>
                  <textarea  type="text" name="Addr" required class="form-control input-tracking1"></textarea>
              </div>
              <div class="form-group col-md-8">
                  <label>Ghi chú:</label>
                  <textarea name="Note" class="form-control"></textarea>
              </div>
              <hr>
              <div class="form-group col-md-3">
                  <label>Người lớn: </label>
                  <input type="number" name="QAdult" onchange="monney()" id="Adult" class="form-control" value="1" min="1" max="10">
              </div>
              <div class="form-group col-md-3">
                  <label>Trẻ em(5 - 11 tuổi) : </label>
                  <input type="number" name="QChild" onchange="monney()" id="Child" class="form-control" min="0" value="0"  max="10">
              </div>
              <div class="form-group col-md-3">
                  <label>Trẻ nhỏ( 2 - &lt; 5 tuổi): </label>
                  <input type="number" name="QBaby" onchange="monney()" id="Baby" class="form-control" min="0" value="0" max="10">
              </div>
              <div class="form-group col-md-3">
                  <label>Sơ sinh(nhỏ hơn 2 tuổi): </label>
                  <input type="number" name="QInfant" onchange="monney()" id="Infant" class="form-control" min="0" value="0" max="10">
              </div>
              <div class="form-group col-md-12">
                  <div class="txtTotal">Tổng giá trị : <span id="sumary"><?php echo(number_format($dataTour['GiaTien']*$GiamGia))  ?></span> <span>đ</span></div>
              </div>
              <div class="form-group col-md-12" style="text-align: center;">
                  <input type="submit" value="Đặt Tour" name="submit">
              </div>
          </div>
      </form>
      <a class="scrollTop" onclick="scrolltoTop()" href="#">
        <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <?php
    include '../inc/footer.php';
  ?>
</body>
</html>