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
class Themes extends Controller
{
    var $data;

	function __construct()
    {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('email');

        $this->data = array(
            'type' => 'themes'
        );
	}

	function index()
    {
		$this->popular();
	}

	function popular()
    {
        $data = $this->data;
        $this->load->library('pagination');

        $config['base_url'] = '/themes/popular';
        $config['total_rows'] = $this->db->get('newthemes')->num_rows();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);
        $this->db->order_by('score DESC, name ASC');
        $data['items'] = $this->db->get('newthemes', $config['per_page'], $this->uri->segment(3));
		$data['mode'] = 'popular';

		$this->load->view('header', $data);
		$this->load->view('spice_list', $data);
		$this->load->view('footer');
	}

	function latest()
    {
        $data = $this->data;
        $this->load->library('pagination');

        $config['base_url'] = '/themes/latest';
        $config['total_rows'] = $this->db->get('newthemes')->num_rows();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);
        $this->db->order_by('last_edited DESC, name ASC');

        $data['items'] = $this->db->get('newthemes', $config['per_page'], $this->uri->segment(3));
		$data['mode'] = 'latest';

		$this->load->view('header', $data);
		$this->load->view('spice_list', $data);
		$this->load->view('footer', $data);
	}

	function view($id)
    {
        $this->db->where('newthemes.uuid', $id);
        $records = $this->db->get('newthemes');

        $this->load->library('comments');

        $auth = false;

		if ($records->num_rows() > 0)
        {
            $data = array_merge($this->data, $records->row_array());

            $data['liked'] = false;

            if ($this->session->userdata('oauth'))
            {
                $auth = true;

                $this->db->select('count(newthemes_ratings.id) AS liked');
                $this->db->where('newthemes_ratings.uuid', $data['uuid']);
                $this->db->where('newthemes_ratings.user_link', $this->session->userdata('link'));
                $ratings_res = $this->db->get('newthemes_ratings');
                if($ratings_res->num_rows() == 1)
                {
                    $ratings_data = $ratings_res->row_array();
                    if($ratings_data['liked'] > 0)
                    {
                        $data['liked'] = true;
                    }
                }
            }

            $this->db->select('newthemes_comments.*');
			$this->db->where('newthemes_comments.uuid', $id);
			$this->db->order_by('timestamp DESC');
            $comments = $this->db->get('newthemes_comments');

            $count = $comments->num_rows;
            $comments = $comments->result_object();

            $data['count'] = $count;
            $data['comments'] = $this->comments->arrange($comments, $auth);
            $data['id'] = $data['uuid'];

			$this->load->view('header_short');
			$this->load->view('spice', $data);
			$this->load->view('footer');
		}
		else {
			$data["error"] = "Not found";
			$data["details"] = "This theme does not exist.";
			$this->load->view('header_short');
			$this->load->view('error', $data);
			$this->load->view("footer");
		}
	}

    function search($q='') {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $q = $_POST['q'];
        }
        $dbname = 'newthemes';
        $itemtype = $this->data['type'];
        $this->db->select('*');
        $this->db->like('name',$q);
        $this->db->or_like('description',$q);
        $this->db->or_like('author',$q);
        $server_path = realpath(BASEPATH.'/../');
        $res = $this->db->get($dbname);
        $items = [];
        foreach ($res->result() as $item) {
            $uuid = $item->uuid;
            if (file_exists("$server_path/git/$itemtype/$uuid/icon.png")) {
                $item->icon = "/git/$itemtype/$uuid/icon.png";
            }
            $items[] = $item;
        }
        header('Content-Type: application/json');
        echo json_encode($items);
    }

    function _json() {
		// $this->db->select('themes.*, users.id as user_id, users.username, users.signature, users.biography');
		// $this->db->join('users', 'users.id = themes.user');
		// $spices = $this->db->get('newthemes');
		// foreach ($spices->result() as $spice) {
    //     $json[$spice->id] = array(
    //         'spices-id' => $spice->id,
    // 	       'name' => $spice->name,
    //         'description' => $spice->description,
    //         'score' => $spice->score,
    // 	       'created' => $spice->created,
    //         'last_edited' => $spice->last_edited,
    //         'file' => $spice->file,
    //         'screenshot' => $spice->screenshot,
    //         'author_id' => $spice->user,
    // 	       'author_user' => $spice->username
    //     );
    // }
		// $fp = fopen('/var/www/cinnamon-spices.linuxmint.com/json/themes.json', 'w');
		// fwrite($fp, json_encode($json));
		// fclose($fp);
	}

    function _update_score($uuid)
    {
        // Calculate the score
        $this->db->where('uuid', $uuid);
        $this->db->where('FROM_UNIXTIME(timestamp) >= DATE_SUB(NOW(), INTERVAL 1 YEAR)');
        $score = $this->db->get('newthemes_ratings')->num_rows();
        // Update the score field
        // $id = intval($id);
        $this->db->where('uuid', $uuid);
        $this->db->set('score', $score);
        $this->db->update('newthemes');
    }

    function rate($uuid)
    {
        $this->db->where('uuid', $uuid);
        $records = $this->db->get('newthemes');
        if ($records->num_rows() > 0)
        {
            $data = $records->row_array();
            if ($this->session->userdata('oauth'))
            {
                $liked = false;
                if ($this->session->userdata('oauth'))
                {
                    $this->db->select('count(newthemes_ratings.id) AS liked');
                    $this->db->where('newthemes_ratings.uuid', $data['uuid']);
                    $this->db->where('newthemes_ratings.user_link', $this->session->userdata('link'));
                    $ratings_res = $this->db->get('newthemes_ratings');
                    if($ratings_res->num_rows() == 1)
                    {
                        $ratings_data = $ratings_res->row_array();
                        if($ratings_data['liked'] > 0)
                        {
                            $liked = true;
                        }
                    }
                }
                if(!$liked)
                {
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
}
