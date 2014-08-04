<table class="table table-hovered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <!-- <th>Availability</th> -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($room_types as $row): ?>
        <tr>
            <td><?=$row->name?></td>
            <td><?=$row->description?></td>
            <!-- <td><?=$row->availability?></td> -->
            <td>
                <div class="btn-group">
                  <a href="<?=base_url()?>roomtype/create_room_type?rtid=<?=$row->room_type_id?>" class="btn btn-primary btn-xs">
                  <i class="fa fa-fw fa-pencil"></i> Edit</a>
                  <a href="<?=base_url()?>roomtype/delete_room_type?rtid=<?=$row->room_type_id?>" class="btn btn-primary btn-xs btn-delete">
                  <i class="fa fa-fw fa-trash-o"></i> Delete</a>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>