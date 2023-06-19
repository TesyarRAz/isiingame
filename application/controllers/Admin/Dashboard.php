<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function index()
    {
        $data['count_game'] = $this->game_model->count_all();
        $data['count_pengisian_dibuat'] = $this->game_model->count_pengisian_dibuat();
        $data['count_user'] = $this->user_model->count_all();

        $this->template->render_admin('admin/index', $data);
    }
}