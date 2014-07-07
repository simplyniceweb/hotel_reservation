<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paymentype extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$msg = $this->session->flashdata('msg');
		$query = $this->db->get_where('payment_type', array('view_status' => 5))->result();
		$data = array(
			'active' => 1,
			'query'  => $query,
			'msg'    => (isset($msg))? $msg : NULL,
			'title'  => $this->config->item('website_name') . ' - Payment Types'
		);
		$this->load->view("admin/payments/paymentype", $data);
	}

	public function create_payment_type() {
		$query = NULL;
		$pid = $this->input->get('pid');
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
			$now = date('Y-m-d');
			$payment_name = $this->input->post('payment_name');
			$recipient_name = $this->input->post('recipient_name');
			$address = $this->input->post('recipient_address');
			$data = array(
				'payment_name' => $payment_name,
				'recipient_name' => $recipient_name,
				'recipient_address' => $address
			);
			if(isset($pid) && is_numeric($pid)) {
				$this->db->where('payment_id', $pid);
				$this->db->update('payment_type', $data);
				$msg = 'update';
			} else {
				$data['view_status'] = 5;
				$data['created_at'] = $now;
				$data['modified_at'] = $now;
				$this->db->insert('payment_type', $data);
				$msg = 'save';
			}

			$this->session->set_flashdata('msg', $msg);
			redirect('paymentype');
		else:
			if(isset($pid) && is_numeric($pid)) {
				$query = $this->db->get_where('payment_type', array('payment_id', $pid))->result();
			}
			$this->load->helper('form');
			$this->load->library('form_builder');
		endif;
		$data = array(
			'active'    => 2,
			'payment_type' => $query,
			'title'     => $this->config->item('website_name') . '- Create Room Types'
		);
		$this->load->view("admin/payments/paymentype", $data);
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