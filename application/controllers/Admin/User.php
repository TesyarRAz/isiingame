<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends Admin_Controller
{
    public function index()
    {
        $config["base_url"] = site_url('user');
        $config["total_rows"] = $this->user_model->count_all();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        
        $this->template->setup_pagination($config);
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['user'] = $this->user_model->latest()->page($config['per_page'], $page)->all();

        $this->template->render_admin('admin/user/index', $data);
    }

    
    public function create()
    {
        $data['games'] = $this->game_model->latest()->all();
        $data['generated_kode_user'] = 'ISI' . time();

        $this->template->render_admin('admin/user/create', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('nomor_telepon', 'No Telp', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() === false) {
            return $this->create();
        }

        $data = $this->input->post(['nama', 'username', 'password', 'nomor_telepon']);

        $this->user_model->insert($data);

        $this->session->set_flashdata('message', 'Berhasil menambahkan user');

        redirect('admin/user/index');
    }

    public function edit($id_user)
    {
        $data = $this->user_model->first_where(['id_user' => $id_user]);
        $this->abort_if(404, empty($data));

        $this->template->render_admin('admin/user/edit', $data);
    }

    public function update($id_user)
    {
        $user = $this->user_model->first_where(['id_user' => $id_user]);
        $this->abort_if(404, empty($user));

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('nomor_telepon', 'No Telp', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() === false) {
            return $this->edit($id_user);
        }

        $data = $this->input->post(['nama', 'username', 'password', 'nomor_telepon']);

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            unset($data['password']);
        }

        $this->user_model->update(['id_user' => $id_user], $data);

        $this->session->set_flashdata('message', 'Berhasil mengedit user');

        redirect('admin/user/index');
    }

    public function destroy($id_user)
    {
        $this->user_model->delete(['id_user' => $id_user]);

        $this->session->set_flashdata('message', 'Berhasil menghapus user');

        redirect('admin/user/index');
    }
}