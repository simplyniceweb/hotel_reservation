<?php
	$payment_type   = (isset($payment_type[0]))? $payment_type[0] : NULL;
	$get = (isset($payment_type->payment_id))? '?pid='.$payment_type->payment_id : NULL;
	$pname = (isset($payment_type->payment_name))? $payment_type->payment_name : NULL;
	$rname = (isset($payment_type->recipient_name))? $payment_type->recipient_name : NULL;
	$rphone = (isset($payment_type->recipient_phone))? $payment_type->recipient_phone : NULL;
	$address = (isset($payment_type->recipient_address))? $payment_type->recipient_address : NULL;
?>
<?=$this->form_builder->open_form(array('action' => 'paymentype/create_payment_type'.$get)); ?>
<?php
	echo $this->form_builder->build_form_horizontal(
	array(
		array(
			'id' => 'payment_name',
			'value' => $pname,
			'required' => TRUE
		),
		array(
			'id' => 'recipient_name',
			'value' => $rname,
			'required' => TRUE
		),
		array(
			'id' => 'recipient_phone',
			'value' => $rphone,
			'required' => TRUE
		),
		array(
			'id' => 'recipient_address',
			'type'  => 'textarea',
			'value' => $address,
			'required' => TRUE
		),
		array(
			'id'   => 'submit',
			'type' => 'submit',
		)
	));
?>
<?= $this->form_builder->close_form(); ?>