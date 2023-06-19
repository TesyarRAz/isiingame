<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function login()
    {
        if ($this->session->has_userdata('id_user')) {
            redirect('/');
        }

        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('password', 'password', 'required', [
            'required' => 'Harus mengisi %s',
        ]);

        if ($this->form_validation->run() == FALSE) {
            return redirect('login');
        }

        $credentials = $this->input->post(['username', 'password']);

        if ($user = $this->user_model->userWhere(['username' => $credentials['username']])) {
            if (password_verify($credentials['password'], $user['password'])) {
                unset($user['password']);
                
                $this->session->set_userdata($user);

                redirect('admin');
            }
        }

        $this->session->set_flashdata('message', 'Username atau password salah');
        redirect('login');
    }

    public function register()
    {
        if ($this->session->has_userdata('id_user')) {
            redirect('/');
        }
        
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Harus mengisi %s',
        ]);
        $this->form_validation->set_rules('password', 'password', 'required', [
            'required' => 'Harus mengisi %s',
        ]);

        if ($this->form_validation->run() == FALSE) {
            return redirect('login');
        }

        $credentials = $this->input->post(['nama', 'nomor_telepon', 'username', 'password']);

        $credentials['password'] = password_hash($credentials['password'], PASSWORD_BCRYPT);

        $this->user_model->insert($credentials);

        $this->session->set_flashdata('message', 'Berhasil membuat akun');

        redirect('login');
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('/');
    }
}