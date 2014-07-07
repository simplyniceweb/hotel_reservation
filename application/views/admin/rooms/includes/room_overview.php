<?php
	$convert = ($this->config->item('USD') == 1)? 1 : 0;
?>
<table class="table table-hovered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Room type</th>
            <th>Room number</th>
            <th>Room Rate</th>
            <th>Max adult / Max child</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($rooms as $row): ?>
	<?php
        $room_rate = $row->room_rate;
        if($convert == 1 && $room_rate > 0):
            $from = urlencode("PHP");
            $to = urlencode("USD");
            $get = explode("<span class=bld>", file_get_contents("https://www.google.com/finance/converter?a=$room_rate&from=$from&to=$to"));
            $get = explode("</span>",$get[1]);
            $room_rate = "$ ". preg_replace("/[^0-9\.]/", null, $get[0]);
        else:
            $room_rate = "Php ". number_format($room_rate, 2);
        endif;
    ?>
        <tr>
            <td><?=$row->room_name?></td>
            <td><?=$row->name?></td>
            <td><span class="label label-warning">#<?=$row->room_number?></span></td>
            <td><span class="label label-success"><?=$room_rate?></span></td>
            <td>
            	<span class="label label-warning"><?=$row->max_adult?></span> / <span class="label label-warning"><?=$row->max_child?></span>
			</td>
            <td>
                <div class="btn-group">
                  <a href="<?=base_url()?>room/create_room?rid=<?=$row->room_id?>" class="btn btn-primary btn-xs">
                  <i class="fa fa-fw fa-pencil"></i> Edit</a>
                  <a href="<?=base_url()?>room/delete_room?rid=<?=$row->room_id?>" class="btn btn-primary btn-xs btn-delete">
                  <i class="fa fa-fw fa-trash-o"></i> Delete</a>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>