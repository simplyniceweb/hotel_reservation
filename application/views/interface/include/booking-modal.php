<?php
	$now = new \DateTime("now");
	$booking_details = array(
		array(
			'id' => 'check_in',
			'class' => 'datepicker',
			'value' => $now->format('Y-m-d'),
			'required' => 'required'
		),
		array(
			'id' => 'check_out',
			'class' => 'datepicker',
			'value' => $now->format('Y-m-d'),
			'required' => 'required'
		),
		array(
			'id' => 'adult',
			'type' => 'dropdown',
			'class' => 'adult_drop',
			'options' => array(
				'-1' => 'Please select',
			),
			'required' => 'required'
		),
		array(
			'id' => 'child',
			'type' => 'dropdown',
			'class' => 'child_drop',
			'options' => array(
				'-1' => 'Please select',
			),
			'required' => 'required'
		),
		array(
			'id'   => 'process',
			'type' => 'submit',
			'class' => 'process pull-right',
			'required' => 'required'
		),
	);
	$customer_details = array(
		array(
			'id' => 'title',
			'type' => 'dropdown',
			'options' => array(
				'1' => 'Mr',
				'2' => 'Ms',
				'3' => 'Mrs'
			)
		),
		array(
			'id' => 'first_name',
			'required' => 'required'
		),
		array(
			'id' => 'last_name',
			'required' => 'required'
		),
		array(
			'id' => 'email_address',
			'type' => 'email',
			'required' => 'required'
		),
		array(
			'id' => 'confirm_email_address',
			'type' => 'email',
			'required' => 'required'
		),
		array(
			'id' => 'address',
			'required' => 'required'
		),
		array(
			'id' => 'city',
			'required' => 'required'
		),
		array(
			'id' => 'province',
			'required' => 'required'
		),
		array(
			'id' => 'zip_postal',
			'required' => 'required'
		),
		array(
			'id'   => 'Reserve',
			'type' => 'submit',
			'class' => 'btn-warning pull-right'
		),
	);
?>
<div class="modal fade" id="bookRoom">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Booking Form</h4>
      </div>
      <div class="modal-body">
      	<?=$this->form_builder->open_form(array('action' => 'book', 'method' => 'get'))?>
        <h4 class="text-info">Booking Details</h4>
        <p class="text-warning">We will send you the booking details and other informations through email, please input a valid/working email address or else everything will be invalid. This is for security purpose.</p>
        <hr/>
        <input type="hidden" name="room_id" value=""/>
		<?=$this->form_builder->build_form_horizontal( $booking_details )?>
        <div class="customer_info hide">
        <h4 class="text-info">Guest Information</h4>
        <hr/>
        <?=$this->form_builder->build_form_horizontal( $customer_details )?>
        <div class="col-lg-12">
        <p class="text-warning text-center">Please verify that the above information is correct else everything will be nullified.</p>
        <p class="text-warning text-center">We will send you the reservation code in order to process the payment and to check reservation status.</p>
        </div>
        <?=$this->form_builder->close_form()?>
        </div>
      </div>
      <div class="modal-footer" style="border: none"></div>
    </div>
  </div>
</div>