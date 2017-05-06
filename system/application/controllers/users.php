<?php

//class Users extends Controller
//{
//
//    function Users()
//    {
//        parent::Controller();
//        $this->load->helper('url');
//        $this->load->helper('form');
//        $this->load->helper('date');
//        $this->load->library('email');
//    }
//
//    function index()
//    {
//        $this->view(0);
//    }
//
//    function view($user_id = 0)
//    {
//        $user_id = intval($user_id);
//        if ($user_id == 0) {
//            if ($this->dx_auth->is_logged_in()) {
//                $user_id = $this->dx_auth->get_user_id();
//            }
//        }
//
//        $this->db->where("id", $user_id);
//        $records = $this->db->get("users");
//        if ($records->num_rows() > 0) {
//
//            $data = $this->myself->get_details($user_id);
//
//            $data["page_title"] = $data["user_name"];
//            $this->load->view('header_short', $data);
//            $this->load->view('home/profile', $data);
//            $this->load->view('footer');
//        } else {
//            $data["error"] = "Not found";
//            $data["details"] = "This user does not exist.";
//            $this->load->view("header_short");
//            $this->load->view('error', $data);
//            $this->load->view("footer");
//        }
//    }
//
//    function change_details()
//    {
//        $this->security->restrict_to_registered_users();
//
//        $user_id = $this->dx_auth->get_user_id();
//        $data = $this->myself->get_details($user_id);
//
//        $this->db->order_by("name");
//        $data["countries"] = $this->db->get('countries');
//
//        $this->db->order_by("name");
//        $data["distributions"] = $this->db->get('distributions');
//
//        $query = $this->db->query("SELECT country, distribution FROM users WHERE id = $user_id");
//        $row = $query->row_array();
//        if ($query->num_rows() > 0) {
//            $data["country_id"] = $row["country"];
//            $data["distribution_id"] = $row["distribution"];
//
//            $this->load->view('header_short');
//            $this->load->view('home/change_details', $data);
//            $this->load->view('footer');
//        }
//    }
//
//    function save_details()
//    {
//        $this->security->restrict_to_registered_users();
//
//        $user_id = $this->dx_auth->get_user_id();
//
//        $data = array(
//            'biography' => $_POST["biography"],
//            'signature' => $_POST["signature"],
//            'country' => intval($_POST["country"]),
//            'distribution' => intval($_POST["distribution"])
//        );
//
//        if (isset($_FILES['avatar']) && isset($_FILES['avatar']['error']) && $_FILES['avatar']['error']==0) {
//
//            echo "<pre>"; print_r($_FILES); die;
//
//            $config['upload_path'] = FCPATH . 'uploads/avatars/';
//            $config['file_name'] = "$user_id";
//            $config['overwrite'] = TRUE;
//            $config['allowed_types'] = 'jpg';
//            $config['is_image'] = TRUE;
//            $config['max_size'] = '100';
//            $config['max_width'] = '100';
//            $config['max_height'] = '100';
//
//            $this->load->library('upload', $config);
//
//            if (!$this->upload->do_upload("avatar")) {
//                $data["error"] = $this->upload->display_errors();
//                $this->load->view('header');
//                $this->load->view('home/upload_failure', $data);
//                $this->load->view('footer');
//                return;
//            }
//        }
//
//        $this->db->where('id', $user_id);
//        $this->db->update('users', $data);
//
//        redirect('/users/view/0', 'location');
//    }
//
//}
