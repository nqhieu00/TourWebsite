
<?php
    include "header.php";
    $param="Page_layout=list_users&";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
  
   
    <title>QUẢN LÍ DU LỊCH TRONG NƯỚC</title>
</head>
<body>
<h3>list admin </h3>
    <div class="content">
        <table style="width:100%" class="table table-bordered">
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Xóa</th>
            </tr>
            <tr>
                <?php
       
        $sql = "SELECT * from admin order by adminID";
        $data=select_list($sql);
        $stt=0;
        foreach($data as $row){
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
            echo'<h5>'.$row['NgaySinh'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['adminUser'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['adminPass'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['adminPhone'].'</h5>';
            ?>
                </td>
                <td>
                    <?php
            echo'<h5>'.$row['adminEmail'].'</h5>';
            ?>
                </td>
                <?php
        echo"
        <td>
            <a href='?Page_layout=delete_user&id=".$row['adminID']."'><span class = 'glyphicon glyphicon-trash'> </ span></a>
        </td>";
        }
        ?>
            </tr>
        </table>
    </div>
</body>
</html>
