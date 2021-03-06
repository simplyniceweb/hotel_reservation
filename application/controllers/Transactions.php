<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) {
			show_404();
		}

		$transaction_status = $this->uri->segment(2);
		if ( !$transaction_status ) {
			$transaction_status = 1;
		}

		$data = array(
			'active'       => $transaction_status,
			'transactions' => self::fetch_transactions($transaction_status),
			'title'        => $this->config->item('website_name')
		);
		$this->load->view('admin/payments/transactions', $data);
	}

	public function fetch_transactions($status) {
		$reservation_status = 5;
		if ($status == 4) {
			$reservation_status = 1;
		} else if($status == 5) {
			$reservation_status = 6;
		}

		$select = 't.transaction_id, t.proof, t.notes, t.transaction_status, pt.payment_name, r.reservation_code, r.reservation_id';
		$query = $this->db->select($select)
		->from('transactions as t')
		->join('payment_type as pt', 'pt.payment_id = t.payment_type_id', 'left')
		->join('reservations as r', 'r.reservation_code = t.code', 'left')
		->where('t.view_status', 5)
		->where('pt.view_status', 5)
		->where('r.view_status', $reservation_status)
		->where('t.transaction_status', $status)
		->get();
		return $query;
	}

	public function reservartion_details() {
		$rid = (int) $this->uri->segment(3);
		$query = $this->db->get_where('reservations', array('reservation_id' => $rid)); // , 'view_status' => 5
		if($query->num_rows() < 1) {
			return $this->output->set_output('Something went wrong...');
		}
		
		$this->load->view('admin/payments/append/reservation_details', array('query' => $query->result()));
	}

	public function transactionToggleStatus() {
		$status = (int) $this->uri->segment(3);
		$tid    = (int) $this->uri->segment(4);
		$query = $this->db->get_where('transactions', array('transaction_id' => $tid, 'view_status' => 5), 1);
		$transaction = $query->result();
		if($query->num_rows() < 1) {
			return $this->output->set_output("error");
		}

		$this->db->where('transaction_id', $tid);
		$this->db->update('transactions', array("transaction_status" => $status));

		// If reservation status is cancel
		if ($status == 4):
			$this->db->where('reservation_code', $transaction[0]->code);
			$this->db->update('reservations', array("view_status" => 1));
		// If reservation status is paid
		elseif ($status == 5):
			$this->db->where('reservation_code', $transaction[0]->code);
			$this->db->update('reservations', array("view_status" => 6));
		endif;

		$send_notification = self::email_reservation($transaction[0]->code, $status);
		echo $send_notification . " - ";
		return $this->output->set_output("success");
	}

	public function email_reservation($code = NULL, $status = NULL) {
		if ($status == 1) {
			$stat = "Pending";
		} else if($status == 2) {
			$stat = "Processing";
		} else if($status == 3) {
			$stat = "Partial";
		} else if($status == 4) {
			$stat = "Cancelled";
		} else if($status == 5) {
			$stat = "Paid";
		}
		$query = $this->db->get_where('reservations', array('reservation_code' => $code, 'view_status' => 5))->result();
		if(empty($query[0]->email_address)) {
			return "empty_email";
		}

		$msg = $this->load->view('email/reservation', array( 'result' => $query, 'id' => $query[0]->reservation_id, 'status' => $stat ), TRUE);

		// Send email to the customer
		$this->load->library('email');
		$this->email->set_newline("\r\n");

		$this->email->from('cocogrovelaiya@gmail.com', 'Laiya Coco Grove');
		$this->email->to($query[0]->email_address);
		$this->email->subject('Reservation status');
		$this->email->message($msg);
		$sent = $this->email->send();
		if ($sent) {
			return "sent";
		}
		// $data = array($code, $status, $query[0]->reservation_id, $query[0]->email_address);
		return "failed";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */