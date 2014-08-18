<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title"><?=(isset($rooms[1][0]->name))?$rooms[1][0]->name:'No rooms'?></h1>
    <p class="text-muted"><?=(isset($rooms[1][0]->description))?$rooms[1][0]->description:''?></p>
    <hr/>
    <div class="row">
    <?php
	if($rooms[2]>0) {
    foreach($rooms[0] as $room) {
	$image = $this->Rooms_Model->get_image($room->room_id);
	$img_url = "assets/images/rooms/".$image;
	$img_url = (file_exists($img_url)) ? base_url() . $img_url : "http://placehold.it/280x200";
	$amenities = $this->Rooms_Model->get_amenities($room->room_id);
	?>
    <span class="book-info-<?=$room->room_id?>" data-info="<?=$room->max_adult?>-<?=$room->max_child?>"></span>
      <div class="col-sm-6 col-md-5 col-lg-4">
        <div class="thumbnail">
            <img src="<?=$img_url?>">
          <div class="caption">
            <h3><?=$room->room_name?></h3>
            <p><?=$room->room_description?>.</p>
            <p><span class="label label-info">Per day / Php <?=number_format($room->room_rate, 2)?></span></p>
            <p><a href="#" class="amenities-anchor" data-id="<?=$room->room_id?>"><i class="fa fa-plus-circle"></i> Amenities</a></p>
            <div class="amenities-toggle amenities-<?=$room->room_id?>">
            	<?php if(!is_numeric($amenities)) { foreach($amenities as $amenity) { ?>
				<p><small><?=$amenity->amenities_name?></small></p>
                <?php } } else { ?>
                <p>No amenities</p>
                <?php } ?>
            </div>
            <p>
            	<a href="#" class="btn btn-success btn-sm" data-id="<?=$room->room_id?>" data-toggle="modal" data-target="#bookRoom">
                <i class="fa fa-home"></i> Book now!</a>
                <a href="#" class="btn btn-info btn-sm" data-id="<?=$room->room_id?>-<?=$room->room_name?>" data-toggle="modal" data-target="#roomGallery">
                <i class="fa fa-image"></i> View Gallery</a>
            </p>
          </div>
        </div>
      </div>
    <?php }} else { ?>
    	<div class="col-sm-12">
    		<p class="alert alert-danger"><i class="fa fa-home fa-2x"></i> No rooms yet</p>
        </div>
    <?php } ?>
    </div>
</div>

<!-- Gallery Modal -->
<div class="modal fade" id="roomGallery">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div class="simplyniceGallery"></div>
      </div>
      <div class="modal-footer simplynice-control">
        <button class="btn btn-warning btn-sm btn-p"><i class="fa fa-angle-double-left"></i> Prev</button>
        <button class="btn btn-info btn-sm btn-n">Next <i class="fa fa-angle-double-right"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Book -->
<?php include(__DIR__.'/../include/booking-modal.php'); ?>
<?php include(__DIR__.'/../footer.php'); ?>