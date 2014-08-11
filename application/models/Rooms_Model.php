<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooms_Model extends CI_Model {

	public function get_image($room_id = NULL) {
		$image = $this->db->get_where('room_images', array('room_id' => $room_id, 'view_status' => 5), 1);
		$image = $image->result();
		if($image) {
			return $image[0]->file_name;
		}
		return "default.png";
	}

	public function get_amenities($room_id = NULL) {
		$amenities = $this->db->get_where('room_amenities', array('room_id' => $room_id, 'view_status' => 5));
		$amenities = $amenities->result();
		if($amenities) {
			return $amenities;
		}
		return 1;
	}
}