<?php
	$get = $rid = $amenities = NULL;
	$type = "textarea";
	foreach($rooms as $rm) {
		$r[$rm->room_id] = $rm->room_name;
	}

	if(!is_null($amenities)) {
		foreach($amenities as $am) {
			$rid = $am->room_id;
			$amenities = $am->amenities_name;
			$get = (isset($am->room_amenities_id))? $am->room_amenities_id : NULL;
		}
		$type = NULL;
	}
?>
<?=$this->form_builder->open_form(array('action' => base_url().'roomamenities/create_room_amenities?raid='.$get))?>
<?php
	echo $this->form_builder->build_form_horizontal(
	array(
		array(
			'id' => 'room_id',
			'type' => 'dropdown',
			'options' => $r,
			'value' => $rid
		),
		array(
			'id' => 'amenities',
			'type' => (is_null($type))? $type : 'textarea',
			'placeholder' => (is_null($type))? $type : 'Seperated by asterisk, e.g. aircon*double bed',
			'value' => $amenities
		),
		array(
			'id'   => 'submit',
			'type' => 'submit',
		)
	));
?>
<?=$this->form_builder->close_form()?>