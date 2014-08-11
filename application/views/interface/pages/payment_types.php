<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
    <div class="col-md-12">
		<h1 class="title">How to pay?</h1>
    </div>
    <?php foreach($payment_type as $row) { ?>
        <div class="col-md-12">
            <h1 class="title"><i class="fa fa-money"></i> <?=ucfirst($row->payment_name)?></h1>
            <p><span class="label label-info"><i class="fa fa-user"></i> Recipient Name:</span> <?=ucfirst($row->recipient_name)?></p>
            <p><span class="label label-info"><i class="fa fa-phone"></i> Recipient Phone:</span> <?=ucfirst($row->recipient_phone)?></p>
            <p><span class="label label-info"><i class="fa fa-home"></i> Recipient Address:</span> <?=ucfirst($row->recipient_address)?></p>
            <hr/>
        </div>
    <?php } ?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>