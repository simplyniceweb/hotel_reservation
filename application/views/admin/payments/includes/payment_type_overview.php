<table class="table table-hovered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Recipient</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($query as $row): ?>
        <tr>
            <td><?=$row->payment_name?></td>
            <td><?=$row->recipient_name?></td>
            <td><?=$row->recipient_phone?></td>
            <td><?=$row->recipient_address?></td>
            <td>
                <div class="btn-group">
                  <a href="<?=base_url()?>paymentype/create_payment_type?pid=<?=$row->payment_id?>" class="btn btn-primary btn-xs">
                  <i class="fa fa-fw fa-pencil"></i> Edit</a>
                  <a href="<?=base_url()?>paymentype/delete_payment_type?pid=<?=$row->payment_id?>" class="btn btn-primary btn-xs btn-delete">
                  <i class="fa fa-fw fa-trash-o"></i> Delete</a>
                </div>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>