
<ul class="pagination" style="display: flex; justify-content: center;">
    <li class="page-item">
        <a class="page-link" href="?<?php echo $param; ?>per_page=<?php echo  $item_per_page; ?>&page=1" aria-label="Previous">
        
        <span aria-hidden="true">&laquo;</span>
        <span >Đầu</span>
           
        </a>
    </li>
    
  
    <?php for($i=1; $i<=$TotalPage;$i++) { 
        
        if($current_page<>$i){
           
            if($i>$current_page-3 and $i<$current_page+3){

      ?>
    <li class="page-item"><a class="page-link" href="?<?php echo $param; ?>per_page=<?php echo  $item_per_page; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php
        }
        }
        else{
            ?>
            <li class="page-item active"><a class="page-link" > <?php echo $i; ?> </a></li>
            <?php
        }
    } ?>
    <li class="page-item">
        <a class="page-link" href="?<?php echo $param; ?>per_page=<?php echo  $item_per_page; ?>&page=<?php echo $TotalPage;  ?>" aria-label="Next">
            <span >Cuối</span>
            <span aria-hidden="true">&raquo;</span>
            
        </a>
    </li>
</ul>