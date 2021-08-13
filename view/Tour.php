<?php
    
    include '../inc/header.php';
    include '../lib/lib_db.php';
    $id = isset($_REQUEST["IDVungMien"]) ? $_REQUEST["IDVungMien"] : 0;

    $item_per_page=isset($_REQUEST['per_page'])?$_REQUEST['per_page']:8;
    $current_page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
    $offset=($current_page-1)*$item_per_page;
   
    $orderfield=isset($_REQUEST['field'])?$_REQUEST['field']:"";
    $orderSort=isset($_REQUEST['sort'])?$_REQUEST['sort']:"";
    $order="";
    $param="IDVungMien={$id}&";
    
    
    
    
            
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="../public/js/index.js"></script>
    <link rel="stylesheet" href="../public/css/Tour.css">
    <link rel="stylesheet" href="../public/css/index.css">

    <title>Du lịch trong nước</title>
</head>

<body>
    <?php
    if($id!=0){
        if(!empty($orderfield) && !empty($orderSort)){
            $order="ORDER BY ".$orderfield." ".$orderSort;
            $param.="field={$orderfield}&sort={$orderSort}&";
        }
        $cout=select_one("select count(*) from tour where IDVungMien = ".$id);
        $TotalPage=ceil($cout['count(*)']/$item_per_page);
        $sql = "select * from tour where IDVungMien = ".$id;
        $sql.=" ".$order." limit ".$item_per_page." OFFSET ".$offset;
        $data=select_list($sql);
        
    }
    else{
        if(!empty($orderfield) && !empty($orderSort)){
            $order="ORDER BY ".$orderfield."*(1-GiamGia*0.01)".$orderSort;
            $param.="field={$orderfield}&sort={$orderSort}&";
        }
        $cout=select_one("select count(*) from tour where IDNoibat != 0  ");
        $TotalPage=ceil($cout['count(*)']/$item_per_page);
        $sql = "SELECT * FROM noibat 
        INNER JOIN tour on noibat.IDNoiBat=tour.IDNoiBat  where tour.IDNoibat != 0 ";
        $sql.=$order." limit ".$item_per_page." OFFSET ".$offset;        
        $data=select_list($sql);
      
    }
     ?>
    <div class="container-fluid" style="margin-top: 52px; margin-left: 40px;
    margin-right: 40px;">
        <section class="content-header">
            <ol class="breadcrumb">
                <li>
                    <a itemprop="item" href="index.php">
                        <i class="fa fa-home" aria-hidden="true"></i> <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <?php  if($id!=0){
                        $sqlgetTenMien="select * from VungMien where IDVungMien =" .$id;
                        $datagetTenMien=select_one($sqlgetTenMien);
                        ?>
                    <a itemprop="item" href="Tour.php?IDVungMien=<?php echo($id)?>">
                        <span itemprop="name">Tour  <?php echo( $datagetTenMien['TenMien']); ?></span>
                    </a>    
                            <?php }
                        else{
                            ?>
                            <a itemprop="item" href="Tour.php">
                                <span itemprop="name">Tour nổi bật</span>
                            </a>
                            <?php } ?>
                </li>

            </ol>
        </section>
        <div class="content">
            <h1 class="TitleTour">
                <b>Danh sách các tour du lịch
                    <?php
                if($id!=0){
                    $sqlgetTenMien="select * from VungMien where IDVungMien =" .$id;
                    $datagetTenMien=select_one($sqlgetTenMien);

                    echo( $datagetTenMien['TenMien']);
                }
                else{
                    echo('nổi bật');
                }
                   
              ?>
                </b>
            </h1>
            <div class="mda-box-top">
                <div class="mda-box-r">
                    <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location=this.options[this.selectedIndex].value);">
                        <option value="">Sắp xếp</option>
                        <option value="?IDVungMien=<?php echo $id; ?>&field=GiaTien&sort=asc">Giá tăng dần</option>
                        <option value="?IDVungMien=<?php echo $id; ?>&field=NgayKhoiHanh&sort=asc">Ngày khởi hành tăng dần</option>
                        <option value="?IDVungMien=<?php echo $id; ?>&field=GiaTien&sort=desc">Giá tăng giảm dần</option>
                        <option value="?IDVungMien=<?php echo $id; ?>&field=NgayKhoiHanh&sort=desc">Ngày khởi hành giảm dần</option>
                    </select>
                </div>
            </div>
            <div class="tourHome">
                <div class="row" style="padding:0px 8px">
                    <?php foreach($data as $values){?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="Tour">
                            <div class="img-tour">
                                <a
                                    href="detail.php?IDTour=<?php echo($values['IDTour']) ?>&IDNoiBat=<?php echo($values['IDNoiBat']) ?>">
                                    <img src="<?php echo($values['Image']) ?>" class="img-responsive" style="width:100%"
                                        alt="Image">

                                    <?php
                                    if($id!=0){
                                        ?>
                                    <span>
                                        <?php echo($values['NoiKhoiHanh']) ?>
                                    </span>

                                    <?php
                                    }
                                    else{
                                        $sqlNoiBat="select *from NoiBat where IDNoiBat=".$values['IDNoiBat']; 
                                        $Noibat=select_one($sqlNoiBat);
                                           
                                        ?>
                                    <div class="infor">
                                        <div class="timedown fa fa-clock" id="timedown<?php echo($values['IDTour']) ?>">
                                            <?php echo ($Noibat['ThoiGian']) ?>
                                        </div>
                                        <div class="place">
                                            <?php echo($values['NoiKhoiHanh']) ?>
                                        </div>
                                    </div>
                                    <script>
                                        var a<?php echo($values['IDTour']) ?>= document.getElementById("timedown<?php echo($values['IDTour']) ?>").innerHTML;
                                        var countDownDate<?php echo($values['IDTour']) ?> = new Date(a<?php echo($values['IDTour']) ?>).getTime();

                                        // Update the count down every 1 second
                                        var x = setInterval(function () {

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
                                            document.getElementById("timedown<?php echo($values['IDTour']) ?>").innerHTML = "Còn " + days + " ngày " + hours + ":" + minutes + ":" + seconds;

                                            // If the count down is over, write some text 
                                            if (distance < 0) {

                                                document.getElementById("timedown<?php echo($values['IDTour']) ?>").innerHTML = "Hết hạn";
                                            }
                                        }, 1000);
                                    </script>
                                   <?php
                                  
                                    }
                                    ?>
                                   
                                </a>
                            </div>
                            <div class="infor-tour">
                                <a
                                    href="detail.php?IDTour=<?php echo($values['IDTour'])?>&IDNoiBat=<?php echo($values['IDNoiBat']) ?>">
                                    <?php echo($values['NameTour']) ?>
                                </a>
                            </div>
                            <div class="infor-box">
                                <p class=""><span class="glyphicon glyphicon-time"></span>
                                    <?php echo($values['LichTrinh']) ?>
                                </p>
                                <p class=""><span class="glyphicon glyphicon-calendar"></span>
                                    <?php echo($values['NgayKhoiHanh']) ?>
                                </p>
                                <p class=""><span class="glyphicon glyphicon-user"></span> còn
                                    <?php echo($values['SoLuong']) ?> chỗ
                                </p>
                                <p class="price">
                                    <?php if($id!=0){
                                        ?>

                                    <span class="mda-dis">
                                        <?php echo(number_format($values['GiaTien'])) ?>đ
                                    </span>
                                    <?php
                                    }
                                    else{
                                        $sqlNoiBat="select *from NoiBat where IDNoiBat=".$values['IDNoiBat']; 
                                        $Noibat=select_one($sqlNoiBat);
                                        ?>
                                <p class="price">
                                    <span class="mda-pre"
                                        style="color: #bbb;text-decoration: line-through;font-weight: 300">
                                        <?php echo(number_format( $values['GiaTien']))?>đ
                                    </span>
                                    <span class="mda-dis">
                                        <?php echo(number_format( (1-$Noibat['GiamGia']*0.01)*$values['GiaTien']))?>đ
                                    </span>
                                </p>
                                <?php
                                    }
                                     ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
              <?php  include '../inc/pagination.php'; ?>
            </div>
        </div>
    </div>
    <a class="scrollTop" onclick="scrolltoTop()" href="#">
    <i class="fas fa-chevron-up"></i>
  </a>
    <?php
      include '../inc/footer.php';
    ?>
</body>

</html>