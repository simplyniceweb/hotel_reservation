<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$data = array(
			'active' => 1,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name')
		);
		$this->load->view('interface/pages/index', $data);
	}

	public function rooms() {
		$data = array(
			'active' => 2,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Rooms'
		);
		$this->load->view('interface/pages/rooms', $data);
	}

	public function room_payment() {
		$data = array(
			'active' => 3,
			'drop_active' => 1,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Room Payment'
		);
		$this->load->view('interface/pages/room_payment', $data);
	}

	public function reservation_status() {
		$data = array(
			'active' => 3,
			'drop_active' => 2,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Reservation Status'
		);
		$this->load->view('interface/pages/reservation_status', $data);
	}

	public function house_rules() {
		$data = array(
			'active' => 4,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - House rules'
		);
		$this->load->view('interface/pages/house-rules', $data);
	}

	public function map() {
		$data = array(
			'active' => 5,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Map'
		);
		$this->load->view('interface/pages/map', $data);
	}

	public function contact() {
		$data = array(
			'active' => 6,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Contact'
		);
		$this->load->view('interface/pages/contact', $data);
	}

	public function messages() {
		$title = $this->session->flashdata('title');
		$msg = $this->session->flashdata('msg');
		if(!isset($title) || empty($title) || !isset($msg) || empty($msg)) {
			redirect('');
		}

		$data = array(
			'active' => 0,
			'h1' => $title,
			'msg' => $msg,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name')
		);
		$this->load->view('interface/pages/messages', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */