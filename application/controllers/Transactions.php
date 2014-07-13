<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$transaction_status = $this->uri->segment(3);
		if (!$transaction_status) $transaction_status = 1;
		$data = array(
			'active' => $transaction_status,
			'transactions' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name')
		);
		$this->load->view('admin/payments/transactions', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */