<table class="table table-hovered table-striped">
    <thead>
        <tr>
        	<th>Room ID</th>
            <th>Room #</th>
            <th>Room Name</th>
            <th>View Images</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($room_images as $row): ?>
        <tr>
        	<td><?=$row->room_id?></td>
            <td><?=$row->number?></td>
            <td><?=$row->name?></td>
            <td><a href="" data-roomid="<?=$row->room_id?>" class="btn btn-primary btn-xs modal-room-img" data-toggle="modal" data-target="#imageModal">
            <i class="fa fa-fw fa-pencil"></i> View</a>
            </td>
            <td>
                <div class="btn-group">
                  <a href="<?=base_url()?>roomimage/delete_room_image?rid=<?=$row->room_id?>" class="btn btn-primary btn-xs btn-delete">
                  <i class="fa fa-fw fa-trash-o"></i> Delete ( All Room Images )</a>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>