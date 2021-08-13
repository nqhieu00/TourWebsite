
<div class="header">
    <div class="header-navbar">
      <div class="navbar navbar-inverse"  data-spy="affix" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navbar-header">
                        <button class="navbar-toggle collapsed" data-target="#mobile_menu" data-toggle="collapse" aria-expanded="false"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                        <a href="index.php" class="navbar-brand">SaiGonTourist.com</a>
                    </div>
                    <div class="navbar-collapse collapse" id="mobile_menu" aria-expanded="false" >
                        <ul class="nav navbar-nav ">
                            <li class=""><a href="index.php">Trang chủ</a></li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Tour trong nước<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="Tour.php?IDVungMien=1">Miền Bắc</a></li>
                                    <li><a href="Tour.php?IDVungMien=2">Miền Trung</a></li>
                                    <li><a href="Tour.php?IDVungMien=3">Miền Nam</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <form class="navbar-form" action="search.php"  autocomplete="off" method="POST" >
                                    <div class="input-group dropdown" >
                                        <input type="text" class="form-control" required style="width:70%" placeholder="Tìm kiếm tour" class="form-control" id="usr" name="dulieu1" value=""
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
                                        <input type="submit" value="Search" class="form-control " style="width:30%;background: white;color: black;" >
                                    </div>  
                                </form>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right ">
                            <li><a href="#">Giới thiệu</a></li>
                            <li><a href="#">Cẩm nang du lịch</a></li>
                            <li><a href="tel:1900 1800" class="ticket-hotline">Hotline: 1900 1800</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
     
</div>