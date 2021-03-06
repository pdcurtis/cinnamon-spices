<?php
class Themes extends Controller{

	function Themes() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('email');

		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}

	function index() {
		$this->popular();
	}

	function popular() {
		$this->db->order_by('score DESC, name ASC');
		$data['mode'] = 'popular';
		$data['themes'] = $this->db->get('newthemes');

		$this->load->view('header');
		$this->load->view('themes', $data);
		$this->load->view('footer');
	}

	function latest()
	{
		$this->db->order_by('last_edited DESC, name ASC');
		$data['mode'] = 'latest';
		$data['themes'] = $this->db->get('newthemes');

		$this->load->view('header', $data);
		$this->load->view('themes', $data);
		$this->load->view('footer', $data);
	}

	function view($id) {
		$this->db->where('newthemes.uuid', $id);
		$records = $this->db->get('newthemes');
		if ($records->num_rows() > 0) {
			$data = $records->row_array();
			$data['id'] = $data['uuid'];

			$this->db->select('themes_comments.*, users.username');
			$this->db->where('themes_comments.theme', $id);
			$this->db->join('users', 'users.id = themes_comments.user');
			$this->db->order_by('timestamp DESC');
			$data['comments'] = $this->db->get('themes_comments');

			$data['rating'] = 0;
			if ($this->dx_auth->is_logged_in()) {
				$this->db->where('user', $this->dx_auth->get_user_id());
				$this->db->where('theme', $id);
				$records = $this->db->get('themes_ratings');
				if ($records->num_rows > 0) {
					$data['rating'] = $records->row()->rating;
				}
			}

			$this->load->view('header_short');
			$this->load->view('theme', $data);
			$this->load->view('footer');
		}
		else {
			$data["error"] = "Not found";
			$data["details"] = "This theme does not exist.";
			$this->load->view("header_short");
			$this->load->view('error', $data);
			$this->load->view("footer");
		}
	}

	function _json() {
		// $this->db->select('themes.*, users.id as user_id, users.username, users.signature, users.biography');
		// $this->db->join('users', 'users.id = themes.user');
		// $spices = $this->db->get('newthemes');
		// foreach ($spices->result() as $spice) {
  //           $json[$spice->id] = array(
	 //            'spices-id' => $spice->id,
  //       	    'name' => $spice->name,
  //               'description' => $spice->description,
	 //            'score' => $spice->score,
  //       	    'created' => $spice->created,
  //               'last_edited' => $spice->last_edited,
	 //            'file' => $spice->file,
  //               'screenshot' => $spice->screenshot,
	 //            'author_id' => $spice->user,
  //       	    'author_user' => $spice->username
  //           );
  //   	}
		// $fp = fopen('/var/www/cinnamon-spices.linuxmint.com/json/themes.json', 'w');
		// fwrite($fp, json_encode($json));
		// fclose($fp);
	}

	function rate($id, $rating) {
		$id = intval($id);
		$rating = intval($rating);
		if ($this->dx_auth->is_logged_in() && $rating >= 1 && $rating <= 5) {
			$this->db->where('user', $this->dx_auth->get_user_id());
			$this->db->where('theme', $id);
			$this->db->delete('themes_ratings');
			$this->db->set('user', $this->dx_auth->get_user_id());
			$this->db->set('theme', $id);
			$this->db->set('rating', $rating);
			$this->db->insert('themes_ratings');
			$this->db->query("UPDATE newthemes SET score = (SELECT SUM(rating-3) FROM themes_ratings WHERE theme = $id) WHERE id = $id");
			$this->_json();
		}
		redirect("/themes/view/$id", "location");
	}

	function comment($id) {
		$id = intval($id);
		if ($this->dx_auth->is_logged_in()) {
			$this->db->set('user', $this->dx_auth->get_user_id());
			$this->db->set('theme', $id);
			$this->db->set('timestamp', now());
			$this->db->set('body', $_POST['body']);
			$this->db->insert('themes_comments');
		}
		redirect("/themes/view/$id", "location");
	}

}
?>
