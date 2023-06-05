<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
    private $instance;

    public function __construct() {
        $this->instance = &get_instance();
    }

    public function render_admin($content, $data = [])
    {   
		$this->instance->load->view('templates/admin/index', [
            'topbar' => $this->instance->load->view('templates/admin/topbar', [], true),
            'sidebar' => $this->instance->load->view('templates/admin/sidebar', [], true),
            'content' => $this->instance->load->view($content, $data, true),
            'footer' => $this->instance->load->view('templates/admin/footer', [], true),
        ]);
    }

    public function render_app($content, $data = [], $css = [], $js = [])
    {
        $this->instance->load->view('templates/app', [
            'content' => $this->instance->load->view($content, $data, true),
            'css' => $css,
            'js' => $js,
        ]);
    }

    public function setup_pagination($config)
    {
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
    }
}