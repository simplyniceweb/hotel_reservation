<?php
	$success = "<div class='alert alert-success'>". $name ." added.</div>";
	$update = "<div class='alert alert-success'>". $name ." updated.</div>";
	$delete = "<div class='alert alert-success'>". $name ." deleted.</div>";
	$retry = "<div class='alert alert-warning'>Retry</div>";
	if(isset($msg) && !is_null($msg))
		switch($msg) {
			case 'save':
					echo $success;
					break;
			case 'update':
					echo $update;
					break;
			case 'delete':
					echo $delete;
					break;
			case 'null':
					echo $retry;
					break;
			default:
					echo "<div class='alert alert-warning'>" . $msg . "</div>";
				break;
		}
?>