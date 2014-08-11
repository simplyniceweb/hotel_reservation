<table class="table table-hovered table-striped">
    <thead>
        <tr>
            <th>Payment Type</th>
            <th>Reservation details</th>
            <th>Notes / Proof</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
		foreach($transactions->result() as $row):
		$transaction_status = $row->transaction_status;
	?>
        <tr class="row-<?=$row->transaction_id?>">
            <td><?=$row->payment_name?></td>
            <td>
            <a href="#" class="reservation-details" data-id="<?=$row->reservation_id?>" data-toggle="modal" data-target="#reservationDetails"><i class="fa fa-fw fa-eye"></i> View</a>
            </td>
            <td>
                <a href="#" class="notes-proof" data-id="<?=$row->transaction_id?>" data-toggle="modal" data-target="#notesProof"><i class="fa fa-fw fa-eye"></i> View</a>
                <p class="notes-<?=$row->transaction_id?> hide"><?=$row->notes?></p>
                <span class="proof-<?=$row->transaction_id?> hide"><?=$row->proof?></span>
            </td>
            <td>
            	<?php
                	$stats = ' data-status="enabled"';
					if ($transaction_status == 4): 
					$stats = ' data-status="disabled" disabled="disabled"';
					endif;
				?>
            	<select class="transaction-status form-control input-sm" data-id="<?=$row->transaction_id?>"<?=$stats?>>
                	<option value="1"<?php if ($transaction_status == 1): ?> selected='selected'<?php endif; ?>>Pending</option>
                	<option value="2"<?php if ($transaction_status == 2): ?> selected='selected'<?php endif; ?>>Processing</option>
                	<option value="3"<?php if ($transaction_status == 3): ?> selected='selected'<?php endif; ?>>Partial</option>
                	<option value="4"<?php if ($transaction_status == 4): ?> selected='selected'<?php endif; ?>>Cancelled</option>
                	<option value="5"<?php if ($transaction_status == 5): ?> selected='selected'<?php endif; ?>>Paid</option>
                </select>
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
</table>

<!-- Notes & Proof -->
<div class="modal fade" id="notesProof">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Notes & Proof</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<!-- Reservation Details -->
<div class="modal fade" id="reservationDetails">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
        	<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
		</button>
        <h4 class="modal-title">Reservation Details</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>