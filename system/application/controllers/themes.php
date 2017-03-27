<?php

/**
 * Class Themes
 *
 * @property CI_Loader           $load
 * @property CI_DB_active_record $db
 * @property DX_Auth             $dx_auth
 * @property CI_Session          $session
 */
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

        $this->load->library('pagination');

        $config['base_url'] = '/themes/popular';
        $config['total_rows'] = $this->db->get('newthemes')->num_rows();
        $config['per_page'] = 20;
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $data['themes'] = $this->db->get('newthemes', $config['per_page'], $this->uri->segment(3));

		$data['mode'] = 'popular';


		$this->load->view('header');
		$this->load->view('themes', $data);
		$this->load->view('footer');
	}

	function latest()
	{
		$this->db->order_by('last_edited DESC, name ASC');

        $this->load->library('pagination');

        $config['base_url'] = '/themes/latest';
        $config['total_rows'] = $this->db->get('newthemes')->num_rows();
        $config['per_page'] = 20;
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $data['themes'] = $this->db->get('newthemes', $config['per_page'], $this->uri->segment(3));

		$data['mode'] = 'latest';

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

			$this->db->select('newthemes_comments.*');
			$this->db->where('newthemes_comments.uuid', $id);
			$this->db->order_by('timestamp DESC');
			$data['comments'] = $this->db->get('newthemes_comments');

			$data['rating'] = 0;
//			if ($this->dx_auth->is_logged_in()) {
//				$this->db->where('user', $this->dx_auth->get_user_id());
//				$this->db->where('theme', $id);
//				$records = $this->db->get('themes_ratings');
//				if ($records->num_rows > 0) {
//					$data['rating'] = $records->row()->rating;
//				}
//			}

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
		if($this->session->userdata('oauth') && isset($_POST['body']) && !empty($_POST['body'])) {
            $this->db->where('newthemes.uuid', $id);
            $records = $this->db->get('newthemes');
            if ($records->num_rows() > 0) {
                $data = $records->row_array();
                $this->db->set('uuid',$data['uuid']);
                $this->db->set('user_full_name',$this->session->userdata('name'));
                $this->db->set('user_link',$this->session->userdata('link'));
                $this->db->set('user_avatar',$this->session->userdata('avatar'));
                $this->db->set('timestamp', now());
                $this->db->set('message', $_POST['body']);
                $this->db->insert('newthemes_comments');
            }
		}
        redirect("/themes/view/$id", "location");
	}

//	function _old_comment($id) {
//		$id = intval($id);
//		if ($this->dx_auth->is_logged_in()) {
//			$this->db->set('user', $this->dx_auth->get_user_id());
//			$this->db->set('theme', $id);
//			$this->db->set('timestamp', now());
//			$this->db->set('body', $_POST['body']);
//			$this->db->insert('themes_comments');
//		}
//		redirect("/themes/view/$id", "location");
//	}

}
