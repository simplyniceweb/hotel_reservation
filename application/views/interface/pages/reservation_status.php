<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title">Reservations</h1>
    <div class="row">
        <div class="col-md-12">
        	<div class="form-group">
            <label for="res_code">Reservation code:</label>
            <input type="text" id="res_code" class="form-control reservation-code"/>
            </div>
        	<div class="form-group">
            	<button class="btn btn-primary btn-sm res_code"><i class="fa fa-circle-o-notch"></i> Check status</button>
            </div>
        </div>
        <div class="col-md-12 reservations-wrapper"></div>
    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>