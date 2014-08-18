<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paymentype extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) {
			show_404();
		}

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
		$msg = $this->session->flashdata('msg');
		$mysession = $this->session->userdata('logged');
		if(!$mysession) {
			show_404();
		}

		$query = NULL;
		$pid = $this->input->get('pid');
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
			$now = date('Y-m-d');
			$payment_name = trim($this->input->post('payment_name'));
			$recipient_name = trim($this->input->post('recipient_name'));
			$address = trim($this->input->post('recipient_address'));
			$phone = trim($this->input->post('recipient_phone'));

				if (empty($payment_name) || empty($recipient_name) || empty($address) || empty($phone)) {
					$this->session->set_flashdata('msg', 'All fields are required.');
					redirect('paymentype/create_payment_type');
				}

			$data = array(
				'payment_name' => $payment_name,
				'recipient_name' => $recipient_name,
				'recipient_phone' => $phone,
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
			'msg'    => (isset($msg))? $msg : NULL,
			'title'     => $this->config->item('website_name') . '- Create Room Types'
		);
		$this->load->view("admin/payments/paymentype", $data);
	}

	public function delete_room_type() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) {
			show_404();
		}

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

	public function pay() {
		$now = new \DateTime("now");
		$notes = $this->input->post('notes');
		$code = $this->input->post('reservation_code');
		$payment_type = $this->input->post('payment_type');

		// Validate code
		$code_valid = $this->db->get_where('reservations', array('reservation_code' => $code, 'view_status' => 5), 1);
		if ( $code_valid->num_rows() < 1 ) {
			$this->session->set_flashdata('title', 'Payment');
			$this->session->set_flashdata('msg', 'code_invalid');
			redirect('messages');
		}

		// Check if 24 hours had passed
		$now = date('Y-m-d H:i:s');
		$reservation_date = $code_valid->result();
		$date_created = strtotime($reservation_date[0]->created_at);
		$timediff = strtotime($now) - $date_created;
		if($timediff > 86400){
			// echo "Expired!";
			$this->db->where('reservation_id', $reservation_date[0]->reservation_id);
			$this->db->update('reservations', ["view_status" => 1]);
			$this->session->set_flashdata('title', 'Payment');
			$this->session->set_flashdata('msg', '24hours_passed');
			redirect('messages');
		}

		$payment_data = array(
			'code'            => $code,
			'payment_type_id' => $payment_type,
			'notes'           => $notes,
			'transaction_status' => 1, // ( 1 = Pending / 2 = Processing / 3 = Partial / 4 = Cancelled / 5 = Paid  )
			'view_status'     => 5,
			'created_at'      => $now, // ->format('Y-m-d')
			'modified_at'     => $now, // ->format('Y-m-d')
		);

		// Optional upload
		$config = array(
			"upload_path" => "assets/images/payment/",
			"allowed_types" => "bmp|jpg|png|jpeg|gif|pdf",
			"encrypt_name" => TRUE,
			"remove_spaces" => TRUE,
			"is_image" => '1'
		);

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( $this->upload->do_upload() ) {
			$upload_data = $this->upload->data();
			$payment_data['proof'] = $upload_data['file_name'];
		} else {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			return false;
		}
		$this->db->insert('transactions', $payment_data);
		$this->session->set_flashdata('title', 'Payment');
		$this->session->set_flashdata('msg', 'success_payment');
		redirect('messages');
	}
}