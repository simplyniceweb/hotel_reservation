<?php
if($count > 0) {
foreach($result as $row) { ?>
	<img src="<?=base_url()."assets/images/rooms/"?><?=$row->file_name?>" alt="" class="img-thumbnail">
<?php } } else { ?>
	<h4>No images..</h4>
<?php } ?>