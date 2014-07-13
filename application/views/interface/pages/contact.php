<?php
include(__DIR__.'/../header.php');
include(__DIR__.'/../nav.php');
$contact_fields = array(
	array(
		'id' => 'full_name',
		'required' => 'required',
		'autofocus' => TRUE
	),
	array(
		'id' => 'email_address',
		'type' => 'email',
		'required' => 'required'
	),
	array(
		'id' => 'message',
		'type' => 'textarea',
		'required' => 'required'
	),
	array(
		'id'    => 'send',
		'type'  => 'submit',
		'class' => 'btn-info pull-right'
	),
);
?>

<div class="wrapper container round">
	<div class="col-md-12 md-spacer"></div>
	<h1 class="title text-center">Contact Us</h1>
    <?=$this->form_builder->open_form(array('action' => 'admin/contact_form'))?>
    <?=$this->form_builder->build_form_horizontal( $contact_fields )?>
    <?=$this->form_builder->close_form()?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>