<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function abort($status)
    {
        $this->output
        ->set_status_header($status)
        ->_display();

        exit;
    }

    protected function abort_if($status, $condition)
    {
        if ($condition) $this->abort($status);
    }

    protected function response_json($data = [], $status = 200)
    {
        $this->output
        ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
        ->set_content_type('application/json');

        $this->abort($status);
    }
}

class User_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();

        if (!$this->session->has_userdata('id_user')) {
            redirect('login');
        }
    }
}

class Admin_Controller extends User_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('role') != 'admin') {
            redirect('login');
        }
    }
}