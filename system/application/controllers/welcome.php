<?php
class welcome extends Controller
{

    function index() {
        $data['spices_count'] = $this->db->count_all_results('newthemes') + $this->db->count_all_results('newapplets') + $this->db->count_all_results('newdesklets') + $this->db->count_all_results('newextensions');
        $this->load->view('welcome_page', $data);
    }

}