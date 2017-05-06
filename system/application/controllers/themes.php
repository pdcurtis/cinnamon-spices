<?php

/**
 * Class Themes
 *
 * @property CI_Loader           $load
 * @property CI_DB_active_record $db
 * @property DX_Auth             $dx_auth
 * @property CI_Session          $session
 * @property CI_Pagination       $pagination
 * @property Comments            $comments
 * @property CI_URI              $uri
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
        $this->load->library('pagination');

        $config['base_url'] = '/themes/popular';
        $config['total_rows'] = $this->db->get('newthemes')->num_rows();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);
        $this->db->order_by('score DESC, name ASC');
        $data['themes'] = $this->db->get('newthemes', $config['per_page'], $this->uri->segment(3));

		$data['mode'] = 'popular';


		$this->load->view('header');
		$this->load->view('themes', $data);
		$this->load->view('footer');
	}

	function latest()
	{
        $this->load->library('pagination');

        $config['base_url'] = '/themes/latest';
        $config['total_rows'] = $this->db->get('newthemes')->num_rows();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);
        $this->db->order_by('last_edited DESC, name ASC');
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

            $data['liked'] = false;
            if ($this->session->userdata('oauth')) {
                $this->db->select('count(newthemes_ratings.id) AS liked');
                $this->db->where('newthemes_ratings.uuid', $data['uuid']);
                $this->db->where('newthemes_ratings.user_link', $this->session->userdata('link'));
                $ratings_res = $this->db->get('newthemes_ratings');
                if($ratings_res->num_rows() == 1) {
                    $ratings_data = $ratings_res->row_array();
                    if($ratings_data['liked'] > 0) {
                        $data['liked'] = true;
                    }
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

    function _update_score($uuid)
    {
        // Calculate the score
        $this->db->where('uuid', $uuid);
        $this->db->where('FROM_UNIXTIME(timestamp) >= DATE_SUB(NOW(), INTERVAL 1 MONTH)');
        $score = $this->db->get('newthemes_ratings')->num_rows();
        // Update the score field
        // $id = intval($id);
        $this->db->where('uuid', $uuid);
        $this->db->set('score', $score);
        $this->db->update('newthemes');
    }

    function rate($uuid) {
        $this->db->where('uuid', $uuid);
        $records = $this->db->get('newthemes');
        if ($records->num_rows() > 0) {
            $data = $records->row_array();
            if ($this->session->userdata('oauth')) {
                $liked = false;
                if ($this->session->userdata('oauth')) {
                    $this->db->select('count(newthemes_ratings.id) AS liked');
                    $this->db->where('newthemes_ratings.uuid', $data['uuid']);
                    $this->db->where('newthemes_ratings.user_link', $this->session->userdata('link'));
                    $ratings_res = $this->db->get('newthemes_ratings');
                    if($ratings_res->num_rows() == 1) {
                        $ratings_data = $ratings_res->row_array();
                        if($ratings_data['liked'] > 0) {
                            $liked = true;
                        }
                    }
                }
                if(!$liked) {
                    $this->db->set('uuid', $data['uuid']);
                    $this->db->set('user_full_name',$this->session->userdata('name'));
                    $this->db->set('user_link',$this->session->userdata('link'));
                    $this->db->set('user_avatar',$this->session->userdata('avatar'));
                    $this->db->set('timestamp', now());
                    $this->db->insert('newthemes_ratings');
                    $this->_update_score($uuid);
                }
            }
        }
		redirect("/themes/view/$uuid", "location");
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
