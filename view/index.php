<?php
    include '../inc/header.php';
    include '../inc/slider.php';

    include '../lib/lib_db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../public/css/index.css?v=0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="../public/js/index.js?v=0"></script>
  <title>Du lịch trong nước</title>
</head>
<body id="body">
  <div class="tourHome">
    <div class="container-fluid">    
      <div class="row">
        <div class="titleHome">
          <h3><a href="Tour.php">TOUR KÍCH CẦU</a></h3>
          <a href="Tour.php" class="link">
            Xem tất cả
          </a>
        </div>
        <?php
            $sql="select * from tour where IDNoiBat!=0 ORDER BY IDNoiBat DESC LIMIT 4";
            $data=select_list($sql); 
            foreach($data as $values){
              $sql1="select *from NoiBat where IDNoiBat=".$values['IDNoiBat']; 
              $Noibat=select_one($sql1);
              $today = date("Y-m-d");
              if (strtotime($today) >= strtotime($Noibat['ThoiGian'])) {
                $dataTour["IDNoiBat"] = 0;
                $tblTour = "tour";
              
                $cond = "IDTour={$values['IDTour']}";
                $sqlTour = data_to_sql_update($tblTour, $dataTour,$cond);
                $ret = exec_update($sqlTour);

                
                $sql ="delete from noibat where IDNoiBat=".$values['IDNoiBat'];
                $ret = exec_update($sql);
              }
              else{      
        ?>   
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="Tour">
            <div class="img-tour">
              <a href="detail.php?IDTour=<?php echo($values['IDTour']) ?>&IDNoiBat=<?php echo($values['IDNoiBat']) ?>">
                <img src="<?php echo($values['Image']) ?>" class="img-responsive" style="width:100%" alt="Image">
                <div class="infor">
                  <div class="timedown fa fa-clock" id="timedown<?php echo($values['IDTour']) ?>" ><?php echo ($Noibat['ThoiGian']) ?></div>
                   <script>
                     var a<?php echo($values['IDTour']) ?>=document.getElementById("timedown<?php echo($values['IDTour']) ?>").innerHTML+" 0:0:0";
                          var countDownDate<?php echo($values['IDTour']) ?> = new Date(a<?php echo($values['IDTour']) ?>).getTime();

                        // Update the count down every 1 second
                        var x = setInterval(function() {

                          // Get today's date and time
                          var now = new Date().getTime();
                            
                          // Find the distance between now and the count down date
                          var distance = countDownDate<?php echo($values['IDTour']) ?> - now;
                            
                          // Time calculations for days, hours, minutes and seconds
                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                          // Output the result in an element with id="demo"
                          document.getElementById("timedown<?php echo($values['IDTour']) ?>").innerHTML = "Còn "+days + " ngày " + hours + ":"+ minutes + ":" + seconds;
                            
                          // If the count down is over, write some text 
                        
                          if (distance < 0) {
                           
                            document.getElementById("timedown<?php echo($values['IDTour']) ?>").innerHTML = "Hết hạn";
                            <?php
                            
                            // $dataTour["IDNoiBat"] = 0;
                            // $tblTour = "tour";
                            // $cond = "IDTour={$values['IDTour']}";
                            // $sqlTour = data_to_sql_update($tblTour, $dataTour,$cond);
                            // $ret = exec_update($sqlTour);
                            ?>
                            
                          }
                        }, 1000);
                  </script>
                  
                  <div class="place" ><?php echo($values['NoiKhoiHanh'])  ?></div>
                </div>
                
              </a>
            </div>
            <div class="infor-tour">
              <a href="detail.php?IDTour=<?php echo($values['IDTour']) ?>&IDNoiBat=<?php echo($values['IDNoiBat']) ?>"><?php echo($values['NameTour']) ?></a>
            </div>
            <div class="infor-box">
                <p class=""><span class="glyphicon glyphicon-time"></span> <?php echo($values['LichTrinh']) ?></p>
                <p class=""><span class="glyphicon glyphicon-calendar"></span> <?php echo($values['NgayKhoiHanh']) ?></p>
                <p class=""><span class="glyphicon glyphicon-user"></span> còn <?php echo($values['SoLuong']) ?> chỗ</p>
                <p class="price">
                <span class="mda-pre" style="color: #bbb;text-decoration: line-through;font-weight: 300"><?php echo(number_format( $values['GiaTien']))?>đ</span>
                <span class="mda-dis"><?php echo(number_format( (1-$Noibat['GiamGia']*0.01)*$values['GiaTien']))?>đ</span> 
              </p>
            </div>
          </div>
        </div>
        <?php
            }
          }
        ?>
        
        
       
      </div>
    </div>
    <?php
    $idvung="select distinct IDVungMien from tour ORDER BY IDVungMien";
    $dataIdVung=select_list($idvung); 
    foreach($dataIdVung as $valueIDVung){
        $sqlVung="select * from tour where IDVungMien =".$valueIDVung['IDVungMien']." and IDNoiBat=0 ORDER BY IDTour DESC LIMIT 4";
        $dataVung=select_list($sqlVung);
        ?>
    <div class="container-fluid">    
      <div class="row">
        <div class="titleHome">
          <h3><a href="Tour.php?IDVungMien=<?php echo($valueIDVung['IDVungMien']) ?>">TOUR 
              <?php
                    $sqlgetTenMien="select * from VungMien where IDVungMien =" .$valueIDVung['IDVungMien'];
                    $datagetTenMien=select_one($sqlgetTenMien);
                    echo( $datagetTenMien['TenMien']);
              ?>
          </a></h3>
          <a href="Tour.php?IDVungMien=<?php echo($valueIDVung['IDVungMien']) ?>" class="link">
            Xem tất cả
          </a>
        </div>
       <?php
       foreach($dataVung as $valueVung){
       ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="Tour">
            <div class="img-tour">
              <a href="detail.php?IDTour=<?php echo($valueVung['IDTour']) ?>&IDNoiBat=<?php echo($valueVung['IDNoiBat']) ?>">
                <img src="<?php echo ($valueVung['Image'])?>" class="img-responsive" style="width:100%" alt="Image">
               
                <span><?php echo($valueVung['NoiKhoiHanh']) ?></span>
             
              </a>
            </div>
            <div class="infor-tour">
              <a href="detail.php?IDTour=<?php echo($valueVung['IDTour']) ?>&IDNoiBat=<?php echo($valueVung['IDNoiBat']) ?>"><?php echo($valueVung['NameTour'])?></a>
            </div>
            <div class="infor-box">
                <p class=""><span class="glyphicon glyphicon-time"></span> <?php echo($valueVung['LichTrinh'])?></p>
                <p class=""><span class="glyphicon glyphicon-calendar"></span> <?php echo($valueVung['NgayKhoiHanh'])?></p>
                <p class=""><span class="glyphicon glyphicon-user"></span> còn <?php echo($valueVung['SoLuong'])?> chỗ</p>
                <p class="price">
                <span class="mda-dis"><?php echo(number_format($valueVung['GiaTien']))?>đ</span></p>
            </div>
          </div>
        </div>
        <?php
            } 
        ?>
      </div> 
    </div>
    <?php
        
    }
           
    ?>    
  </div>
  
  <!-- <div id="login" style="display: none;">
    <form>
      <label for="account">Tài khoản</label></br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="account" type="text" class="form-control"  placeholder="Tài khoản">
        </div>
        <label for="password">Mật khẩu</label></br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="password" type="password" class="form-control" placeholder="Mật khẩu">
        </div>
        <input type="submit" value="Đăng nhập">
        <input type="button" value="Đóng" onclick="closeForm()">
    </form>
    
  </div>
  <div id="register" style="display: none;">
    <form method="POST" action="">
      <label for="account">Tài khoản</label></br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="account-dk" type="text" class="form-control"  placeholder="Tài khoản" required>
        </div>
        <label for="password">Mật khẩu</label></br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="password-dk" value="" type="password" class="form-control" placeholder="Mật khẩu" required pattern=".{6,}" title="Mật khẩu tối thiểu 6 ký tự !" onchange="checkRegister()">
        </div>
        <label for="password">Xác nhận mật khẩu</label></br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="re-password" type="password" class="form-control" placeholder="Xác nhận mật khẩu" required  title="Xác nhận mật khẩu phải giống Mật khẩu !" >
        </div>
        <label for="phone">Số điện thoại</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
          <input id="phone" type="text" class="form-control" placeholder="123-345-789" required pattern="^0+[0-9]{9}" title="Vui lòng nhập đúng số điện thoại !">
        </div>
        <label for="addr">Địa chỉ</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
          <input id="addr" type="text" class="form-control" placeholder="Địa chỉ" required>
        </div>
        <input type="submit" value="Đăng ký">
        <input type="button" value="Đóng" onclick="closeForm()">
      </form>
  </div> -->
  <a class="scrollTop" onclick="scrolltoTop()" href="#">
    <i class="fas fa-chevron-up"></i>
  </a>
  <?php
    include '../inc/footer.php';
  ?>
      
</body>
</html>
