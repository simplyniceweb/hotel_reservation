<?php
	foreach($rooms as $rm) {
		$r[$rm->room_id] = $rm->room_name;
	}
?>
<?=$this->form_builder->open_form(array('action' => 'roomimage/create_room_image', 'enctype' => 'multipart/form-data')); ?>
<?php
	echo $this->form_builder->build_form_horizontal(
	array(
		array(
			'id' => 'room_id',
			'type' => 'dropdown',
			'options' => $r
		),
		array(
			'id' => 'file_name',
			'type' => 'upload',
			'name' => 'room_images[]',
			'multiple' => 'true'
		),
		array(
			'id'   => 'submit',
			'type' => 'submit',
		)
	));
?>
<?= $this->form_builder->close_form(); ?>