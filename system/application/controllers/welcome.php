<?php
/**
 * Class welcome
 * @property CI_Loader           $load
 * @property CI_DB_active_record $db
 */
class welcome extends Controller
{

    function index() {
        /** @var int $countThemes */
        $countThemes = $this->db->count_all_results('newthemes');
        /** @var int $countApplets */
        $countApplets = $this->db->count_all_results('newapplets');
        /** @var int $countDesklets */
        $countDesklets = $this->db->count_all_results('newdesklets');
        /** @var int $countExtensions */
        $countExtensions = $this->db->count_all_results('newextensions');
        $data['spices_count'] = $countThemes + $countApplets + $countDesklets + $countExtensions;
        $this->load->view('welcome_page', $data);
    }

}