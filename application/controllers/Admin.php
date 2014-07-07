<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$data = array(
			'title' => $this->config->item('website_name') . '- Dashboard'
		);
		$this->load->view("admin/index", $data);
	}
}