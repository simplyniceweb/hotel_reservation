<table class="table table-hover">
	<thead>
    	<tr>
            <th>Name</th>
            <th>Code</th>
            <th>Bill</th>
            <th>Email</th>
            <th>Address</th>
        	<th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
    	foreach($object as $row) {
		if($row->title == 1) {
			$title = 'Mr.';
		} else if($row->title == 2) {
			$title = 'Ms.';
		} else if($row->title == 3) {
			$title = 'Mrs.';
		}

		if ($row->view_status == 5) {
			$status = 'Active';
			$class = 'info';
		} else if ($row->view_status == 1) {
			$status = 'Cancelled';
			$class = 'danger';
		} else if ($row->view_status == 6) {
			$status = 'Paid';
			$class = 'success';
		}
	?>
    	<tr class="<?=$class?>">
        	<td><?=$title." ".$row->first_name." ".$row->last_name?></td>
            <td><?=$row->reservation_code?></td>
            <td>Php <?=number_format($row->bill, 2)?></td>
            <td><?=$row->email_address?></td>
            <td><?=$row->address?></td>
            <td><?=$status?></td>
        </tr>
	<?php } ?>
    </tbody>
</table>