<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contentmanagement extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function house_rules() {
		$msg = $this->session->flashdata('msg');
		$house_rules = $this->input->post('house-rules');
		$rules = $this->db->get_where('house_rules', ['view_status' => 5]);
		if ( isset($house_rules) ) {
			$now = date("Y-m-d");
			$content = $this->input->post('editor1');
			if ($rules->num_rows() > 0) {
				$rules = $rules->result();
				$id = $rules[0]->id;

				$this->db->where('id', $id);
				$this->db->update('house_rules', ["content" => $content, "modified_at" => $now]); 
				$msg = "update";
			} else {
				$content_data = [
					"content" => $content,
					"view_status" => 5,
					"created_at" => $now,
					"modified_at" => $now,
				];
				$this->db->insert('house_rules', $content_data);
				$msg = "save";
			}
			$this->session->set_flashdata('msg', $msg);
			redirect('contentmanagement/house_rules');
		}

		$data = [
			'ckeditor' => 1,
			'rules'  => (isset($rules) && $rules->num_rows() > 0) ? $rules->result() : NULL,
			'msg'    => (isset($msg))? $msg : NULL,
			'title' => $this->config->item('website_name')
		];

		$this->load->helper('form');
		$this->load->view('admin/content-management/cms-house-rules', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */