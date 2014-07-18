<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservations extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$access = $this->session->userdata('access');
		if(!$access) {
			show_404();
		}

		$reservation_status = $this->uri->segment(2);
		if ( !$reservation_status ) {
			$reservation_status = 5;
		}

		$msg = $this->session->flashdata('msg');
		$data = array(
			'active' => 1,
			'msg'    => (isset($msg))? $msg : NULL,
			'title'  => $this->config->item('website_name') . '- Dashboard',
			'reservations' => $query = $this->db->get_where('reservations', array('view_status' => $reservation_status))
		);
		$this->load->view("admin/payments/reservations", $data);
	}

	public function cancel_reservation() {
		$rid = $this->input->post_get('rid');
		$this->db->where('reservation_id', $rid);
		$this->db->update('reservations', array("view_status" => 1));

		$this->session->set_flashdata('msg', 'delete');
		redirect('reservations');
	}
}