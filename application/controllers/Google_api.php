<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Google_api extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("google");
        $this->access_only_admin();

    }

    function index() {
        redirect("google_api/authorize");
    }

    //authorize google drive
    function authorize() {
        $this->google->authorize();
    }

    //get access token and save
    function save_access_token() {
        if (!empty($_GET)) {
            $this->google->save_access_token(get_array_value($_GET, 'code'));
            redirect("settings/integration/google_drive");
        }
    }

}

/* End of file Google_api.php */
/* Location: ./application/controllers/Google_api.php */