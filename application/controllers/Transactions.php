<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$access = $this->session->userdata('access');
		if(!$access) {
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
		$access = $this->session->userdata('access');
		if(!$access) {
			show_404();
		}

		$select = 't.transaction_id, t.proof, t.notes, t.transaction_status, pt.payment_name, r.reservation_code, r.reservation_id';
		$query = $this->db->select($select)
		->from('transactions as t')
		->join('payment_type as pt', 'pt.payment_id = t.payment_type_id', 'left')
		->join('reservations as r', 'r.reservation_code = t.code', 'left')
		->where('t.view_status', 5)
		->where('pt.view_status', 5)
		->where('r.view_status', 5)
		->where('t.transaction_status', $status)
		->get();
		return $query;
	}

	public function reservartion_details() {
		$access = $this->session->userdata('access');
		if(!$access) {
			show_404();
		}

		$rid = (int) $this->uri->segment(3);
		$query = $this->db->get_where('reservations', array('reservation_id' => $rid, 'view_status' => 5));
		if($query->num_rows() < 1) {
			return $this->output->set_output('Something went wrong...');
		}
		
		$this->load->view('admin/payments/append/reservation_details', array('query' => $query->result()));
	}

	public function transactionToggleStatus() {
		$access = $this->session->userdata('access');
		if(!$access) {
			show_404();
		}

		$status = (int) $this->uri->segment(3);
		$tid    = (int) $this->uri->segment(4);
		$query = $this->db->get_where('transactions', array('transaction_id' => $tid, 'view_status' => 5));
		if($query->num_rows() < 1) {
			return $this->output->set_output("error");
		}

		$this->db->where('transaction_id', $tid);
		$this->db->update('transactions', array("transaction_status" => $status));
		return $this->output->set_output("success");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */