<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservations extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$reservation_status = $this->uri->segment(2);
		if ( !$reservation_status ) {
			$reservation_status = 5;
		}

		if ($reservation_status == 5) {
			$active = 1;
		} else if ($reservation_status == 1) {
			$active = 2;
		} else if ($reservation_status == 6) {
			$active = 3;
		}

		$msg = $this->session->flashdata('msg');
		$data = array(
			'active' => $active,
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

	public function check_date() {
		$room_id = $this->input->post_get('room_id');
		$check_in = $this->input->post_get('check_in');
		$check_out = $this->input->post_get('check_out');

		$arg = "SELECT * FROM `reserved_room` WHERE `check_in` BETWEEN '".$check_in."' AND '".$check_out."' OR `check_out` BETWEEN '".$check_in."' AND '".$check_out."' AND `room_id` = ".$room_id." AND `view_status` = 5";
		$query = $this->db->query($arg);

		if ( is_array($query->result()) && count($query->result()) > 0 ) {
			return $this->load->view("interface/append/invalid_date", ["object" => $query->result()]);
		}
		return $this->output->set_output(1);
	}

	public function check_reservations() {
		$code = $this->input->post_get('code');
		$query = $this->db->get_where('reservations', array('reservation_code' => $code));
		if ($query->num_rows() < 1) {
			return $this->output->set_output(1);
		}

		$this->load->view("interface/append/reservations", ['object' => $query->result()]);
	}
}