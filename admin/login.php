<?php 
   
    include "../lib/lib_db.php";
	session_start(); //phiên bắt đầ
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>QUẢN LÍ DU LỊCH TRONG NƯỚC</title>
</head>
<body>
 <div class="container" style="
    margin: 100px auto;width:50%">
	<div class="panel panel-primary">
    	<div class="panel-heading" style="text-align:center">LOGIN</div>
        <div class="panel-body">
        	<table class="table-condensed" style="width:100%">
            <form method="POST" class="form-control">
            	<tr>
                	<td>
                    	<label for="username" >Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" style="width:100%;"  required >
                    </td>
                </tr>
                <tr>
                	<td>
                    	<label for="password" >Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" style="width:100%;"  required>
                    </td>
                </tr>
                <tr>
                	<td style="text-align:center">
                    	<input type="submit" name="btnsubmit" value="login" class="btn btn-primary" style="width:20%">
                    </td>
                </tr>
            </form>
            </table>
        </div>
    </div>
    <?php
    if(isset($_POST["btnsubmit"]))
    {
       
        $username= isset($_POST["username"])?$_POST["username"]:"";
        $password= isset($_POST["password"])?$_POST["password"]:"";
        $sql="SELECT * from admin where adminUser='$username' and adminPass='$password'";
        $user=select_one($sql);
        if($user)
        {
            $_SESSION["loged"]=true;
            $_SESSION["adminUser"]=$username;
            header("location:index.php");	
           
            
        }else{
            echo'
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <p>Tên đăng nhập hoặc mật khẩu sai, vui lòng nhập lại!</p>
                </div>
                </div>  
            </div>';
        }
        
       
    }

    ?>
</div>
</body>
</html>