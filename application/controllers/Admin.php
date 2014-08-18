<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) {
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

	public function contact_form() {
		$this->load->library('email');
		$this->email->set_newline("\r\n");

		$contact_data = array(
			'full_name' => $this->input->post('full_name'),
			'email_address' => $this->input->post('email_address'),
			'telephone_number' => $this->input->post('telephone_number'),
			'message' => $this->input->post('message'),
		);

		$this->email->from($contact_data['email_address'], $contact_data['full_name']);
		$this->email->to('cocogrovelaiya@gmail.com');
		$this->email->subject('Guest contact');
		$this->email->message($contact_data['message']);
		$sent = $this->email->send();
		if($sent) {
			$msg = "sent_contact";
		} else {
			$msg = "bad_email_contact";
		}
		$this->session->set_flashdata('msg', $msg);
		$this->session->set_flashdata('title', 'Contact');
		redirect('messages');
	}
}