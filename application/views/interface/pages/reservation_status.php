<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title">Reservations</h1>
    <?=$this->form_builder->open_form(array('action' => ''))?>
    <?=$this->form_builder->close_form()?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>