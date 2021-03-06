<?php
	$room_type = ['' => 'No room type yet'];
	if ( is_array($room_types) ) {
		foreach($room_types as $rt):
			$room_type[$rt->room_type_id] = $rt->name; 
		endforeach;
	}

	$room   = (isset($room[0]))? $room[0] : NULL;
	$get = (isset($room->room_id))? '?rid='.$room->room_id : NULL;
	$rtype_id = (isset($room->room_type_id))? $room->room_type_id : NULL;
	$name = (isset($room->room_name))? $room->room_name : NULL;
	$desc = (isset($room->room_description))? $room->room_description : NULL;
	$room_number = (isset($room->room_number))? $room->room_number : NULL;
	$max_adult = (isset($room->max_adult))? $room->max_adult : NULL;
	$max_child = (isset($room->max_child))? $room->max_child : NULL;
	$room_rate = (isset($room->room_rate))? $room->room_rate : NULL;
	//$room_count = (isset($room->room_count))? $room->room_count : NULL;
?>
<?=$this->form_builder->open_form(array('action' => 'room/create_room'.$get)); ?>
<?php
	echo $this->form_builder->build_form_horizontal(
	array(
		array(
			'id' => 'room_number',
			'value' => $room_number,
			'disabled' => TRUE,
			'placeholder' => 'Auto Generated'
		),
		array(
			'id' => 'name',
			'value' => $name,
			'required' => TRUE,
		),
		array(
			'id' => 'room_description',
			'value' => $desc,
			'required' => TRUE,
		),
		array(
			'id' => 'max_adult',
			'value' => $max_adult,
			'onkeypress' => 'return isNumber(event, 0)',
			'required' => TRUE,
		),
		array(
			'id' => 'max_child',
			'value' => $max_child,
			'onkeypress' => 'return isNumber(event, 0)',
			'required' => TRUE,
		),
		array(
			'id' => 'room_rate',
			'value' => $room_rate,
			'onkeypress' => 'return isNumber(event, 0)',
			'required' => TRUE,
		),
		//array(
			//'id' => 'room_count',
			//'value' => $room_count
		//),
		array(
			'id' => 'room_type_id',
			'type' => 'dropdown',
			'options' => $room_type,
			'value' => $rtype_id,
			'required' => TRUE,
		),
		array(
			'id'   => 'submit',
			'type' => 'submit',
		),
	));
?>
<?= $this->form_builder->close_form(); ?>