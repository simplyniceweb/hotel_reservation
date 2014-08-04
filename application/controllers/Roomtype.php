<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roomtype extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$msg = $this->session->flashdata('msg');
		$query = $this->db->get_where('room_type', array('view_status' => 5));
		$data = array(
			'active' => 1,
			'room_types' => $query->result(),
			'msg'    => (isset($msg))? $msg : NULL,
			'title'  => $this->config->item('website_name') . ' - Room Types'
		);
		$this->load->view("admin/rooms/room_types", $data);
	}

	public function create_room_type() {
		$query = NULL;
		$rtid  = $this->input->get('rtid');
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
				$now = date('Y-m-d');
				$name = $this->input->post('name');
				$descriptions = $this->input->post('descriptions');
				// $availability = $this->input->post('availability');
				$data = array(
					'name' => $name,
					'description'  => $descriptions,
					// 'availability' => $availability,
					'view_status'  => 5,
					'created_at'   => $now,
					'modified_at'  => $now,
				);
				if(isset($rtid) && !is_null($rtid)):
					$msg = 'update';
					$this->db->where('room_type_id', $rtid);
					$this->db->update('room_type', $data); 
				else:
					$msg = 'save';
					$this->db->insert('room_type', $data);
				endif;
				$this->session->set_flashdata('msg', $msg);
				redirect('roomtype');
			else:
				if(isset($rtid) && !is_null($rtid)):
					$query = $this->db->get_where('room_type', array('room_type_id' => $rtid), 1)->result();
				endif;

				$this->load->helper('form');
				$this->load->library('form_builder');
		endif;

		$data = array(
			'active'    => 2,
			'room_type' => $query,
			'title'     => $this->config->item('website_name') . '- Create Room Types'
		);
		$this->load->view("admin/rooms/room_types", $data);
	}

	public function delete_room_type() {
		$rtid = $this->input->get('rtid');
		$query = $this->db->get_where('room_type', array('room_type_id' => $rtid), 1);
		if(isset($rtid) && !is_null($rtid)):
				$this->db->where('room_type_id', $rtid);
				$this->db->update('room_type', array('view_status' => 1));
				$msg = 'delete';
			else:
				$msg = 'null';
		endif;

		$this->session->set_flashdata('msg', $msg);
		redirect('roomtype');
	}
}