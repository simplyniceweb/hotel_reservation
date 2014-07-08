<?php $rt_id = (isset($rooms[1][0]->room_type_id))? $rooms[1][0]->room_type_id : NULL ?>
<div class="main_menu">
    <div class="container-fluid">
    	<div class="col-md-12 col-lg-3">
    	<img class="logo pull-left" src="<?=base_url()?>assets/icons/logo.png"/>
       </div>
       <div class="col-md-12 col-lg-9">
        <ul class="nav nav-pills pull-right">
            <li<?php if($active==1):?> class="active"<?php endif;?>><a href="<?=base_url()?>">Home</a></li>
            <li class="menu-drop<?php if($active==2):?> active<?php endif;?>">
            <div class="btn-group<?php if($active==2):?> active<?php endif;?>">
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">ROOMS</button>
              <ul class="dropdown-menu" role="menu">
              <?php
			  if($room_type->num_rows() > 0):
			  foreach($room_type->result() as $row): ?>
                <li<?php if($rt_id == $row->room_type_id):?> class="active"<?php endif; ?>>
                <a href="<?=base_url()?>rooms/<?=$row->room_type_id?>"><?=$row->name?></a>
                </li>
              <?php
              endforeach;
			  else:
			  ?>
              	<li><a href="#">No room type(s) yet</a></li>
              <?php endif; ?>
              <li role="presentation" class="divider"></li>
              <li><a href="#">Room payment</a></li>
              <li><a href="#">Reservation status</a></li>
              </ul>
            </div>
            </li>
            <!--<li<?php if($active==2):?> class="active"<?php endif;?>><a href="<?=base_url()?>rooms">Rooms</a></li>-->
            <li<?php if($active==3):?> class="active"<?php endif;?>><a href="<?=base_url()?>facilities">Facilities</a></li>
            <li<?php if($active==4):?> class="active"<?php endif;?>><a href="<?=base_url()?>house-rules">House Rules</a></li>
            <li<?php if($active==5):?> class="active"<?php endif;?>><a href="<?=base_url()?>map">Map & Location</a></li>
            <li<?php if($active==6):?> class="active"<?php endif;?>><a href="<?=base_url()?>contact">Contact Us</a></li>
        </ul>
        </div>
    </div>
</div>