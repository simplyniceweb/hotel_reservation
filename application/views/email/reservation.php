<?php
$webname = $this->config->item('website_name');
if(base_url() == 'http://localhost/hotel_reservation/') {
	$base = 'http://hotel-reservation.fulba.com/';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?=$webname?></title>
<style>
table tbody tr td {
	min-width: 300px
}
</style>
</head>
<body>
<div class="container">
	<img class="logo pull-left" src="<?=$base?>assets/icons/logo.png"/>
	<div class="col-lg">
    <?php
	$total = 0;
    foreach($result as $row):
	if($row->title == 1) {
		$title = 'Mr';
	} else if($row->title == 2) {
		$title = 'Ms';
	} else if($row->title == 3) {
		$title = 'Mrs';
	}
	?>
    <p>Dear <?=$title.'. '.ucfirst($row->first_name).' '.ucfirst($row->last_name)?>,</p>
    <p>Thank you for choosing to stay with us at the <?=$webname?>. We are pleased to confirm your reservation as follows:</p>
    <p style="color:#FF0004">Note: Please keep the reservation code as you will use it to check reservation status and paying.</p>
	<table>
    	<tbody>
			<?php
            $reservations = $this->db->get_where('reserved_room', array('reservation_id' => $id, 'view_status' => 5), 1)->result();
            $room = $this->db->get_where('room', array('room_id' => $reservations[0]->room_id, 'view_status' => 5), 1)->result();

			$unix_date = strtotime($reservations[0]->check_out) - strtotime($reservations[0]->check_in);
			$how_many_days = floor($unix_date/3600/24);
			$per_room_total = $room[0]->room_rate*floor($unix_date/3600/24);
			$total += $per_room_total;
            ?>
        	<tr>
            	<td style="min-width: 300px">Reservation code:</td>
                <td style="min-width: 300px"><?=$row->reservation_code?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Guest Name:</td>
                <td style="min-width: 300px"><?=ucfirst($row->first_name).' '.ucfirst($row->last_name)?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Adult:</td>
                <td style="min-width: 300px"><?=$reservations[0]->adult?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Children:</td>
                <td style="min-width: 300px"><?=$reservations[0]->child?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Check in:</td>
                <td style="min-width: 300px"><?=date('M d, Y', strtotime($reservations[0]->check_in))?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Check out:</td>
                <td style="min-width: 300px"><?=date('M d, Y', strtotime($reservations[0]->check_out))?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Days:</td>
                <td style="min-width: 300px"><?=$how_many_days.' Days'?></td>
            </tr>
        	<tr>
            	<td style="min-width: 300px">Rate per night:</td>
                <td style="min-width: 300px">Php <?=number_format($room[0]->room_rate, 2)?></td>
            </tr>
            <!--
        	<tr>
            	<td style="min-width: 300px">Per Room total:</td>
                <td style="min-width: 300px">Php <?=number_format($per_room_total, 2)?></td>
            </tr>
            -->
        </tbody>
    </table>
    <?php endforeach; ?>
	<table>
    	<tbody>
        	<tr>
            	<td style="min-width: 300px">Total:</td>
                <td style="min-width: 300px">Php <?=number_format($total, 2)?></td>
            </tr>
        </tbody>
    </table>
    <br/>
    <p>You have 24 hours to confirm your reservation(s).</p>
    <p>To check for your reservation status, copy the reservation code and visit the link below:</p>
    <p><a href="<?=base_url()?>reservation_status" target="_blank">Reservation status</a></p>
    <p>To pay for your reservation, copy the reservation code and visit the link below:</p>
    <p><a href="<?=base_url()?>room_payment" target="_blank">Reservation payment</a></p>
    <p>We look forward to the pleasure of having you as our guest at the <?=$webname?>.</p>
    <br/>
    <p>Sincerely,</p>
    <br/>
    <p>Management</p>
    </div>
</div>
</body>
</html>