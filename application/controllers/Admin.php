<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$access = $this->session->userdata('access');
		if(!$access) {
			show_404();
		}

		$data = array(
			'title' => $this->config->item('website_name') . '- Dashboard'
		);
		$this->load->view("admin/index", $data);
	}

	public function access() {
		$value = $this->input->get_post("hash");
		if($value == "aOw9qluWxj") {
			$access = array( 'access' => true );
			$this->session->set_userdata('access', $access);
			redirect("admin");
		}
		show_404();
	}
}