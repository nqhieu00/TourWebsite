<?php
 include '../inc/header.php';
 include '../lib/lib_db.php';
    $dulieu=isset($_REQUEST['dulieu1'])?$_REQUEST['dulieu1']:"";
   
    
    //thuc hien cau truy van
   
    $param="dulieu1={$dulieu}&";
    $item_per_page=isset($_REQUEST['per_page'])?$_REQUEST['per_page']:8;
    $current_page=isset($_REQUEST['page'])?($_REQUEST['page']>0?$_REQUEST['page']:1):1;
    $offset=($current_page-1)*$item_per_page;

    $sql = "SELECT * from tour where NameTour like '%$dulieu%' or GiaTien like '%$dulieu%'  or LichTrinh like '%$dulieu%'  order by IDTour limit ".$item_per_page." OFFSET ".$offset;
    $dataTour=select_list($sql);
    $cout=select_one("select count(*) from tour where NameTour like '%$dulieu%' or GiaTien like '%$dulieu%'  or LichTrinh like '%$dulieu%'");
    $TotalPage=ceil($cout['count(*)']/$item_per_page);
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/index.css?v=0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="../public/js/index.js?v=0"></script>
    <title>Du lịch trong nước</title>
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <h3>Có <?php echo $cout['count(*)'];  ?> tour tìm được</h3>
        <div class="TourHome">
            <?php
        foreach($dataTour as $values){
            if($values['IDNoiBat']==0){ ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="Tour">
                    <div class="img-tour">
                        <a href="detail.php?IDTour=<?php echo $values['IDTour'] ?>&IDNoiBat=<?php echo $values['IDNoiBat'] ?>">
                            <img src="<?php echo $values['Image'] ?>"
                                class="img-responsive" style="width:100%" alt="Image">
                            <span><?php echo $values['NoiKhoiHanh'] ?></span>
                        </a>
                    </div>
                    <div class="infor-tour">
                        <a href="detail.php?IDTour=<?php echo $values['IDTour'] ?>&IDNoiBat=<?php echo $values['IDNoiBat'] ?>"><?php echo $values['NameTour'] ?></a>
                    </div>
                    <div class="infor-box">
                        <p class=""><span class="glyphicon glyphicon-time"></span> <?php echo $values['LichTrinh'] ?></p>
                        <p class=""><span class="glyphicon glyphicon-calendar"></span> <?php echo $values['NgayKhoiHanh'] ?></p>
                        <p class=""><span class="glyphicon glyphicon-user"></span> còn <?php echo $values['SoLuong'] ?> chỗ </p>
                        <p class="price">
                            <span class="mda-dis"><?php echo number_format($values['GiaTien'])  ?>đ</span>
                        </p>
                    </div>
                </div>
            </div>
        <?php
            }
            else{
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="Tour">
                        <div class="img-tour">
                        <a href="detail.php?IDTour=<?php echo($values['IDTour']) ?>&IDNoiBat=<?php echo($values['IDNoiBat']) ?>">
                            <img src="<?php echo($values['Image']) ?>" class="img-responsive" style="width:100%" alt="Image">
                            <div class="infor">
                                <?php
                                    $sql1="select *from NoiBat where IDNoiBat=".$values['IDNoiBat']; 
                                    $Noibat=select_one($sql1);
                            
                                ?>
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
    <a class="scrollTop" onclick="scrolltoTop()" href="#">
    <i class="fas fa-chevron-up"></i>
  </a>
    
  <?php include "../inc/pagination.php"; ?>
</body>
</html>


    



