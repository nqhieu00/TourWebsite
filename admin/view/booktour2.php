<?php
    include "header.php";
    
    $param="Page_layout=list_booktour2&";
    $item_per_page=isset($_REQUEST['per_page'])?$_REQUEST['per_page']:10;
   $current_page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
   $offset=($current_page-1)*$item_per_page;
   $sql = "SELECT * from booktour where tinhtrang=N'Đã nhận' order by IDBookTour desc limit ".$item_per_page." OFFSET ".$offset;
   $dataBookTour=select_list($sql);
  
   $cout=select_one("select count(*) from booktour");
   $TotalPage=ceil($cout['count(*)']/$item_per_page);
?>
<h3>list booktour2 </h3>
<div class="content">
<table style="width:100%" class="table table-bordered">
<tr>
    <th>STT</th>
    <th>Tên Khách</th> 
    <th>SDT</th>
    <th>Email</th>
    <th>Địa chỉ</th>
    <th>Ghi chú</th>
    <th>Thời gian đặt</th>
    <th>Số người lớn</th>
    <th>Số  trẻ em</th>
    <th>Số  trẻ nhỏ</th>
    <th>Số sơ sinh</th>
    <th>Số lượng</th>
    <th>Tổng tiền</th>
    <th>IDTour</th>
    <th>Tình trạng</th>
    <th>Sửa</th>
    <th>Xóa</th>
</tr>
<tr>
<?php
    $stt=0;
   foreach ($dataBookTour as $row) {
      
   
        $stt++;
        echo "<tr>";
        echo "<td>$stt</td>";
    ?>
    <td>
        <?php
        echo'<h5>'.$row['Name'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['Phone'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['Email'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['Addr'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['Note'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['ThoiGianDat'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['NguoiLon'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['TreEm'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['TreNho'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['SoSinh'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        $soLuong=$row['NguoiLon']+$row['TreEm']+$row['TreNho']+$row['SoSinh'];
        echo'<h5>'.$soLuong.'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.number_format($row['TongTien']).'đ</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['IDTour'].'</h5>';
        ?>
    </td>
    <td>
        <?php
        echo'<h5>'.$row['TinhTrang'].'</h5>';
        ?>
    </td>
    <?php
    echo"
    <td>
        <a href='?Page_layout=update_booktour&IDBookTour=".$row['IDBookTour']."'><span class = 'glyphicon glyphicon-pencil'></ span></a>
    </td>";
    echo"
    <td>
        <a href='?Page_layout=delete_booktour&IDBookTour=".$row['IDBookTour']."'><span class = 'glyphicon glyphicon-trash'></ span></a>
    </td>";
    }
    ?>
</tr>
</table>
</div>
 <?php include "../inc/pagination.php"; ?>