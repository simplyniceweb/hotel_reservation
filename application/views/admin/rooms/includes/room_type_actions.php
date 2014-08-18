<?php
	$rt   = (isset($room_type[0]))? $room_type[0] : NULL;
	$get = (isset($rt->room_type_id))? '?rtid='.$rt->room_type_id : NULL;
	$name = (isset($rt->name))? $rt->name : NULL;
	$description = (isset($rt->description))? $rt->description : NULL;
	//$availability = (isset($rt->availability))? $rt->availability : NULL;
?>
<?=$this->form_builder->open_form(array('action' => 'roomtype/create_room_type'.$get)); ?>
<?php
	echo $this->form_builder->build_form_horizontal(
	array(
		array(
			'id' => 'name',
			'value' => $name,
			'required' => TRUE
		),
		array(
			'id' => 'descriptions',
			'type' => 'textarea',
			'value' => $description,
			'required' => TRUE
		),
		//array(
			//'id' => 'availability',
			//'value' => $availability
		//),
		array(
			'id'   => 'submit',
			'type' => 'submit',
		),
		//array(
			//'id' => 'max_person'
		//),
	));
?>
<?= $this->form_builder->close_form(); ?>