<?php
/**
 * Class Applets
 *
 * @property CI_Loader           $load
 * @property CI_DB_active_record $db
 * @property DX_Auth             $dx_auth
 * @property CI_Session          $session
 */
class Applets extends Controller{

	function Applets() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('email');
	}

	function index() {
		$this->popular();
	}

	function latest() {
		$this->db->order_by('last_edited DESC, name ASC');

        $this->load->library('pagination');

        $config['base_url'] = '/applets/latest';
        $config['total_rows'] = $this->db->get('newapplets')->num_rows();
        $config['per_page'] = 30;
        $config['num_links'] = 10;

        $this->pagination->initialize($config);

        $data['items'] = $this->db->get('newapplets', $config['per_page'], $this->uri->segment(3));
        $data['mode'] = 'latest';

		$this->load->view('header');
		$this->load->view('applets', $data);
		$this->load->view('footer');
	}

	function popular() {
		$this->db->order_by('score DESC, name ASC');

        $this->load->library('pagination');

        $config['base_url'] = '/applets/popular';
        $config['total_rows'] = $this->db->get('newapplets')->num_rows();
        $config['per_page'] = 30;
        $config['num_links'] = 10;

        $this->pagination->initialize($config);

        $data['items'] = $this->db->get('newapplets', $config['per_page'], $this->uri->segment(3));
        $data['mode'] = 'popular';

		$this->load->view('header');
		$this->load->view('applets', $data);
		$this->load->view('footer');
	}

	function view($id) {
		$id = intval($id);
		$this->db->where('id', $id);
		$records = $this->db->get('newapplets');
		if ($records->num_rows() > 0) {
			$data = $records->row_array();

            $this->db->select('newapplets_comments.*');
            $this->db->where('newapplets_comments.uuid', $data['uuid']);
            $this->db->order_by('timestamp DESC');
            $data['comments'] = $this->db->get('newapplets_comments');

            $data['rating'] = 0;
//            if ($this->dx_auth->is_logged_in()) {
//                $this->db->where('user', $this->dx_auth->get_user_id());
//                $this->db->where('theme', $id);
//                $records = $this->db->get('themes_ratings');
//                if ($records->num_rows > 0) {
//                    $data['rating'] = $records->row()->rating;
//                }
//            }

			$this->load->view('header_short');
			$this->load->view('applet', $data);
			$this->load->view('footer');
		}
		else {
			$data["error"] = "Not found";
			$data["details"] = "This applet does not exist.";
			$this->load->view("header_short");
			$this->load->view('error', $data);
			$this->load->view("footer");
		}
	}

	function _json() {
		// $this->db->select('applets.*, users.id as user_id, users.username, users.signature, users.biography');
		// $this->db->join('users', 'users.id = applets.user');
		// $spices = $this->db->get('newapplets');
		// foreach ($spices->result() as $spice) {
  //           $json[$spice->uuid] = array(
  //               'spices-id' => $spice->id,
  //               'uuid' => $spice->uuid,
  //               'name' => $spice->name,
  //               'description' => $spice->description,
  //               'score' => $spice->score,
  //               'created' => $spice->created,
  //               'last_edited' => $spice->last_edited,
  //               'file' => $spice->file,
  //               'icon' => $spice->icon,
  //               'screenshot' => $spice->screenshot,
  //               'author_id' => $spice->user,
  //               'author_user' => $spice->username
  //           );
  //       }
		// $fp = fopen('/var/www/cinnamon-spices.linuxmint.com/json/applets.json', 'w');
		// fwrite($fp, json_encode($json));
		// fclose($fp);
	}

	function rate($id, $rating) {
		$id = intval($id);
		$rating = intval($rating);
		if ($this->dx_auth->is_logged_in() && $rating >= 1 && $rating <= 5) {
			$this->db->where('user', $this->dx_auth->get_user_id());
			$this->db->where('applet', $id);
			$this->db->delete('applets_ratings');
			$this->db->set('user', $this->dx_auth->get_user_id());
			$this->db->set('applet', $id);
			$this->db->set('rating', $rating);
			$this->db->insert('applets_ratings');
			$this->db->query("UPDATE applets SET score = (SELECT SUM(rating-3) FROM applets_ratings WHERE applet = $id) WHERE id = $id");
			$this->_json();
		}
		redirect("/applets/view/$id", "location");
	}

	function comment($id) {
		$id = intval($id);
        if($this->session->userdata('oauth') && isset($_POST['body']) && !empty($_POST['body'])) {
            $this->db->where('newapplets.id', $id);
            $records = $this->db->get('newapplets');
            if ($records->num_rows() > 0) {
                $data = $records->row_array();
                $this->db->set('uuid',$data['uuid']);
                $this->db->set('user_full_name',$this->session->userdata('name'));
                $this->db->set('user_link',$this->session->userdata('link'));
                $this->db->set('user_avatar',$this->session->userdata('avatar'));
                $this->db->set('timestamp', now());
                $this->db->set('message', $_POST['body']);
                $this->db->insert('newapplets_comments');
            }
        }
//		if ($this->dx_auth->is_logged_in()) {
//			$this->db->set('user', $this->dx_auth->get_user_id());
//			$this->db->set('applet', $id);
//			$this->db->set('timestamp', now());
//			$this->db->set('body', $_POST['body']);
//			$this->db->insert('applets_comments');
//		}
		redirect("/applets/view/$id", "location");
	}

}
