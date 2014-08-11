<?php
$name = "Transactions";
include(__DIR__.'/../../header.php');
include(__DIR__.'/../navbar.php');
?>

<div class="container">
    <div class="jumbotron">
    <?php include(__DIR__.'/../../messages.php'); ?>
    <h1>Transactions</h1>
    <ul class="nav nav-tabs" role="tablist">
      <li<?php if($active == 1):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/">Pending</a></li>
      <li<?php if($active == 2):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/2">Processing</a></li>
      <li<?php if($active == 3):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/3">Partial</a></li>
      <li<?php if($active == 4):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/4">Cancelled</a></li>
      <li<?php if($active == 5):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/5">Paid</a></li>
    </ul>
    <div class="row">
        <div class="divider-md col-md-12"></div>
        <div class="col-sm-12">
        	<?php
            if ( $transactions->num_rows() > 0 ):
				include(__DIR__.'/includes/transaction_overview.php');
			?>
            <?php else: ?>
            	<p>No payments</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>

<?php include(__DIR__.'/../../footer.php'); ?>