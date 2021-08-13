<?php
    include '../inc/header.php';
    include '../lib/lib_db.php';
    $idTour = isset($_REQUEST["IDTour"]) ? $_REQUEST["IDTour"] : 0;
    $IDNoiBat=isset($_REQUEST["IDNoiBat"]) ? $_REQUEST["IDNoiBat"] : 0;
    $sql="select * from detailtour where IDDetailTour=".$idTour;
    $dataDetailTour=select_one($sql); 
    $sql1="select *from Tour where IDTour=".$idTour;
    $dataTour=select_one($sql1); 
    $sql2="select * from VungMien where IDVungMien=".$dataTour['IDVungMien'];
    $dataVungMien=select_one($sql2); 
    
           
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/detail.css?v=0">
    <link rel="stylesheet" href="../public/css/index.css?v=0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../public/js/index.js?v=0"></script>

    <title>Du lịch trong nước</title>

</head>

<body>
    <div class="container" style="margin-top: 52px;">
        <section class="content-header">
            <ol class="breadcrumb">
                <li>
                    <a itemprop="item" href="index.php">
                        <i class="fa fa-home"></i> <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a itemprop="item" href="Tour.php?IDVungMien=<?php echo($dataTour['IDVungMien'])?>">
                        <span itemprop="name">
                            <?php echo($dataVungMien['TenMien']) ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a itemprop="item" class="link-detail-value"
                        href="detail.php?IDTour=<?php echo($dataTour['IDTour'])?>&IDNoiBat=<?php echo($IDNoiBat)?>">
                        <span itemprop="name">
                            <?php echo($dataTour['NameTour']) ?>
                        </span>
                    </a>
                </li>
            </ol>
        </section>
        <div class="content">
            <h1 class="TitleTour">
                <b>
                    <?php echo($dataTour['NameTour'])?>
                </b>
            </h1>
            <div class="row">
                <div class="col-sm-8" id="getHeight">
                    <div class="Tour-img">
                        <img src="<?php echo($dataDetailTour['Image'])?>" class="img-responsive" style="width:100%"
                            alt="Image">
                    </div>
                    <div class="Tour-infor">
                        <span class="v-margin-right-30"><i class="glyphicon glyphicon-map-marker"></i>
                            <?php echo($dataTour['NoiKhoiHanh'])  ?>
                        </span><br class="visible-xs">
                        <span class="v-margin-right-30 timeName"><i class="glyphicon glyphicon-time"></i>
                            <?php echo($dataTour['LichTrinh'])  ?>
                        </span>
                        <span class="v-margin-right-30 transports">
                            Phương tiện:
                            <i class="fa fa-plane" data-toggle="tooltip" title=""
                                data-original-title="Di chuyển bằng Máy bay"></i>
                            <i class="fa fa-bus" data-toggle="tooltip" title=""
                                data-original-title="Di chuyển bằng Ô tô"></i>
                        </span>
                        <br>
                    </div>
                    <div class="boxTour" id="flag1">
                        <div class="title"><span class="fa-info-circle">Điểm nhấn hành trình</span></div>
                        <div class="content">
                            <table cellpadding="15" cellspacing="15" style="width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="width: 15%;"><span style="color:#555555;"><strong>Hành
                                                    trình</strong></span></td>
                                        <td><span style="color:#555555;"><strong>
                                                    <?php echo($dataTour['NameTour']) ?>
                                                </strong></span></td>
                                    </tr>
                                    <tr>
                                        <td><span style="color:#555555;"><strong>Lịch trình</strong></span></td>
                                        <td><span style="color:#555555;"><strong>
                                                    <?php echo($dataTour['LichTrinh']) ?>
                                                </strong></span></td>
                                    </tr>
                                    <tr>
                                        <td><span style="color:#555555;"><strong>Khởi hành</strong></span></td>
                                        <td><span style="color:#555555;"><strong>
                                                    <?php echo($dataTour['NgayKhoiHanh']) ?>
                                                </strong></span></td>
                                    </tr>
                                    <tr>
                                        <td><span style="color:#555555;"><strong>Vận chuyển</strong></span></td>
                                        <td><span color="#555555"><b>
                                                    <?php echo($dataTour['PhuongTien'])  ?>
                                                </b></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style="text-align:justify">
                                <?php echo($dataDetailTour['Text']) ?>
                            </p>
                        </div>
                    </div>
                    <div class="boxTour" id="flag2">
                        <div class="title"><span class="fa-map-o">Lịch trình</span></div>
                        <div class="day active">
                          
                            <?php 
                            echo ($dataDetailTour['LichTrinh'])
                            ?>
                        </div>
                    </div>
                    <div class="boxTour" id="flag3">
                        <div class="title"><span class="fa-paperclip">Dịch vụ bao gồm và không bao gồm</span></div>
                        <div class="content">
                            <div class="the-content desc">
                               
                                <?php echo($dataDetailTour['DichVu']) ?>
                               

                            </div>

                        </div>
                    </div>
                    <div class="boxTour" id="flag5">
                        <div class="title"><span class="fa-sticky-note-o">Ghi chú</span></div>
                        <div class="content">
                            <div class="the-content desc">
                               
                                <?php echo($dataDetailTour['GhiChu']) ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4" id="srollchange" style="position: relative;">
                    <div class="boxDesign1">
                        <div class="name">
                            <?php echo($dataTour['NameTour'])?>
                        </div>
                        <div class="attr">
                            <ul>
                                <li>
                                    <div class="at">Mã tour</div>
                                    <div class="as">
                                        <?php echo($dataTour['IDTour'])?>
                                    </div>
                                </li>
                                <li>
                                    <div class="at">Thời gian:</div>
                                    <div class="as">
                                        <?php echo($dataTour['LichTrinh'])?>
                                    </div>
                                </li>
                                <li>
                                    <div class="at">Khởi hành:</div>
                                    <div class="as">
                                        <?php echo($dataTour['NgayKhoiHanh'])?>
                                    </div>
                                </li>
                                <li>
                                    <div class="at">Vận Chuyển:</div>
                                    <div class="as">
                                        <?php echo($dataTour['PhuongTien'])?>
                                    </div>
                                </li>
                                <li>
                                    <div class="at">Xuất phát:</div>
                                    <div class="as">
                                        <?php echo($dataTour['NoiKhoiHanh'])?>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mnfixed_wrap" style="position: sticky;top: 60px;">
                        <div class="mnfixed_self mnfixed_fixed_fixed">
                            <div class="boxFix">
                                <div class="boxPrice">

                                    <div class="price">
                                        <div class="txt">Giá từ:</div>
                                        <?php
                                            $sql3="select *from NoiBat where IDNoiBat=".$IDNoiBat; 
                                            $Noibat=select_one($sql3);
                                            if($IDNoiBat<>0){
                                                ?>
                                        <div class="red">
                                            <?php echo(number_format( (1-$Noibat['GiamGia']*0.01)*$dataTour['GiaTien']))?>
                                        </div>
                                        <div class="nor">
                                            <?php echo(number_format($dataTour['GiaTien'])) ?>đ
                                        </div>
                                        <?php
                                            }
                                            else{
                                                ?>
                                        <div class="red">
                                            <?php echo(number_format($dataTour['GiaTien'])) ?>
                                        </div>
                                        <?php
                                            }
                                        ?>

                                    </div>
                                    <div class="bot">
                                        <div class="form-group">
                                            <input type="text" id="" value=" <?php echo( date(" Y-m-d")) ?>"
                                            readonly="">
                                        </div>
                                        <form method="POST"
                                            action="bookTour.php?IDTour=<?php echo($dataTour['IDTour'])?>&IDNoiBat=<?php echo($IDNoiBat)?>">
                                            <input type="submit" value="Đặt Tour">
                                        </form>
                                    </div>
                                </div>
                                <div class="boxDesign2">
                                    <ul>
                                        <li class=""><a href="#flag1"><span class="fa-info-circle">Điểm nhấn hành
                                                    trình</span></a></li>
                                        <li class=""><a href="#flag2"><span class="fa-map">Lịch trình</span></a></li>
                                        <li class=""><a href="#flag3"><span class="fa-paperclip">Dịch vụ bao gồm và
                                                    không bao gồm</span></a></li>
                                        <li class=""><a href="#flag5"><span class="fa-sticky-note">Ghi chú</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="titleHome">
                <h3><a href="Tour.php?IDVungMien=<?php echo $dataVungMien['IDVungMien'];  ?>"> Tour liên quan </a></h3>
            </div>
            <?php
                $sql="select * from tour where IDVungMien ={$dataVungMien['IDVungMien']} limit 4";
                $data=select_list($sql);
                foreach($data as $values){
                    ?>

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
            ?>
            
           
        </div>
    </div>


    <div class="scrollTop" onclick="scrolltoTop()">
        <i class="fas fa-chevron-up"></i>
    </div>

    <!-- Footer -->
    <?php
    include '../inc/footer.php';
  ?>
    <!-- Footer -->
    <script>
        $(document).ready(function () {
            srcollChange();
        });
    </script>
</body>

</html>