<?php
    
    if(isset($_POST["submit"])){
        $dulieu=isset($_POST['dulieu1'])?$_POST['dulieu1']:"";
        $_SESSION['search']=$dulieu;
    }
    else{
        unset($_SESSION['search']);
    }
   
?>
<div class="container-fluid">
        <div class="header">
            <div class="row">
            <div class="col-lg-2 dropdown">
                    <button class="TOUR" href="#">Quản lý</button>
                    <div class="dropdown-content">
                        <a href="?Page_layout=add_user">Thêm Quản lý</a>
                        <a href="?Page_layout=list_users">Danh sách Quản lý</a>
                    </div>
                </div>
                <div class="col-lg-2 dropdown">
                    <button class="TOUR" href="#">TOUR</button>
                    <div class="dropdown-content">
                        <a href="?Page_layout=add_tour">Thêm Tour</a>
                        <a href="?Page_layout=list_tour">Danh sách Tour</a>
                    </div>
                </div>
                <div class="col-lg-2 dropdown">
                    <button class="TOUR" href="#">ĐƠN HÀNG</button>
                    <div class="dropdown-content">
                        <a href="?Page_layout=list_booktour1">Danh sách đơn hàng chưa đi</a>
                        <a href="?Page_layout=list_booktour2">Đơn đã đi</a>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <ul class="nav navbar-nav">
                    <li>
                        <form class="navbar-form" action="?Page_layout=search_list"  autocomplete="off" method="POST" >
                            <div class="input-group dropdown" >
                                <input type="text" class="form-control" required style="width:70%" placeholder="Tìm kiếm tour" 
                                value="<?php if(isset($_SESSION['search'])){ echo $_SESSION['search']; }?>" class="form-control" id="usr" name="dulieu1"
                                onkeyup="search(this.value)">
                                <ul class="dropdown-menu" id="search" style="display:none;">
                                    <li><div class="kqtk" style="" id="kqtk"></li>
                                </ul>
                                <script>
                                function search(dulieu) {
                                    $.post('ajax-db-search.php', { 'dulieu': dulieu }, function (data) {
                                        var data1 = data;
                                        if (data1 != "") {
                                            document.getElementById("kqtk").innerHTML = data;
                                            document.getElementById("kqtk").style.display = "block";
                                            document.getElementById("search").style.display = "block";
                                        }
                                        else {
                                            document.getElementById("kqtk").style.display = "none";
                                            document.getElementById("search").style.display = "none";
                                        }

                                    });
                                }
                                </script>
                                <input type="submit" value="Search" class="form-control " style="width:30%" >
                            </div>  
                        </form>
                    </li>
                        <li class=""><a>Xin chào <?php echo  $_SESSION["adminUser"]; ?> </a></li>
                        <li><a href="index.php?act=logout">Đăng xuất</a></li>
                    </ul>
                </div>
        </div>
</div>