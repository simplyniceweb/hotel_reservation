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
      <li<?php if($active == 1):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/index">Pending</a></li>
      <li<?php if($active == 2):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/index/2">Processing</a></li>
      <li<?php if($active == 3):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/index/3">Partial</a></li>
      <li<?php if($active == 4):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/index/4">Cancelled</a></li>
      <li<?php if($active == 5):?> class="active"<?php endif;?>><a href="<?=base_url()?>transactions/index/5">Paid</a></li>
    </ul>
    <div class="row">
        <div class="divider-md col-md-12"></div>
        <div class="col-sm-12">
        </div>
    </div>
</div>

</div>

<?php include(__DIR__.'/../../footer.php'); ?>