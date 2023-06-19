<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends Admin_Controller
{
    public function index()
    {
        $config["base_url"] = site_url('kategori');
        $config["total_rows"] = $this->game_model->count_all_kategori();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;
        
        $this->template->setup_pagination($config);
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['kategori'] = $this->game_model->latest_kategori()->page($config['per_page'], $page)->all_kategori();

        $this->template->render_admin('admin/kategori/index', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required', [
            'required' => 'Harus mengisi %s',
        ]);

        if ($this->form_validation->run() === false) {
            return redirect('admin/kategori/index');
        }

        $data = $this->input->post(['nama_kategori']);

        $this->game_model->insert_kategori($data);

        $this->session->set_flashdata('message', 'Berhasil menambahkan kategori');

        redirect('admin/kategori/index');
    }

    public function edit($id_kategori)
    {
        if ($this->input->method(true) == 'GET')
        {
            $kategori = $this->game_model->first_where_kategori(['id_kategori' => $id_kategori]);
            
            $this->response_json($kategori);
        }

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required', [
            'required' => 'Harus mengisi %s',
        ]);

        if ($this->form_validation->run() === false) {
            return redirect('admin/kategori/index');
        }

        $data = $this->input->post(['nama_kategori']);

        $this->game_model->update_kategori(['id_kategori' => $id_kategori], $data);

        $this->session->set_flashdata('message', 'Berhasil mengedit kategori');

        redirect('admin/kategori/index');
    }

    public function destroy($id_kategori)
    {
        $this->game_model->delete_kategori(['id_kategori' => $id_kategori]);

        $this->session->set_flashdata('message', 'Berhasil menghapus kategori');

        redirect('admin/kategori/index');
    }
}