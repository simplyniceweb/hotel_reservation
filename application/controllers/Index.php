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
		$this->load->helper('form');
		$this->load->library('form_builder');

		$data = array(
			'active' => 3,
			'drop_active' => 1,
			'payment_type' => $query = $this->db->get_where('payment_type', array('view_status' => 5))->result(),
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Payment'
		);
		$this->load->view('interface/pages/room_payment', $data);
	}

	public function reservation_status() {
		$this->load->helper('form');
		$this->load->library('form_builder');

		$data = array(
			'active' => 3,
			'drop_active' => 2,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Reservation Status'
		);
		$this->load->view('interface/pages/reservation_status', $data);
	}

	public function payment_types() {
		$data = array(
			'active' => 3,
			'drop_active' => 3,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'payment_type' => $query = $this->db->get_where('payment_type', array('view_status' => 5))->result(),
			'title' => $this->config->item('website_name') . ' - Payment types'
		);
		$this->load->view('interface/pages/payment_types', $data);
	}

	public function house_rules() {
		$rules = $this->db->get_where('house_rules', array('view_status' => 5));
		$data = array(
			'active' => 4,
			'rules'  => ( $rules->num_rows() > 0 ) ? $rules->result() : NULL,
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
		$this->load->helper('form');
		$this->load->library('form_builder');

		$data = array(
			'active' => 6,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Contact'
		);
		$this->load->view('interface/pages/contact', $data);
	}

	public function messages() {
		$code = $this->session->flashdata('code');
		$title = $this->session->flashdata('title');
		$msg = $this->session->flashdata('msg');
		if(!isset($title) || empty($title) || !isset($msg) || empty($msg)) {
			redirect('');
		}

		$data = array(
			'active' => 0,
			'h1' => $title,
			'msg' => $msg,
			'code' => (isset($code) && !empty($code)) ? $code : NULL,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name')
		);
		$this->load->view('interface/pages/messages', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */