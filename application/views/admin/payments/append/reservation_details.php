<?php
foreach($query as $row):
if ($row->title == 1):
	$title = 'Mr.';
elseif($row->title == 2):
	$title = 'Ms.';
elseif($row->title == 3):
	$title = 'Mrs.';
endif;
?>
<table class="table table-striped table-bordered">
	<tbody>
    	<tr>
        	<td>Reservation code:</td>
            <td><?=$row->reservation_code?></td>
        </tr>
    	<tr>
        	<td>Bill:</td>
            <td>Php <?=$row->bill?></td>
        </tr>
    	<tr>
        	<td>Name of Guest:</td>
            <td><?=$title." ".$row->first_name." ".$row->last_name?></td>
        </tr>
    	<tr>
        	<td>Email Address:</td>
            <td>Php <?=$row->email_address?></td>
        </tr>
    	<tr>
        	<td>Address:</td>
            <td>Php <?=$row->address?></td>
        </tr>
    	<tr>
        	<td>City:</td>
            <td>Php <?=$row->city?></td>
        </tr>
    	<tr>
        	<td>Province:</td>
            <td>Php <?=$row->province?></td>
        </tr>
    	<tr>
        	<td>Zip Postal:</td>
            <td>Php <?=$row->zip_postal?></td>
        </tr>
    </tbody>
</table>
<?php endforeach; ?>