<?php
    include "header.php";
    
    $_SESSION['Name']="";
    $_SESSION['NgaySinh']="";
    $_SESSION['TaiKhoan']="";
   
    $_SESSION['Email']="";
    $_SESSION['SDT']="";
    if(isset($_POST["submit"])){
        $Name=isset($_POST['HoTen'])?$_POST['HoTen']:"";
        $NgaySinh=isset($_POST['NgaySinh'])?$_POST['NgaySinh']:"";
        $TaiKhoan=isset($_POST['TaiKhoan'])?$_POST['TaiKhoan']:"";
        $MatKhau=isset($_POST['MatKhau'])?$_POST['MatKhau']:"";
        $SDT=isset($_POST['SDT'])?$_POST['SDT']:"";
        $Email=isset($_POST['Email'])?$_POST['Email']:"";
        $KT=select_one("select * from Admin where adminUser='{$TaiKhoan}'");
        if(!$KT){
            unset( $_SESSION['Name']);
            unset( $_SESSION['NgaySinh']);
            unset( $_SESSION['TaiKhoan']);
          
            unset( $_SESSION['Email']);
            unset( $_SESSION['SDT']);
            $data["Name"] = $Name;
            $data["NgaySinh"] = $NgaySinh;
            $data["adminUser"] = $TaiKhoan;
            $data["adminPass"] = $MatKhau;
            $data["adminEmail"] = $Email;
            $data["adminPhone"] = $SDT;
            $tbl = "admin";
            $sql = data_to_sql_insert($tbl, $data);
            $ret = exec_update($sql);
            header("Location:http://localhost/cnw/admin/index.php?Page_layout=list_users");
        }
        else{
            $_SESSION['Name']=$Name;
            $_SESSION['NgaySinh']=$NgaySinh;
            $_SESSION['TaiKhoan']=$TaiKhoan;
           
            $_SESSION['Email']=$Email;
            $_SESSION['SDT']=$SDT;
        }
        
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
    <style>
    p{
        position: absolute;
        z-index: 10;
        right: 0;
        background: #000;
        color: #fff;
        font-size: 12px;
        font-style: italic;
        padding: 3px 10px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    </style>
</head>

<body>
    <h3>add admin </h3>
    <div class="container">
        <form method="POST">
            <div class="form-group">
               
                <label for="name" class="col-sm-12">Họ tên: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" autofocus required class="form-control" value="<?php if( $_SESSION['Name']){ echo  $_SESSION['Name']; } ?>"
                        name="HoTen" ></div>
                <label for="name" class="col-sm-12">Ngày sinh: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="date" required  class="form-control" value="<?php if( $_SESSION['NgaySinh']){ echo  $_SESSION['NgaySinh']; } ?>"
                        name="NgaySinh" ></div>
                <label for="name" class="col-sm-12">Tài khoản: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" required class="form-control"  value="<?php if( $_SESSION['TaiKhoan']){ echo  $_SESSION['TaiKhoan']; } ?>"
                        name="TaiKhoan" >
                        <?php if( $_SESSION['TaiKhoan']){ echo  '<p>Tài khoản đã tồn tại vui lòng nhập tài khoản khác</p>'; } ?>
                        </div>
                       
                <label for="name" class="col-sm-12">Mật khẩu: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="password" required class="form-control" value=""
                        name="MatKhau" ></div>

                <label for="name" class="col-sm-12">Số điện thoại: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" required class="form-control" value="<?php if( $_SESSION['SDT']){ echo  $_SESSION['SDT']; } ?>"
                        name="SDT" ></div>
                <label for="name" class="col-sm-12">Email: </label>
                <div class="col-sm-12" style="  margin-bottom:20px"> <input type="text" required class="form-control" value="<?php if( $_SESSION['Email']){ echo  $_SESSION['Email']; } ?>"
                        name="Email" ></div>

                
                <div class="col-sm-12" style="text-align:center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Thêm">
                </div>
            </div>
        </form>
    </div>
</body>

</html>