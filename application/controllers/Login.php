<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$msg = $this->input->post_get('login');
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('admin');

		$this->load->helper('form');
		$data = [
			'title' => 'login',
			'message' => (isset($msg)) ? $msg : NULL
		];

		$this->load->view("login", $data);
	}

	public function authenticate() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('admin');
		
		$data = array(
			'email'    => $this->input->post('email'),
			'password' => sha1($this->input->post('password'))
		);
		
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$this->db->limit(1);
		$login = $this->db->get();

		if($login->num_rows() == 0) redirect('login/?login=false');
		$res = $login->result();

		$sess_array = array(
			'logged'   => TRUE,
			'user_id'  => $res[0]->user_id,
			'email'    => $res[0]->email,
			'password' => $res[0]->password,
		);

		$this->session->set_userdata('logged', $sess_array);
		redirect('admin');
	}
}