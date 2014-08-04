<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roomamenities extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$msg = $this->session->flashdata('msg');
		$this->db->select('ra.room_amenities_id as a_id, ra.amenities_name as a_name, r.room_id as room_id, r.room_name as name, r.room_number as number');
		$this->db->from('room_amenities as ra');
		$this->db->join('room as r', 'r.room_id = ra.room_id');
		$this->db->join('room_type as rt', 'rt.room_type_id = r.room_type_id');
		$this->db->where('ra.view_status', 5);
		$this->db->where('r.view_status', 5);
		$this->db->where('rt.view_status', 5);
		$query = $this->db->get();
		$data = array(
			'active' => 1,
			'room_amenities' => $query->result(),
			'msg' => (isset($msg))? $msg : NULL,
			'title' => $this->config->item('website_name') . ' - Room Amenities'
		);
		$this->load->view("admin/rooms/rooms_amenities", $data);
	}

	public function create_room_amenities() {
		$query = NULL;
		$raid  = $this->input->get('raid');
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
			$now = date('Y-m-d');
			$room_id = $this->input->post('room_id');
			$amenities = $this->input->post('amenities');
			if(isset($amenities) && !empty($amenities)):
				$amenities_array = explode("*", $amenities);
				if(!is_array($amenities_array) || isset($raid) && is_numeric($raid)) {
						$data = array(
							'room_id' => $room_id,
							'amenities_name' => $amenities,
							'view_status' => 5,
							'created_at'  => $now,
							'modified_at' => $now
						);
						if(is_numeric($raid)) {
							$msg = 'update';
							$this->db->where("room_amenities_id", $raid);
							$this->db->update("room_amenities", $data);
						} else {
							$msg = "save";
							$this->db->insert("room_amenities", $data);
						}
				} else {
					foreach($amenities_array as $amenity):
						if(empty($amenity)) continue;
						$data = array(
							'room_id' => $room_id,
							'amenities_name' => $amenity,
							'view_status' => 5,
							'created_at'  => $now,
							'modified_at' => $now
						);
						$msg = "save";
						$this->db->insert("room_amenities", $data);
					endforeach;
				}
			else:
				$msg = "null";
			endif;

			$this->session->set_flashdata('msg', $msg);
			redirect('roomamenities');

			else:
				if(isset($raid) && !is_null($raid)):
					$query = $this->db->get_where('room_amenities', array('room_amenities_id' => $raid), 1)->result();
				endif;

				$this->load->helper('form');
				$this->load->library('form_builder');
		endif;

		$data = array(
			'active' => 2,
			'amenities' => $query,
			'rooms'   => $this->db->get_where('room', array('view_status' => 5))->result(),
			'title'  => $this->config->item('website_name') . '- Create Room Amenities'
		);
		$this->load->view("admin/rooms/rooms_amenities", $data);
	}

	public function delete_room_amenities() {
		$raid = $this->input->get('raid');
		$query = $this->db->get_where('room_amenities', array('room_amenities_id' => $raid), 1);
		if(isset($raid) && is_numeric($raid) && $query->num_rows()>0):
				$this->db->where('room_amenities_id', $raid);
				$this->db->update('room_amenities', array('view_status' => 1));
				$msg = 'delete';
			else:
				$msg = 'null';
		endif;

		$this->session->set_flashdata('msg', $msg);
		redirect('roomamenities');
	}
}