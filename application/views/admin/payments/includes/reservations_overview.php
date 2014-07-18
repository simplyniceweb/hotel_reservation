<table class="table table-hovered table-striped">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Code</th>
            <th>Bill</th>
            <th>Email Address</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach( $reservations->result() as $res) {
		if ($res->title == 1) {
			$title = "Mr.";
		} else if($res->title == 2) {
			$title = "Ms.";
		} else if($res->title == 3) {
			$title = "Mrs.";
		}
	?>
    	<tr>
        	<td><?=$title." ".$res->first_name." ".$res->last_name?></td>
            <td><?=$res->reservation_code?></td>
            <td>Php <?=number_format($res->bill, 2)?></td>
            <td><?=$res->email_address?></td>
            <td>
            	<a href="javascript:void(0);" class="ppover" data-toggle="popover" title="Address" 
                data-content="<?=$res->address.", ".$res->city.", ".$res->province.", ".$res->zip_postal?>"><i class="fa fa-eye"></i> View</a>
            </td>
            <td>
                <div class="btn-group">
                <!--
                  <a href="<?=base_url()?>reservations/edit_reservation?rid=<?=$res->reservation_id?>" class="btn btn-primary btn-xs">
                  <i class="fa fa-fw fa-pencil"></i> Edit</a>
                -->
                  <a href="<?=base_url()?>reservations/cancel_reservation?rid=<?=$res->reservation_id?>" class="btn btn-primary btn-xs btn-delete">
                  <i class="fa fa-fw fa-trash-o"></i> Delete / Cancel</a>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>