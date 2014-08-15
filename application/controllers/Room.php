<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->config->load('custom');
    }

	public function index() {
		$msg = $this->session->flashdata('msg');
		$this->db->select('*');
		$this->db->from('room as r');
		//$this->db->from('room_type as rt');
		//$this->db->join('room as r', 'r.room_type_id = rt.room_type_id');
		//$this->db->and_where('r.room_type_id', 0);
		//$this->db->where('rt.view_status', 5);
		$this->db->where('r.view_status', 5);
		$query = $this->db->get();

		$data = array(
			'active' => 1,
			'rooms'  => $query->result(),
			'msg'    => (isset($msg))? $msg : NULL,
			'title'  => $this->config->item('website_name') . ' - Room'
		);
		$this->load->view("admin/rooms/rooms", $data);
	}

	public function create_room() {
		$query = NULL;
		$rid  = $this->input->get('rid');
		if ($_SERVER['REQUEST_METHOD'] === 'POST'):
				$now = date('Y-m-d');
				$name = $this->input->post('name');
				$desc = $this->input->post('room_description');
				$room_type_id = $this->input->post('room_type_id');
				// $room_number = $this->input->post('room_number');
				$max_adult = $this->input->post('max_adult');
				$max_child = $this->input->post('max_child');
				$room_rate = $this->input->post('room_rate');
				//$room_count = $this->input->post('room_count');

				$data = array(
					'room_type_id'  => $room_type_id,
					'room_name' => $name,
					'room_description' => $desc,
					//'room_number'  => $room_number,
					'max_adult'    => $max_adult,
					'max_child'    => $max_child,
					'room_rate'    => $room_rate,
					//'room_count'   => $room_count,
					'view_status'  => 5,
					'created_at'   => $now,
					'modified_at'  => $now,
				);
				if(isset($rid) && !is_null($rid)):
					$msg = 'update';
					$this->db->where('room_id', $rid);
					$this->db->update('room', $data); 
				else:
					$room_number = $this->db->select('room_number')->from('room')->order_by('room_id', 'desc')->limit(1);
					$room_number = $this->db->get();
					$rn = $room_number->result();
					$data['room_number'] = (int) $rn[0]->room_number+1;

					$msg = 'save';
					$this->db->insert('room', $data);
				endif;
				$this->session->set_flashdata('msg', $msg);
				redirect('room');
			else:
				if(isset($rid) && !is_null($rid)):
					$query = $this->db->get_where('room', array('room_id' => $rid), 1)->result();
				endif;

				$this->load->helper('form');
				$this->load->library('form_builder');
		endif;

		$data = array(
			'active' => 2,
			'room'   => $query,
			'room_types' => $this->db->get_where('room_type', array('view_status' => 5))->result(),
			'title'  => $this->config->item('website_name') . '- Create Room'
		);
		$this->load->view("admin/rooms/rooms", $data);
	}

	public function delete_room() {
		$rid = $this->input->get('rid');
		$query = $this->db->get_where('room', array('room_id' => $rid), 1);
		if(isset($rid) && !is_null($rid)):
				$this->db->where('room_id', $rid);
				$this->db->update('room', array('view_status' => 1));
				$msg = 'delete';
			else:
				$msg = 'null';
		endif;

		$this->session->set_flashdata('msg', $msg);
		redirect('room');
	}

	public function fetch_rooms() {
		$this->load->helper('form');
		$this->load->library('form_builder');
		$this->load->model('Rooms_Model');

		// Check if room type id is valid integer
		$room_type_id = self::check_integer((int)$this->uri->segment(2));
		if($room_type_id == "error") {
			redirect('');
		}

		// Check if room type exist
		$check = $this->db->get_where('room_type', array('room_type_id' => $room_type_id, 'view_status' => 5));
		if($check->num_rows() < 1) {
			redirect('');
		}

		$query = $this->db->get_where('room', array('room.room_type_id' => $room_type_id, 'room_count > ' => 0,  'view_status' => 5));
		$result = array($query->result(), $check->result(), $query->num_rows());

		$data = array(
			'active' => 2,
			'rooms'  => $result,
			'room_type' => $this->db->get_where('room_type', array('view_status' => 5)),
			'title' => $this->config->item('website_name') . ' - Rooms'
		);
		$this->load->view('interface/pages/rooms', $data);
	}

	public function room_galleries() {
		$room_id = $this->input->get('rid');
		$images = $this->db->get_where('room_images', array('room_id' => $room_id, 'view_status' => 5));
		$this->load->view("interface/append/gallery", array("images" => $images->result()));
	}

	public function check_integer($data = NULL) {
		if(!isset($data) || !is_int($data) || empty($data)) {
			return "error";
		}
		return $data;
	}

	public function rand_string( $length ) {
		$i = 0;
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		// Loop until code does not exist
		while ($i < 1) {
			$code = substr(str_shuffle($chars), 0, $length);
			$check_code = $this->db->get_where('reservations', array( 'reservation_code' => $code ));
			if($check_code->num_rows() < 1) {
				$i = 1;
			}
		}

		return $code;
	}

	public function book() {
		$this->session->set_flashdata('title', 'Something went wrong...');
		$room_id = self::check_integer((int) $this->input->get('room_id'));
		if($room_id == 'error') {
			$this->session->set_flashdata('msg', 'invalid_room_id');
			redirect('messages');
		}

		// Global
		$now = new \DateTime("now");
		$room = $this->db->get_where('room', array('room_id' => $room_id, 'view_status' => 5), 1);
		if($room->num_rows() < 1) {
			$this->session->set_flashdata('msg', 'invalid_room_id');
			redirect('messages');
		}
		$room = $room->result();


		// Booking details
		$check_in = $this->input->get('check_in');
		$check_out = $this->input->get('check_out');

		$unix_date = strtotime($check_out) - strtotime($check_in);
		$how_many_days = floor($unix_date/3600/24);
		$per_room_total = $room[0]->room_rate*floor($unix_date/3600/24);

		$ci = new \DateTime($check_in);
		$co = new \DateTime($check_out);
		$in_out  = $ci->diff($co)->format('%r%a');
		$now_in  = $now->diff($ci)->format('%r%a');
		$now_out = $now->diff($co)->format('%r%a');
		// If check in is lower than date today
		// Check out should not be equal to the date today or lower than the date today
		if ( $now_in < -0 || $now_out < 0 ) {
			$this->session->set_flashdata('msg', 'date_error');
			redirect('messages?date_error=1');
		// Lower than check in or higher than check out
		} else if( $in_out < 1 ) {
			$this->session->set_flashdata('msg', 'date_error');
			redirect('messages?date_error=2');
		}

		// Check if max adult and max child exceed
		$adult = (int) $this->input->get('adult');
		$child = (int) $this->input->get('child');
		if($adult > $room[0]->max_adult || $child > $room[0]->max_child) {
			$this->session->set_flashdata('msg', 'max_person_error');
			redirect('messages');
		}

		// Customer information
		$code = self::rand_string(7);
		$title = $this->input->get('title');
		$first_name = $this->input->get('first_name');
		$last_name = $this->input->get('last_name');
		$email_address = $this->input->get('email_address');
		$confirm_email_address = $this->input->get('confirm_email_address');
		$address = $this->input->get('address');
		$city = $this->input->get('city');
		$province = $this->input->get('province');
		$zip_postal = $this->input->get('zip_postal');

		if ($email_address != $confirm_email_address || empty($email_address) || empty($confirm_email_address)) {
			$this->session->set_flashdata('msg', 'invalid_email');
			redirect('messages');
		}

		$customer_data = array(
			'reservation_code' => $code,
			'bill' => $per_room_total,
			'title' => $title,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email_address' => $email_address,
			'address' => $address,
			'city' => $city,
			'province' => $province,
			'zip_postal' => $zip_postal,
			'view_status' => 5,
			'created_at' => $now->format('Y-m-d H:i:s'),
			'modified_at' => $now->format('Y-m-d H:i:s'),
		);
		$this->db->insert('reservations', $customer_data);

		$reservation_id = $this->db->insert_id();

		$reservation_data = array(
			'reservation_id' => $reservation_id,
			'room_id' => $room[0]->room_id,
			'check_in' => $check_in,
			'check_out' => $check_out,
			'adult' => $adult,
			'child' => $child,
			'view_status' => 5,
			'created_at' => $now->format('Y-m-d H:i:s'),
			'modified_at' => $now->format('Y-m-d H:i:s'),
		);
		$this->db->insert('reserved_room', $reservation_data);

		self::email_reservation($reservation_id, $email_address, $code);
	}

	public function email_reservation($reservation_id = NULL, $email = NULL, $code = NULL, $action = NULL) {
		//$to = "simplyniceweb@gmail.com";
		// $status = ( !is_null($action) && $action == 1) ? 4 : 5;
		$status = 5;
		$query = $this->db->get_where('reservations', array('reservation_id' => $reservation_id, 'view_status' => $status))->result();
		$msg = $this->load->view('email/reservation', array( 'result' => $query, 'id' => $reservation_id, 'status' => 'Pending' ), TRUE);

		// Send email to the customer
		$this->load->library('email');
		$this->email->set_newline("\r\n");

		$this->email->from('cocogrovelaiya@gmail.com', 'Laiya Coco Grove');
		$this->email->to($email);
		$this->email->subject('Room reservation');
		$this->email->message($msg);
		$sent = $this->email->send();
		if($sent) {
			$status = 5;
			$msg = "sent_reserved";
		} else {
			$status = 4;
			$msg = "bad_email_reserved";
			$this->session->set_flashdata('code', $code);
		}


		$object = array( 'view_status' => $status, 'modified_at' => date('Y-m-d') );
		$this->db->where('reservation_id', $reservation_id);
		$this->db->update('reservations', $object);

		$this->session->set_flashdata('msg', $msg);
		$this->session->set_flashdata('title', 'Room Reservation');
		redirect('messages');
	}

	public function resend() {
		// View status 4 should be brought back in production
		$code = $this->uri->segment(3);
		$reservation = $this->db->get_where('reservations', array('reservation_code' => $code), 1); // , 'view_status' => 4
		$res = $reservation->result();
		return self::email_reservation($res[0]->reservation_id, $res[0]->email_address, $code, 1);
	}
}