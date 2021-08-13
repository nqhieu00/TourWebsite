<?php
    if(isset($_SESSION['search'])){
        unset($_SESSION['search']);
    }
    include "header.php";
    //thuc hien cau truy van
    $param="Page_layout=list_tour&";
    $item_per_page=isset($_REQUEST['per_page'])?$_REQUEST['per_page']:10;
    $current_page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
   
   
    $offset=($current_page-1)*$item_per_page;
   
    $sql = "SELECT * from tour order by IDTour limit ".$item_per_page." OFFSET ".$offset;
    $dataTour=select_list($sql);
    $cout=select_one("select count(*) from tour");
    $TotalPage=ceil($cout['count(*)']/$item_per_page);
    

?>
     <h3>List tour </h3>
    <div class="content">
        <table style="width:100%" class="table table-bordered">
            <tr>
                <th>STT</th>
                <th>Tên Tour</th>
                <th>Ngày khởi hành</th>
                <th>Lịch Trình</th>
                <th>Giá</th>
                <th>Nơi xuất phát</th>
                <th>Nổi bật</th>
                <th>Vùng miền</th>
                <th>Xe</th>
                <th>Ảnh</th>
                <th>Số chỗ ngồi</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            <tr>
                <?php
       
        $stt=$offset;
       foreach($dataTour as $row){
            $stt++;
            echo "<tr>";
            echo "<td>$stt</td>";
        ?>
                <td>
                    <?php
            echo'<h5>'.$row['NameTour'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['NgayKhoiHanh'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['LichTrinh'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['GiaTien'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['NoiKhoiHanh'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            if($row['IDNoiBat']<>0){
                echo'<h5>Có</h5>';
            }
            else{
                echo'<h5>Không</h5>';
            }
            ?>
                </td>
                <td>
                    <?php
                    $data= select_one("select * from vungmien where IDVungMien={$row['IDVungMien']}");
            echo'<h5>'.$data['TenMien'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['PhuongTien'].'</h5>';
            ?>
                </td>
                <td>
                    <img src="<?php echo($row['Image']) ?>" style="width: 100px;height: 50px;">
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['SoLuong'].'</h5>';
            ?>
                </td>
                <?php
        echo"
        <td>
            <a href='?Page_layout=update_tour&IDTour=".$row['IDTour']."'><span class = 'glyphicon glyphicon-pencil'></ span></a>
        </td>";
        echo"
        <td>
            <a href='?Page_layout=delete_tour&IDTour=".$row['IDTour']."'><span class = 'glyphicon glyphicon-trash'></ span></a>
        </td>";
        }
        ?>
            </tr>
        </table>
    </div>
    <?php include "../inc/pagination.php"; ?>
        

</html>
