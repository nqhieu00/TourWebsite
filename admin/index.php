<?php
    session_start();
    include "../lib/lib_db.php";
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost/cnw/public/css/ql.css?v=0">
</head>
<body>
    <?php
    if(isset($_GET["act"]))
	{
		$act=$_GET["act"];
		switch ($act)
		{
			case "logout":
			unset($_SESSION["loged"]);
			break;		
		}
	}
    if(!isset($_SESSION["loged"]))
	{
		header("location:login.php");
	}
    ?>
    <?php
        $param="";
        if(isset($_GET['Page_layout'])){
            switch ($_GET['Page_layout']){
                case 'list_tour':
                    require_once('view/tour.php');
                    break;
                case 'add_tour':
                    require_once('view/add_tour.php');
                    break;
                case 'update_tour':
                    require_once('view/update_tour.php');
                    break;
                case 'delete_tour':
                    require_once('view/delete_tour.php');
                    break;    
                case 'list_users':
                    require_once('view/users.php');
                    break;    
                case 'add_user':
                    require_once('view/add_user.php');
                    break;    
                case 'delete_user':
                    require_once('view/delete_user.php');   
                    break;         
                case 'list_booktour1':
                    require_once('view/booktour1.php');
                    break;
                case 'list_booktour2':
                    require_once('view/booktour2.php');
                    break;
                case 'update_booktour':
                    require_once('view/update_booktour.php');
                    break;
                case 'update_booktour_exec':
                    require_once('view/update_booktour_exec.php');
                    break;  
                case 'delete_booktour':
                    require_once('view/delete_booktour.php');
                    break;  
                case 'search':
                    require_once('view/search.php');
                    break;   
                case 'search_list':
                    require_once('view/search_list.php');
                    break;         
                default:
                    require_once('view/tour.php');
                    break;
            }
        }
        else{
            require_once('view/tour.php');
        }
       
 
    ?>
</body>
</html>