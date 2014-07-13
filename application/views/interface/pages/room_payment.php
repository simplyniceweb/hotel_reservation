<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
$payment[0] = 'Type of payment';
foreach($payment_type as $row) {
	$payment[$row->payment_id] = $row->payment_name;
}
$booking_details = array(
	array(
		'id'   => 'reservation_code',
		'autofocus' => true,
		'required' => 'required'
	),
	array(
		'id'      => 'payment_type',
		'type'    => 'dropdown',
		'options' => $payment,
		'required' => 'required'
	),
	array(
		'id'   => 'notes',
		'type' => 'textarea',
		'required' => 'required'
	),
	array(
		'id'   => 'userfile',
		'type' => 'upload',
		'label' => 'Proof of payment',
		'required' => 'required'
	),
	array(
		'id'   => 'Submit',
		'type' => 'submit',
		'class' => 'btn-success pull-right'
	),
);
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title">Payments</h1>
    <?=$this->form_builder->open_form(array('action' => 'paymentype/pay', 'enctype' => 'multipart/form-data'))?>
    	<?=$this->form_builder->build_form_horizontal( $booking_details )?>
    <?=$this->form_builder->close_form()?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>