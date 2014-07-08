<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$msg = $this->session->flashdata('msg');
		$this->db->select('*');
		$this->db->from('room_type as rt');
		$this->db->join('room as r', 'r.room_type_id = rt.room_type_id');
		$this->db->where('rt.view_status', 5);
		$this->db->where('r.view_status', 5);
		$query = $this->db->get();

		$data = array(
			'active' => 1,
			'rooms'  => $query->result(),
			'msg'    => (isset($msg))? $msg : NULL,
			'title'  => $this->config->item('website_name') . ' - Room'
		);
		$this->load->view("admin/rooms/rooms", $data);
	}

	public function create_room() {
		$query = NULL;
		$rid  = $this->input->get('rid');
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
				$now = date('Y-m-d');
				$name = $this->input->post('name');
				$desc = $this->input->post('room_description');
				$room_type_id = $this->input->post('room_type_id');
				$room_number = $this->input->post('room_number');
				$max_adult = $this->input->post('max_adult');
				$max_child = $this->input->post('max_child');
				$room_rate = $this->input->post('room_rate');
				$room_count = $this->input->post('room_count');
				$data = array(
					'room_type_id'  => $room_type_id,
					'room_name' => $name,
					'room_description' => $desc,
					'room_number'  => $room_number,
					'max_adult'    => $max_adult,
					'max_child'    => $max_child,
					'room_rate'    => $room_rate,
					'room_count'   => $room_count,
					'view_status'  => 5,
					'created_at'   => $now,
					'modified_at'  => $now,
				);
				if(isset($rid) && !is_null($rid)):
					$msg = 'update';
					$this->db->where('room_id', $rid);
					$this->db->update('room', $data); 
				else:
					$msg = 'save';
					$this->db->insert('room', $data);
				endif;
				$this->session->set_flashdata('msg', $msg);
				redirect('room');
			else:
				if(isset($rid) && !is_null($rid)):
					$query = $this->db->get_where('room', array('room_id' => $rid), 1)->result();
				endif;

				$this->load->helper('form');
				$this->load->library('form_builder');
		endif;

		$data = array(
			'active' => 2,
			'room'   => $query,
			'room_types' => $this->db->get_where('room_type', array('view_status' => 5))->result(),
			'title'  => $this->config->item('website_name') . '- Create Room'
		);
		$this->load->view("admin/rooms/rooms", $data);
	}

	public function delete_room() {
		$rid = $this->input->get('rid');
		$query = $this->db->get_where('room', array('room_id' => $rid), 1);
		if(isset($rid) && !is_null($rid)):
				$this->db->where('room_id', $rid);
				$this->db->update('room', array('view_status' => 1));
				$msg = 'delete';
			else:
				$msg = 'null';
		endif;

		$this->session->set_flashdata('msg', $msg);
		redirect('room');
	}

	public function fetch_rooms() {
		$this->load->helper('form');
		$this->load->library('form_builder');
		$this->load->model('Rooms_Model');

		// Check if room type id is valid integer
		$room_type_id = self::check_integer((int)$this->uri->segment(2));
		if($room_type_id == "error") {
			redirect('');
		}

		// Check if room type exist
		$check = $this->db->get_where('room_type', array('room_type_id' => $room_type_id, 'view_status' => 5));
		if($check->num_rows() < 1) {
			redirect('');
		}

		$query = $this->db->get_where('room', array('room.room_type_id' => $room_type_id, 'room_count > ' => 0,  'view_status' => 5));
		$result = array($query->result(), $check->result(), $query->num_rows());

		$data = array(
			'active' => 2,
			'rooms'  => $result,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Rooms'
		);
		$this->load->view('interface/pages/rooms', $data);
	}

	public function room_galleries() {
		$room_id = $this->input->get('rid');
		$images = $this->db->get_where('room_images', array('room_id' => $room_id, 'view_status' => 5));
		$this->load->view("interface/append/gallery", array("images" => $images->result()));
	}

	public function check_integer($data = NULL) {
		if(!isset($data) || !is_int($data) || empty($data)) {
			return "error";
		}
		return $data;
	}
}