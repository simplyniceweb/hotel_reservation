
<table class="table table-hovered table-striped">
    <thead>
        <tr>
        	<th>Room Name</th>
            <th>Amenities</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($room_amenities as $row): ?>
    		<td><?=$row->name?></td>
            <td><?=$row->a_name?></td>
            <td>
                <div class="btn-group">
                  <a href="<?=base_url()?>roomamenities/create_room_amenities?raid=<?=$row->a_id?>" class="btn btn-primary btn-xs">
                  <i class="fa fa-fw fa-pencil"></i> Edit</a>
                  <a href="<?=base_url()?>roomamenities/delete_room_amenities?raid=<?=$row->a_id?>" class="btn btn-primary btn-xs btn-delete">
                  <i class="fa fa-fw fa-trash-o"></i> Delete</a>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>