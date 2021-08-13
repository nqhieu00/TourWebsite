<?php
	
 	include "../lib/lib_db.php";
	session_start();
	$datatksp = "";
	$dl = $_POST['dulieu'];
	$_SESSION['search']=$dl;
	if($dl !="")
	{
	    $sql = "SELECT * FROM tour WHERE NameTour like '%$dl%' or GiaTien like '%$dl%'  LIMIT 4";
	    $datatksp = select_list($sql);
	    if($datatksp != "")
	    {	
	    	?>
<ul style="padding: 0px;padding: 0px;
    font-weight: 600;">
	<?php
			    foreach ($datatksp as $key) 
			    {
					if($key['IDNoiBat']==0){
			    ?>

	<div class="list-group" style="margin-bottom: 0px;">
		<a href="?Page_layout=search&IDTour=<?php echo $key['IDTour'] ?>"
			class="list-group-item list-group-item-action" style=" width:500px;height: 110px;">
			<img src="<?php echo $key['Image'] ?>" alt="" style="max-width:100px ;margin-right: 20px;float:left">
			<p>
				<?php echo $key['NameTour'] ?>
			</p>
			<p>Giá tiền :
				<?php echo number_format($key['GiaTien']) ?>đ
			</p>
		</a>

	</div>
	<?php	}
	else{
		$sql1="select *from NoiBat where IDNoiBat=".$key['IDNoiBat']; 
		$Noibat=select_one($sql1);
		?>

	<div class="list-group" style="margin-bottom: 0px;">
		<a href="?Page_layout=search&IDTour=<?php echo $key['IDTour'] ?>"
			class="list-group-item list-group-item-action" style=" width:500px;height: 110px;">
			<img src="<?php echo $key['Image'] ?>" alt="" style="max-width:100px ;margin-right: 20px;float:left">
			<p>
				<?php echo $key['NameTour'] ?>
			</p>
			<p class="price">
				
				<span class="mda-dis">Giá tiền :
					<?php echo(number_format( (1-$Noibat['GiamGia']*0.01)*$key['GiaTien']))?>đ
				</span>
				<span class="mda-pre" style="color: #bbb;text-decoration: line-through;font-weight: 300">
					<?php echo(number_format( $key['GiaTien']))?>đ
				</span>
			</p>

		</a>

	</div>
	<?php

			}
		}
	}
		
}
	?>
</ul>
