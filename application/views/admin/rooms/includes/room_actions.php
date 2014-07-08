<?php
	foreach($room_types as $rt):
		$room_type[$rt->room_type_id] = $rt->name; 
	endforeach;

	$room   = (isset($room[0]))? $room[0] : NULL;
	$get = (isset($room->room_id))? '?rid='.$room->room_id : NULL;
	$name = (isset($room->room_name))? $room->room_name : NULL;
	$desc = (isset($room->room_description))? $room->room_description : NULL;
	$room_number = (isset($room->room_number))? $room->room_number : NULL;
	$max_adult = (isset($room->max_adult))? $room->max_adult : NULL;
	$max_child = (isset($room->max_child))? $room->max_child : NULL;
	$room_rate = (isset($room->room_rate))? $room->room_rate : NULL;
	$room_count = (isset($room->room_count))? $room->room_count : NULL;
?>
<?=$this->form_builder->open_form(array('action' => 'room/create_room'.$get)); ?>
<?php
	echo $this->form_builder->build_form_horizontal(
	array(
		array(
			'id' => 'room_number',
			'value' => $room_number
		),
		array(
			'id' => 'name',
			'value' => $name
		),
		array(
			'id' => 'room_description',
			'value' => $desc
		),
		array(
			'id' => 'max_adult',
			'value' => $max_adult
		),
		array(
			'id' => 'max_child',
			'value' => $max_child
		),
		array(
			'id' => 'room_rate',
			'value' => $room_rate
		),
		array(
			'id' => 'room_count',
			'value' => $room_count
		),
		array(
			'id' => 'room_type_id',
			'type' => 'dropdown',
			'options' => $room_type
		),
		array(
			'id'   => 'submit',
			'type' => 'submit',
		),
	));
?>
<?= $this->form_builder->close_form(); ?>