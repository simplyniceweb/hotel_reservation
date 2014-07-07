<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roomimage extends CI_Controller {

	public $upload_path;

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
		$this->upload_path = ASSETS."images/rooms/";
    }

	public function index() {
		$this->db->select('rm.room_image_id as image_id, r.room_id as room_id, r.room_name as name, r.room_number as number');
		$this->db->from('room_images as rm');
		$this->db->join('room as r', 'r.room_id = rm.room_id');
		$this->db->join('room_type as rt', 'rt.room_type_id = r.room_type_id');
		$this->db->where('rm.view_status', 5);
		$this->db->where('r.view_status', 5);
		$this->db->where('rt.view_status', 5);
		$this->db->group_by('rm.room_id');
		$query = $this->db->get();
		$msg = $this->session->flashdata('msg');

		$data = array(
			'active' => 1,
			'room_images'  => $query->result(),
			'msg'    => (isset($msg))? $msg : NULL,
			'title'  => $this->config->item('website_name') . ' - Room Image'
		);
		$this->load->view("admin/rooms/room_images", $data);
	}

	public function room_images() {
		$rid = $this->input->get('rid');
		$query = $this->db->get_where('room_images', array('room_id' => $rid, 'view_status' => 5));
		$this->load->view("admin/rooms/append/images", array('result' => $query->result(), 'count' => $query->num_rows()));
	}

	public function create_room_image() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
			$x = 0;
			$now = date('Y-m-d');
			$room_id = $this->input->post('room_id');

			if(isset($_FILES['room_images'])) {
				$images = self::reArrayFiles($_FILES['room_images']);
				foreach($images as $img) {
					$image_name = self::image_upload($img);
					if($image_name != "error") {
						$data = array(
							'file_name'    => $image_name,
							'room_id'      => $room_id,
							'view_status'  => 5,
							'created_at'   => $now,
							'modified_at'  => $now,
						);
						$this->db->insert('room_images', $data);
						$x++;
					}
				}
				$msg = $x.' file(s) successfully uploaded and stored.';
			} else {
				$msg = 'null';
			}
		else:
			$this->load->helper('form');
			$this->load->library('form_builder');
		endif;

		if(isset($msg)) {
			$this->session->set_flashdata('msg', $msg);
			redirect('roomimage');
		}

		$data = array(
			'active' => 2,
			'rooms'  => $this->db->get_where('room', array('view_status' => 5))->result(),
			'title'  => $this->config->item('website_name') . '- Create Room image'
		);
		$this->load->view("admin/rooms/room_images", $data);
	}

	public function image_upload($image_post) {
		$error = NULL;

		if ( ! is_uploaded_file($image_post['tmp_name'])) {
			$error = ( ! isset($image_post['error'])) ? 4 : $image_post['error'];
		}

		if(is_null($error)) {
			$data = self::check_allowed_extension($image_post['name']);
			if(is_array($data)) {
				$encrypted = self::encrypt_filename($data[0], $data[1]);
				return self::do_upload($encrypted, $image_post['tmp_name']);
			} else {
				$error = 8;
			}
		}

		switch($error) {
			case 1:	// UPLOAD_ERR_INI_SIZE
				$msg = 'File exceeds limit.';
				break;
			case 2: // UPLOAD_ERR_FORM_SIZE
				$msg = 'Upload exceeds form size limit.';
				break;
			case 3: // UPLOAD_ERR_PARTIAL
				$msg = 'File partial error.';
				break;
			case 4: // UPLOAD_ERR_NO_FILE
				$msg = 'No selected file.';
				break;
			case 6: // UPLOAD_ERR_NO_TMP_DIR
				$msg = 'No temporary directory';
				break;
			case 7: // UPLOAD_ERR_CANT_WRITE
				$msg = 'Unable to upload the file';
				break;
			case 8: // UPLOAD_ERR_EXTENSION
				$msg = 'Invalid extension, only .jpg, .jpeg and .png file.';
				break;
			default: // UPLOAD_ERR_NO_FILE
				$msg = 'No selected file';
				break;
		}

		$this->session->set_flashdata('msg', $msg);
		redirect('roomimage');
	}

	public function do_upload($filename, $tmp) {
		if ( ! @move_uploaded_file($tmp, $this->upload_path.$filename)) {
			return "error";
		} else {
			return $filename;
		}
	}

	public function encrypt_filename($ext) {
		$filename = md5(uniqid(mt_rand()));
		if ( ! file_exists($this->upload_path.$filename.$ext)) {
			return $filename.$ext;
		}

		for ($i = 1; $i < 100; $i++) {
			if ( ! file_exists($this->upload_path.$filename.$i.$ext)) {
				$new_filename = $filename.$i.$ext;
				break;
			}
		}

		return $new_filename;
	}

	public function check_allowed_extension($image_post) {
		$file_name = NULL;
		$allowed_types = array("jpg","jpeg","png");

		$ext = explode('.', $image_post);
		$ext = end($ext);

		foreach($allowed_types as $x) {
			if($x == $ext) {
				$file_name = 1;
				break;
			}
		}

		if(!is_null($file_name)) {
			return array(basename($image_post), ".".$ext);
		}

		return"error";
	}

	// I got this snipper from:
	// http://www.php.net/manual/en/features.file-upload.multiple.php#53240
	// Credits goes to the owner
	public function reArrayFiles(&$file_post) {
	
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
	
		for ($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
	
		return $file_ary;
	}

	public function delete_room_image() {
		$x = 0;
		$rid = $this->input->get('rid');
		$query = $this->db->get_where('room_images', array('room_id' => $rid, 'view_status' => 5));
		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				if(@unlink($this->upload_path.$row->file_name)) {
					$x++;
				}
				$this->db->where('room_image_id', $row->room_image_id);
				$this->db->update('room_images', array('view_status' => 1));
			}
			$msg = $x.' image(s) has been deleted.';
		} else {
			$msg = 'null';
		}

		$this->session->set_flashdata('msg', $msg);
		redirect('roomimage');
	}
}