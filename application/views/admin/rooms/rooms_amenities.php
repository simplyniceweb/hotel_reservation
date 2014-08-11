<?php
$name = "Room amenities";
include(__DIR__.'/../../header.php');
include(__DIR__.'/../navbar.php');
?>

<div class="container">
    <div class="jumbotron">
    <?php include(__DIR__.'/../../messages.php'); ?>
    <h1>Room Amenities</h1>
    <ul class="nav nav-tabs" role="tablist">
      <li<?php if($active == 1):?> class="active"<?php endif;?>><a href="<?=base_url()?>roomamenities">Overview</a></li>
      <li<?php if($active == 2):?> class="active"<?php endif;?>><a href="<?=base_url()?>roomamenities/create_room_amenities">Create</a></li>
    </ul>
    <div class="row">
        <div class="divider-md col-md-12"></div>
        <div class="col-sm-12">
		<?php
        if($active == 1):
            include(__DIR__.'/includes/room_amenities_overview.php');
            else:
            include(__DIR__.'/includes/room_amenities_actions.php');
        endif;
        ?>
        </div>
    </div>
</div>

</div>

<?php include(__DIR__.'/../../footer.php'); ?>