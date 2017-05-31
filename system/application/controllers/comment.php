<?php
/**
 * Class Comment
 *
 * @property CI_Loader           $load
 * @property CI_DB_active_record $db
 * @property CI_Session          $session
 * @property CI_URI              $uri
 */
class Comment extends Controller
{

	function __construct()
    {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('email');
	}

	function submit($type, $id)
    {
        if ($type !== 'themes')
        {
            $id = intval($id);
            $db_id = 'new' . $type . '.id';
        }
        else {
            $db_id = 'new' . $type . '.uuid';
        }

        $db_type = 'new' . $type;
        $db_comment = 'new' . $type . '_comments';

        if ($this->session->userdata('oauth') && isset($_POST['body']) && !empty($_POST['body']))
        {
            $this->db->where($db_id, $id);
            $records = $this->db->get($db_type);

            if ($records->num_rows() > 0)
            {
                $data = $records->row_array();
                $this->db->set('uuid',$data['uuid']);
                $this->db->set('user_full_name',$this->session->userdata('name'));
                $this->db->set('user_link',$this->session->userdata('link'));
                $this->db->set('user_avatar',$this->session->userdata('avatar'));
                $this->db->set('timestamp', now());
                $this->db->set('message', $_POST['body']);
                $this->db->set('parent_id', $_POST['parent_id']);
                $this->db->insert($db_comment);
            }
        }
        redirect("/$type/view/$id", "location");
	}
}
