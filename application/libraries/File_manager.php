<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File_manager
{
    private $instance;

    public function __construct()
    {
        $this->instance = &get_instance();
    }

    public function upload_file($name, $dir)
    {
        $config['upload_path']          =  $dir;
        $config['allowed_types']        = '*';
        $config['encrypt_name']         = true;

        $this->instance->load->library('upload', $config);

        if ($this->instance->upload->do_upload($name)) {
            return [true, $this->instance->upload->data()];
        }

        return [false, $this->instance->upload->display_errors()];
    }
}