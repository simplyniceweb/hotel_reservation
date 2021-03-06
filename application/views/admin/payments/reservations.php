<?php
$name = "Reservations";
include(__DIR__.'/../../header.php');
include(__DIR__.'/../navbar.php');
?>

<div class="container">
    <div class="jumbotron">
		<?php include(__DIR__.'/../../messages.php'); ?>
        <h1>Reservations</h1>
        <?=form_open('reservations/search');?>
        <input type="hidden" name="status" value="<?=$active?>"/>
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" autofocus>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
        <?=form_close();?>
        <ul class="nav nav-tabs" role="tablist">
          <li<?php if($active == 1):?> class="active"<?php endif;?>><a href="<?=base_url()?>reservations/">Active</a></li>
          <li<?php if($active == 2):?> class="active"<?php endif;?>><a href="<?=base_url()?>reservations/1">Cancelled</a></li>
          <li<?php if($active == 3):?> class="active"<?php endif;?>><a href="<?=base_url()?>reservations/6">Paid</a></li>
        </ul>
        <div class="row">
            <div class="divider-md col-md-12"></div>
            <div class="col-sm-12">
            <?php
				include(__DIR__.'/includes/reservations_overview.php');
			?>
            </div>
        </div>
	</div>
</div>

<?php include(__DIR__.'/../../footer.php'); ?>